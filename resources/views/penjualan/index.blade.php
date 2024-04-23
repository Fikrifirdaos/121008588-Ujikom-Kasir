@extends('pages.dashboard')
@section('content')
<div class="container">

    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    @if (Auth::user()->role == 'admin')
                    <div class="card-header pb-0">
                        <h6>Penjualan table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Alamat</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            No Handphone</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            tanggal</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/money.png"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    {{$item->Pelanggan->name_staff}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                           {{$item->Pelanggan->address}}
                                        </td>
                                        <td>
                                            {{$item->Pelanggan->no_hp}}
                                        </td>
                                        <td>
                                            {{$item->sale_date}}
                                        </td>
                                        <td>
                                            Rp{{ number_format($item->total, 2, ',', '.') }}
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="btn text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="">
                                                lihat
                                            </a>
                                            <a href="{{route('penjualan.delete', $item->id)}}" class="btn text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="">
                                                Hapus
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach
                    @else
                    <div class="card-header pb-0">
                        <h6>Penjualan table</h6>
                    </div>
                    <div class="input-group-btn mt-3">
                        <a href="{{route('penjualan.create')}}" class="btn btn-primary mt-3">
                            Tambah
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Alamat</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            No Hanphone</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            tanggal</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/money.png"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    {{$item->Pelanggan->name_staff}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                           {{$item->Pelanggan->address}}
                                        </td>
                                        <td>
                                            {{$item->Pelanggan->no_hp}}
                                        </td>
                                        <td>
                                            {{$item->sale_date}}
                                        </td>
                                        <td>
                                            @foreach ( $detail as $item)
                                            Rp{{ number_format($item->subtotal, 2, ',', '.') }}
                                            @endforeach
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="btn text-secondary font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="">
                                                lihat
                                            </a>
                                            <a href="{{route('penjualan.delete', $item->id)}}" class="btn text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="">
                                                Hapus
                                            </a>
                                        </td>

                                    </tr>

                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    @endsection
