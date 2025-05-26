@extends('layouts.appoutlet')

@section('content')

<div class="background-container">
  <div class="container py-5 d-flex justify-content-center">
    <div class="form-wrapper bg-white p-5 rounded shadow" style="width: 100%; max-width: 600px;">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <h4 class="mb-4 text-center">Input Outlet</h4>

      <form action="{{ route('input.outlet.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Gambar Outlet -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-image text-primary"></i> Foto Outlet
          </label>
          <div class="d-flex gap-3 align-items-center">
            <div class="image-preview rounded-3" style="width: 100px; height: 100px; background: #f8f9fa; overflow: hidden;">
              <img src="#" alt="Preview" class="img-preview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
              <div class="placeholder h-100 d-flex flex-column align-items-center justify-content-center">
                <i class="bi bi-image text-muted" style="font-size: 1.5rem;"></i>
              </div>
            </div>
            <div class="flex-grow-1">
              <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(this)" required>
              <p class="text-muted small mt-1 mb-0">
                <i class="bi bi-info-circle"></i> Maksimal 2MB (Format: JPG, JPEG, PNG)
              </p>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="nama_outlet" class="form-label fw-semibold">
            <i class="bi bi-shop text-primary"></i> Nama Outlet Laundry
          </label>
          <input type="text" class="form-control" id="nama_outlet" name="nama_outlet" 
                 value="{{ old('nama_outlet') }}"
                 placeholder="Masukkan nama outlet" required>
        </div>

        <div class="mb-3">
          <label for="alamat_outlet" class="form-label fw-semibold">
            <i class="bi bi-geo-alt text-primary"></i> Alamat Outlet Laundry
          </label>
          <input type="text" class="form-control" id="alamat_outlet" name="alamat_outlet" 
                 value="{{ old('alamat_outlet') }}"
                 placeholder="Masukkan alamat lengkap outlet" required>
        </div>

        <div class="mb-3">
          <label for="nomor_layanan" class="form-label fw-semibold">
            <i class="bi bi-telephone text-primary"></i> Nomor Layanan Laundry
          </label>
          <input type="text" class="form-control" id="nomor_layanan" name="nomor_layanan" 
                 value="{{ old('nomor_layanan') }}"
                 placeholder="Masukkan nomor telepon/WhatsApp" required>
        </div>

        <div class="mb-3">
          <label for="layanan_laundry" class="form-label fw-semibold">
            <i class="bi bi-list-check text-primary"></i> Layanan Laundry
          </label>
          <input type="text" class="form-control" id="layanan_laundry" name="layanan_laundry" 
                 value="{{ old('layanan_laundry') }}"
                 placeholder="Contoh: Cuci Kering, Setrika, Express" required>
        </div>

        <div class="mb-4">
          <label for="deskripsi_outlet" class="form-label fw-semibold">
            <i class="bi bi-file-text text-primary"></i> Deskripsi Outlet Laundry
          </label>
          <textarea class="form-control" id="deskripsi_outlet" name="deskripsi_outlet" 
                    rows="3" placeholder="Jelaskan tentang outlet laundry Anda" required>{{ old('deskripsi_outlet') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-plus-circle me-2"></i>Tambahkan Outlet Laundry
        </button>
      </form>
    </div>
  </div>
</div>

<style>
.form-control {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
}

.form-label {
    margin-bottom: 0.5rem;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

.alert-success {
    background-color: #d1e7dd;
    color: #0f5132;
}

.image-preview {
    border: 1px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder {
    background: #f8f9fa;
    text-align: center;
}
</style>

<script>
function previewImage(input) {
    const container = input.closest('.d-flex');
    const imgPreview = container.querySelector('.img-preview');
    const placeholder = container.querySelector('.placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imgPreview.style.display = 'block';
            imgPreview.src = e.target.result;
            placeholder.style.display = 'none';
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
