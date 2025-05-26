@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0" style="color: #15858f;">Tambah Voucher Baru</h1>
                <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="d-flex">
                            <div class="me-2">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div>
                                <p class="mb-0">Mohon perbaiki kesalahan berikut:</p>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('admin.vouchers.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Voucher</label>
                            <input type="text" class="form-control" id="code" name="code" required
                                   placeholder="Contoh: SAVE20">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required
                                      placeholder="Deskripsi voucher"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon (Rp)</label>
                            <input type="number" class="form-control" id="discount_amount" name="discount_amount" required
                                   placeholder="10000">
                        </div>

                        <div class="mb-3">
                            <label for="valid_until" class="form-label">Berlaku Sampai</label>
                            <input type="datetime-local" class="form-control" id="valid_until" name="valid_until" required>
                        </div>

                        <div class="mb-3">
                            <label for="max_uses" class="form-label">Maksimal Penggunaan</label>
                            <input type="number" class="form-control" id="max_uses" name="max_uses" required
                                   placeholder="0 untuk unlimited">
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                       value="1" checked>
                                <label class="form-check-label" for="is_active">Aktif</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Buat Voucher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: #15858f;
    box-shadow: 0 0 0 0.25rem rgba(21, 133, 143, 0.25);
}
.btn-primary {
    background-color: #15858f;
    border-color: #15858f;
}
.btn-primary:hover {
    background-color: #0d6a72;
    border-color: #0d6a72;
}
.btn-outline-primary {
    color: #15858f;
    border-color: #15858f;
}
.btn-outline-primary:hover {
    background-color: #15858f;
    border-color: #15858f;
    color: white;
}
</style>
@endsection