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
        $detail= DetailPenjualan::all();
        $penjualan = Penjualan::all();
        return view("penjualan.index", compact("penjualan","detail"));
    }

    
    public function form()
    {
        $produk = Produks::all();
        return view('penjualan.create', compact('produk'));
    }


    public function createInvoice(Request $request)
    {
        $products = [];
$name_produk = $request->name_produk;
$quantitys = $request->quantity;

foreach ($name_produk as $index => $name) {
    $p = Produks::where('name_produk', $name)->first();
    $products[] = [
        "name_produk" => $name,
        "quantity" => $quantitys[$index],
        "price" => $p['price'],
        "sub_total" => (int)$p['price'] * (int)$quantitys[$index],
    ];
}

$nameToSearch = array_column($products, 'name_produk');
$items = Produks::whereIn('name_produk', $nameToSearch)->get();

$errorMessages = [];

foreach ($products as $product) {
    $found = false;
    foreach ($items as $item) {
        if ($product["name_produk"] == $item->name_produk) {
            $found = true;
            if ($product["quantity"] > $item->stock) {
                $errorMessages[] = "Stok produk '" . $item->name_produk . "' tidak mencukupi";
            }
            break;
        }
    }
    if (!$found) {
        $errorMessages[] = "Produk dengan nama '" . $product["name_produk"] . "' tidak ditemukan";
    }
}

if (!empty($errorMessages)) {
    return back()->with("fail", $errorMessages);
}

$name_staff = $request->name_staff;
$phone = $request->no_hp;
$address = $request->address;

session([
    "produk" => $products,
    "pelanggan" => [
        "name_staff" => $name_staff,
        "no_hp" => $phone,
        "address" => $address
    ]
]);

// dd($products);
return view("penjualan.invoice", compact(
    "name_staff",
    "phone",
    "address",
    "products",
    "items"
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

        $customer = session("pelanggan");

        if ($customer["address"] == null) {
            $customer = Pelanggans::create([
                "name_staff" => $customer["name_staff"],
                "no_hp" => $customer["no_phone"],
            ]);
        } else {
            $customer = Pelanggans::create([
                "name_staff" => $customer["name_staff"],
                "no_hp" => $customer["no_hp"],
                "address" => $customer["address"]
            ]);
        }

        $penjualan = Penjualan::create([
            "pelanggan_id" => $customer->id,
            'sale_date' => now(),
            'total' => $total_price
        ]);

        foreach ($items as $item) {
            foreach ($products as $product) {
                if ($product["code"] == $item->code) {
                    DetailPenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'produk_id' => $item->id,
                        'produk_total' => $product["quantity"],
                        'subtotal' => $item->price * $product["quantity"]
                    ]);

                    $productUpdate = Produks::find($item->id);

                }
            }
        }

        return redirect()->route("penjualan")->with("success", "Transaksi berhasil!");
    }

    public function delete(Request $request, $id)
    {
        $data = Penjualan::findOrFail($id);
        $data->delete();
        return redirect()->route("penjualan");
    }
}
