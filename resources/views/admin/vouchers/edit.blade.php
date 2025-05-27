@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0" style="color: #15858f;">Edit Voucher</h1>
                <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.vouchers.update', $voucher) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Voucher</label>
                            <input type="text" class="form-control" id="code" name="code" 
                                   value="{{ old('code', $voucher->code) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" 
                                      required>{{ old('description', $voucher->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon (Rp)</label>
                            <input type="number" class="form-control" id="discount_amount" name="discount_amount" 
                                   value="{{ old('discount_amount', $voucher->discount_amount) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="valid_until" class="form-label">Berlaku Sampai</label>
                            <input type="datetime-local" class="form-control" id="valid_until" name="valid_until" 
                                   value="{{ old('valid_until', $voucher->valid_until->format('Y-m-d\TH:i')) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="max_uses" class="form-label">Maksimal Penggunaan</label>
                            <input type="number" class="form-control" id="max_uses" name="max_uses" 
                                   value="{{ old('max_uses', $voucher->max_uses) }}" required>
                            <small class="form-text text-muted">0 untuk unlimited</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                       value="1" {{ old('is_active', $voucher->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Aktif</label>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Voucher
                            </button>
                            
                            <button type="button" class="btn btn-outline-danger" 
                                    onclick="deleteVoucher({{ $voucher->id }})">
                                <i class="fas fa-trash me-2"></i>Hapus Voucher
                            </button>
                        </div>
                    </form>

                    <!-- Separate Delete Form -->
                    <form id="delete-form-{{ $voucher->id }}" 
                          action="{{ route('admin.vouchers.destroy', $voucher) }}" 
                          method="POST" 
                          style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteVoucher(voucherId) {
    if (confirm('Yakin ingin menghapus voucher ini?')) {
        document.getElementById('delete-form-' + voucherId).submit();
    }
}
</script>

<style>
.form-control:focus, .form-check-input:focus {
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
.form-check-input:checked {
    background-color: #15858f;
    border-color: #15858f;
}
</style>
@endsection