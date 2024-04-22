<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Stock;
use App\Models\Pelanggans;
use App\Models\Penjualan;
use App\Models\Produks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.index');
    }
    public function form()
    {
        return view('penjualan.create');
    }

    public function detailpembelian()
    {
        $data = Penjualan::all();
        return view('penjualan.index', compact('data'));
    }

    public function paymentHistory()
    {
        $penjualanTransaction = Penjualan::all();
        $detailTransaction = DetailPenjualan::all();
        $logStockOut = Stock::where("status", "out")->get();
        return view('pages.penjualan.history', compact("detailTransaction", "penjualanTransaction", "logStockOut"));
    }

    public function createInvoice(Request $request)
    {
        $products = [];
        $codes = $request->code;
        $quantitys = $request->quantity;
        $discounts = $request->discount;

        foreach ($codes as $index => $code) {
            $products[] = [
                "code" => $code,
                "quantity" => $quantitys[$index],
            ];
        }
        $codesToSearch = array_column($products, 'code');
        $items = Produks::whereIn('code', $codesToSearch)->get();

        $errorMessages = [];

        foreach ($products as $product) {
            $found = false;
            foreach ($items as $item) {
                if ($product["code"] == $item->code) {
                    $found = true;
                    if ($product["quantity"] > $item->stock) {
                        $errorMessages[] = "Stok produk '" . $item->product_name . "' dengan kode '" . $product["code"] . "' tidak mencukupi";
                    }
                    break;
                }
            }
            if (!$found) {
                $errorMessages[] = $product["code"];
            }
        }

        if (!empty($errorMessages)) {
            return back()->with("fail", $errorMessages);
        }

        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;

        session([
            "produk" => $products,
            "pelanggan" => [
                "name" => $name,
                "phone" => $phone,
                "address" => $address
            ]
        ]);
        return view("pages.penjualan.invoice", compact(
            "name",
            "phone",
            "address",
            "products",
            "items",
        ));
    }

    public function confirmPayment()
    {
        $products = session("produk");
        $codesToSearch = array_column($products, 'code');
        $items = Produks::whereIn('code', $codesToSearch)->get();
        $total_price = 0;
        foreach ($items as $item) {
            foreach ($products as $product) {
                if ($product["code"] == $item->code) {
                    $price = $product["quantity"] * $item->price;
                    $total_price += $price;
                }
            }
        }

        $customers = session("pelanggan");
        if ($customers["address"] == null) {
            # code...
            $customer = Pelanggans::create([
                "customer_name" => $customers["name"],
                "no_phone" => $customers["phone"],
            ]);
        }
        $customer = Pelanggans::create([
            "customer_name" => $customers["name"],
            "no_phone" => $customers["phone"],
            "address" => $customers["address"]
        ]);

        $penjualan = Penjualan::create([
            "pelanggan_id" => $customer->id,
            'sale_date' => now(),
            'total_price' => $total_price
        ]);

        foreach ($items as $item) {
            foreach ($products as $product) {
                if ($product["code"] == $item->code) {
                    DetailPenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'produk_id' => $item->id,
                        'total_product' => $product["quantity"],
                        'subtotal' => $item->price * $product["quantity"]
                    ]);


                    $productUpdate = Produks::find($item->id);
                    $stock = $productUpdate->stock - $product["quantity"];
                    $productUpdate->update([
                        "stock" => $stock
                    ]);

                    Stock::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $item->id,
                        'total_stock' => $product["quantity"],
                        'status' => "out"
                    ]);
                }
            }
        }

        return redirect()->route("penjualan")->with("success", "Transaksi berhasil!");
    }
}