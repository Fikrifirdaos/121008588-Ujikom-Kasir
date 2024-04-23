<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard.index');
    }

    public function pembelian()
    {
        $pembelian = Penjualan::all();
        //  dd($pembelian);
        return view('petugas.pembelian.index', compact('pembelian'));
    }

    public function tambahPembelian()
    {
        $produk = Produk::all();
        return view('petugas.pembelian.form', compact('produk'));
    }

    public function simpanPembelian(Request $request)
    {
        $request->validate([
            'nm_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'tgl_penjualan' => 'required',
            'produk_id' => 'required|array', // Jika ini diharapkan menjadi array
            'total_harga' => 'required|array', // Jika ini diharapkan menjadi array
        ]);


        $totalPrice = 0; // Inisialisasi total harga

        foreach ($request->produk_id as $key => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlahBeli = $request->total_harga[$key];
            $subtotal = $produk->harga * $jumlahBeli;
            $totalPrice += $subtotal; // Menambahkan subtotal ke total harga
        }

        $pelanggan = Pelanggan::create([
            'nm_pelanggan' => $request->nm_pelanggan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        $penjualan = Penjualan::create([
            'pelanggan_id' => $pelanggan->id,
            'tgl_penjualan' => $request->tgl_penjualan,
            'total_harga' => $totalPrice, // Menggunakan total harga yang telah dihitung
        ]);

        foreach ($request->produk_id as $key => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlahBeli = $request->total_harga[$key];
            $subtotal = $produk->harga * $jumlahBeli;

            // Buat detail penjualan
            $saleDetail = DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $produkId,
                'jml_produk' => $jumlahBeli,
                'sub_total' => $subtotal,
            ]);

            // Kurangi stok produk
            $produk->stok -= $jumlahBeli;
            $produk->save();
        }

        return redirect()->route('pembelian');
    }

    public function detailPenjualan($id)
    {
        $detailPenjualan = DetailPenjualan::where('penjualan_id', $id)->get();
        return view('petugas.pembelian.detail', compact('detailPenjualan'));
    }

    public function produk()
    {
        $dataProduk = Produk::all();
        return view('petugas.produk.index', compact('dataProduk'));
    }

    public function exportPDF($id)
    {
        // Ambil data penjualan berdasarkan ID yang diberikan
        $detailPenjualan = DetailPenjualan::where('penjualan_id', $id)->get();
        $penjualan = Penjualan::findOrFail($id);
        $totalHarga = $penjualan->total_harga;
        $pdf = PDF::loadView('petugas.pembelian.pdf', compact('detailPenjualan', 'totalHarga'));
        return $pdf->download('transaksi_pembelian_' . $id . '.pdf');
    }
}
