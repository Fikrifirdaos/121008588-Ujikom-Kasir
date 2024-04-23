@extends('pages.dashboard')
@section('content')
    <div class="container-fluid py-4">
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
                <form action="{{ route('penjualan.invoice') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Informasi Pelanggan:</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama<span class="text-danger">*</span></label>
                                    <input type="text" name="name_staff" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi nama!
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>No Telp<span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi nomor telepon
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Alamat<span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" required></textarea>
                                    <div class="invalid-feedback">
                                        Silahkan isi alamat
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Tanggal<span class="text-danger">*</span></label>
                                    <input type="date" name="sale_date" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan isi tanggal penjualan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="productInputs">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row product-input">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Kode Produk<span class="text-danger">*</span></label>
                                        <input type="text" name="produk_id[]" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Silahkan isi kode produk
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Kuantitas<span class="text-danger">*</span></label>
                                        <input type="number" name="total[]" class="form-control total-input" required>
                                        <div class="invalid-feedback">
                                            Silahkan isi kuantitas
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="button" class="btn btn-danger" onclick="removeProductInput(this)">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" onclick="addProductInput()">Tambah Input Produk</button>
                        <button class="btn btn-success">Buat Invoice</button>
                    </div>
                </form>
                
                
            </div>
        </section>
    
    </div>

    <script>
        function addProductInput() {
   var productInputs = document.getElementById('productInputs');
   var newProductInput = productInputs.children[0].cloneNode(true);
   productInputs.appendChild(newProductInput);

   // Reset input values for the new product input
   newProductInput.querySelectorAll('input').forEach(function(input) {
       input.value = '';
   });

   // Reset discount input value
   var discountInput = newProductInput.querySelector('[name="discount[]"]');
   discountInput.value = 0;

   // Reset invalid feedback for new inputs
   newProductInput.querySelectorAll('.invalid-feedback').forEach(function(feedback) {
       feedback.style.display = 'none';
   });

   // Reset button event listener for cancel button
   var cancelButton = newProductInput.querySelector('.btn-danger');
   cancelButton.addEventListener('click', function() {
       removeProductInput(this);
   });
}

function removeProductInput(button) {
        button.closest('.product-input').remove();
    }
   </script>
@endsection

    