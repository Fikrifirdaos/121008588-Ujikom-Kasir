<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $list = Produks::all();
        return view("pages.stock", compact("list"));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            "name_produk" => "required",
            "price" => "required",
            "stock" => "required"
        ]);

        $now = Carbon::now();
        $yearMonthDay = $now->format('y') . $now->format('m') . $now->format('d');
        $producutCount = Produks::count();
        $code = false;

        if ($producutCount == 0) {
            $code = "P".$yearMonthDay."1";
        } else {
            $code = "P" . $yearMonthDay . ($producutCount + 1);
        }   

        $product = Produks::create([
            "name_produk" => $request->name_produk,
            "price" => $request->price,
            "stock" => $request->stock,
            "code" => $code
        ]);


        return back()->with("success", "Berhasil menambah Product baru");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name_produk" => "required",
            "price" => "required",
            // "stock" => "required"
        ]);

        $stock = Produks::find($id);
        $stock->update([
            "name_produk" => $request->name_produk,
            "price" => $request->price,
            // "stock" => $request->stock
        ]);
        return back()->with("success", "Berhasil merubah Produck");
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            "stock" => "required"
        ]);

        if ($request->stock < 1) {
            return back()->with("err", "Gagal, isi input stock dengan benar!");
        }
        $stock = Produks::find($id);
        $stock->update([
            "stock" => $stock->stock + $request->stock,
            'description' => $request->description
        ]);

        return back()->with("success", "Berhasil menambah Stock baru");
    }
}