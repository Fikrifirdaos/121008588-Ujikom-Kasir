@extends('pages.dashboard')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Stock table</h6>
                </div>
                <div class="input-group-btn mt-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModalcreate"><i class="fas fa-plus"></i> Tambah Produk Baru</button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Price</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Stock</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>
                                        <div>
                                            <p>{{ $item->code }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3"
                                                    alt="user2">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$item->name_produk}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Rp{{ number_format($item->price, 2, ',', '.') }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$item->stock}}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="btn text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalunit{{$item->id}}">
                                            tambah unit
                                        </a>
                                        <a href="javascript:;" class="btn text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                            Edit
                                        </a>
                                        <a href="{{route('stock.delete', $item->id)}}" class="btn text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal edit -->
                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('stock.update', $item->id)}}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Produk</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" placeholder="product name"
                                                            value="{{$item->name_produk}}" name="name_produk">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Harga</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" placeholder=""
                                                            value="{{$item->price}}" name="price">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal unit -->
                                <div class="modal fade" id="exampleModalunit{{$item->id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update', $item->id)}}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Stok</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" placeholder=""
                                                             name="stock">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalcreate" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('stock.store')}}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Produk</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" placeholder=""
                                                            name="name_produk">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Harga</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" placeholder="" name="price">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Stok</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleFormControlInput1" placeholder="" name="stock">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                    </div>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
