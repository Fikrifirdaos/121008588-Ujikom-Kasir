@extends('pages.dashboard')
@section('content')
<div class="container-fluid py-4">
    <div class="max-w-lg mx-auto py-20">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <div class="flex justify-between mb-4">
                <div>
                    <a href="" class="btn-back bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                </div>
                <div>
                    <a href="" class="btn-print bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md inline-block">Cetak (.pdf)</a>
                </div>
            </div>

            <div class="text-center">
                <h2 class="text-2xl font-bold">detail pembelian</h2>
            </div>
            @foreach ($penjualan as $item)
            <div class="mt-4">
                <div class="info">
                    <p class="mb-2">Nama Pelanggan : {{$pelanggan->name_staff}}</p>
                    <p class="mb-2">Alamat Pelanggan :  {{$pelanggan->address}}</p>
                    <p class="mb-2">No HP Pelanggan : {{$pelanggan->no_hp}}</p>
                </div>
            </div>

            <div class="mt-4">
                <div id="table">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                                <th class="py-2 px-3 text-left">Nama Produk</th>
                                <th class="py-2 px-3 text-left">Qty</th>
                                <th class="py-2 px-3 text-left">Harga</th>
                                <th class="py-2 px-3 text-left">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-2 px-3">{{$detail-}}</td>
                            <td class="py-2 px-3">{{$detail->produk_total}}</td>
                            <td class="py-2 px-3"> {{$item->produks->price}}</td>
                            <td class="py-2 px-3">{{$item->total}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row w-100 mb-3">
                    <div class="col-sm-6 col-12">
                        <b>Total Dibayar:</b>
                    </div>
                    <div class="col-sm-6 col-12">
                        Rp{{ number_format($totalPrice, 2, ',', '.') }}
                    </div>
                </div>
                <div>
                    <a href="{{ route('penjualan') }}" class="btn btn-danger">Cancel Pembayaran</a>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

@endsection