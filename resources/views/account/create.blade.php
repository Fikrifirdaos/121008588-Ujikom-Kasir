@extends('pages.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <section class="section">
            <div class="section-body">
                <div class="card">
                    <form action="{{route('user.store')}}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header">
                            <h4>Formulir Akun</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama Lengkap<span class="text-danger">*</span></label>
                                    <input type="text" name="name"  class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi nama lengkap
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Username<span class="text-danger">*</span></label>
                                    <input type="text" name="username"  class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi username
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" placeholder="********" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi password
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Role<span class="text-danger">*</span></label>
                                    <select class="form-control" name="role" required>
                                        <option disabled selected>Select Role</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="administrator">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-success">Simpan</button>
                            <a href="/user" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </section>
    </div>
@endsection