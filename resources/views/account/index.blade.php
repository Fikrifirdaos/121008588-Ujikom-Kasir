@extends('pages.dashboard')
@section('content')
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Akun Staff</h6>
                    <div class="input-group-btn mt-3">
                        <a href="{{route('user.create')}}" class="btn btn-primary mt-3">
                            Tambah Akun
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Username</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($account as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../assets/img/user.jpg"
                                                    class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$user->username}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$user->role}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="btn text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                                            Edit
                                        </a>
                                        <a href="{{route('user.delete', $user->id)}}" class="btn text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                {{-- modal edit --}}
                                <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('user.update', $user->id)}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1"
                                                        class="form-label">Nama</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" 
                                                        value="{{$user->name}}" name="name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="form-label">Username</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" placeholder=""
                                                        value="{{$user->username}}" name="username">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                        </div>
                                        <div class="modal-footer">
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
