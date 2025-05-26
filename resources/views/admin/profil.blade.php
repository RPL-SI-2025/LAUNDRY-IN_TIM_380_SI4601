@extends('layouts.appadmin')

@section('content')
<div class="container py-5">
    @if(session('success'))
    <div class="alert alert-success shadow rounded-3" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow" style="border-radius: 15px;">
                <div class="card-body text-center p-4">
                    <!-- Profile Image -->
                    <div class="position-relative mx-auto mb-3" style="width: 150px;">
                        <img src="{{ isset($outlet['image']) ? asset($outlet['image']) : asset('gambar/icon.png') }}"
                             id="preview-image"
                             class="rounded-circle img-thumbnail border-3"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <label for="image-upload" class="edit-only d-none position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                            <i class="bi bi-camera-fill text-primary"></i>
                        </label>
                        <input type="file" id="image-upload" name="image" class="d-none" accept="image/*">
                    </div>

                    <!-- Profile Info -->
                    <h3 class="fw-bold">{{ $outlet['nama_outlet'] }}</h3>
                    <p class="text-muted">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        {{ $outlet['alamat_outlet'] }}
                    </p>

                    <!-- Status Badges -->
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge" style="background-color: #15858f;">Laundry</span>
                        <span class="badge bg-success">Active</span>
                    </div>

                    <!-- Action Buttons -->
                    @if(!isset($outlet['id']))
                        <a href="{{ route('input.outlet') }}" class="btn btn-primary w-100 mt-4">
                            <i class="bi bi-plus-circle me-1"></i> Input Data Outlet
                        </a>
                    @else
                        <button id="editButton" class="btn btn-outline-primary w-100 mt-4">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profile
                        </button>
                        <form action="{{ route('profile.delete') }}" method="POST" class="mt-2" 
                              onsubmit="return confirm('Yakin ingin menghapus outlet ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="bi bi-trash3-fill me-1"></i> Hapus Outlet
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <!-- Edit Form -->
                    <form id="updateForm" action="{{ route('profile.update') }}" method="POST" 
                          enctype="multipart/form-data" class="d-none">
                        @csrf
                        @method('PUT')

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold mb-0">Edit Informasi Outlet</h4>
                            <div>
                                <button type="button" id="cancelButton" class="btn btn-outline-secondary me-2">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Outlet</label>
                                <input type="text" class="form-control" name="nama_outlet" 
                                       value="{{ $outlet['nama_outlet'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Layanan Laundry</label>
                                <input type="text" class="form-control" name="layanan_laundry" 
                                       value="{{ $outlet['layanan_laundry'] }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi Outlet</label>
                                <textarea class="form-control" name="deskripsi_outlet" 
                                          rows="3">{{ $outlet['deskripsi_outlet'] }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor Layanan</label>
                                <input type="text" class="form-control" name="nomor_layanan" 
                                       value="{{ $outlet['nomor_layanan'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat_outlet" 
                                       value="{{ $outlet['alamat_outlet'] }}">
                            </div>
                        </div>
                    </form>

                    <!-- View Mode -->
                    <div id="viewMode">
                        <h4 class="fw-bold mb-4">Informasi Outlet</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded h-100">
                                    <h6 class="text-muted mb-2">Nama Outlet</h6>
                                    <p class="mb-0 fw-semibold">{{ $outlet['nama_outlet'] }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded h-100">
                                    <h6 class="text-muted mb-2">Layanan</h6>
                                    <p class="mb-0 fw-semibold">{{ $outlet['layanan_laundry'] }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light p-3 rounded">
                                    <h6 class="text-muted mb-2">Deskripsi</h6>
                                    <p class="mb-0 fw-semibold">{{ $outlet['deskripsi_outlet'] }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded h-100">
                                    <h6 class="text-muted mb-2">Nomor Layanan</h6>
                                    <p class="mb-0 fw-semibold">{{ $outlet['nomor_layanan'] }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded h-100">
                                    <h6 class="text-muted mb-2">Alamat</h6>
                                    <p class="mb-0 fw-semibold">{{ $outlet['alamat_outlet'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-2px);
}
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
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('editButton');
    const cancelButton = document.getElementById('cancelButton');
    const updateForm = document.getElementById('updateForm');
    const viewMode = document.getElementById('viewMode');
    const imageUploadLabel = document.querySelector('label[for="image-upload"]');

    document.getElementById('image-upload').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-image').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    editButton.addEventListener('click', function () {
        updateForm.classList.remove('d-none');
        viewMode.classList.add('d-none');
        imageUploadLabel.classList.remove('d-none');
        editButton.classList.add('d-none');
    });

    cancelButton.addEventListener('click', function () {
        updateForm.classList.add('d-none');
        viewMode.classList.remove('d-none');
        imageUploadLabel.classList.add('d-none');
        editButton.classList.remove('d-none');
        document.getElementById('preview-image').src = '{{ isset($outlet["image"]) ? asset($outlet["image"]) : asset("gambar/icon.png") }}';
        updateForm.reset();
    });
});
</script>
@endsection