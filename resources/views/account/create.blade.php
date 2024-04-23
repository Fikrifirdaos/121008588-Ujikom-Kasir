@extends('pages.dashboard')
@section('content')
<div class="container-fluid py-4 bg-light">
    <section class="section">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Success:</b>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Fail:</b>
                    Produk dengan kode
                    @foreach (session('fail') as $code)
                        <b>{{ $code }}</b>,
                    @endforeach
                    tidak tersedia
                </div>
            </div>
        @endif
        <div class="section-body">
            <form action="{{ route("user.store") }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="card-header">
                    <h4>Formulir Akun</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="" class="form-control" required>
                            <div class="invalid-feedback">
                                Silahkan isi nama lengkap
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Username<span class="text-danger">*</span></label>
                            <input type="text" name="username" placeholder="" class="form-control" required>
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
                                <option value="administrator">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success">Simpan</button>
                    <a href="{{ route("user") }}" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection