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
            <div class="card border-0 shadow-lg rounded-4 text-center p-4 position-relative profile-card h-100">
                <div class="position-relative mx-auto mb-4" style="width: 180px;">
                    <img src="{{ isset($outlet['image']) ? asset($outlet['image']) : asset('gambar/icon.png') }}"
                         id="preview-image"
                         class="rounded-circle img-thumbnail border-4 shadow-sm object-fit-cover"
                         style="width: 180px; height: 180px;">
                    <label for="image-upload" class="edit-only d-none position-absolute bottom-0 end-0 bg-white border rounded-circle p-2 shadow-sm" style="cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-camera-fill text-primary"></i>
                    </label>
                    <input type="file" id="image-upload" name="image" class="d-none" accept="image/*">
                </div>

                <h3 class="fw-bold text-primary mb-3">{{ $outlet['nama_outlet'] }}</h3>
                <p class="text-muted mb-3"><i class="bi bi-geo-alt-fill me-1"></i>{{ $outlet['alamat_outlet'] }}</p>
                <div class="d-flex justify-content-center gap-2 flex-wrap mb-4">
                    <span class="badge px-3 py-2 rounded-pill" style="background-color: #e3f2fd; color: #0d6efd;">
                        <i class="bi bi-shop me-1"></i>Laundry
                    </span>
                    <span class="badge px-3 py-2 rounded-pill" style="background-color: #e9f7ef; color: #198754;">
                        <i class="bi bi-check-circle me-1"></i>Active
                    </span>
                </div>

                @if(!isset($outlet['id']))
                    <a href="{{ route('input.outlet') }}" class="btn btn-primary w-100 rounded-pill py-2">
                        <i class="bi bi-plus-circle me-1"></i> Input Data Outlet
                    </a>
                @else
                    <button id="editButton" class="btn btn-outline-primary w-100 rounded-pill py-2">
                        <i class="bi bi-pencil-square me-1"></i> Edit Profile
                    </button>
                    <form action="{{ route('profile.delete') }}" method="POST" class="mt-2" onsubmit="return confirm('Yakin ingin menghapus outlet ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill py-2">
                            <i class="bi bi-trash3-fill me-1"></i> Hapus Outlet
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Detail Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 p-4 h-100">
                <form id="updateForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="d-none">
                    @csrf
                    @method('PUT')

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0 text-primary">Edit Informasi Outlet</h4>
                        <div>
                            <button type="button" id="cancelButton" class="btn btn-outline-secondary me-2 rounded-pill">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Outlet</label>
                            <input type="text" class="form-control" name="nama_outlet" value="{{ $outlet['nama_outlet'] }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi Outlet</label>
                            <textarea class="form-control" name="deskripsi_outlet" rows="3">{{ $outlet['deskripsi_outlet'] }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Jenis Layanan Laundry</label>
                            <input type="text" class="form-control" name="layanan_laundry" value="{{ $outlet['layanan_laundry'] }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor Layanan</label>
                            <input type="text" class="form-control" name="nomor_layanan" value="{{ $outlet['nomor_layanan'] }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input type="text" class="form-control" name="alamat_outlet" value="{{ $outlet['alamat_outlet'] }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Layanan Outlet</label>
                            <div id="layanan-list" class="mb-3">
                                @php
                                    $layananDetail = isset($outlet['layanan_detail']) && $outlet['layanan_detail'] ? json_decode($outlet['layanan_detail'], true) : [];
                                @endphp
                                @if(empty($layananDetail))
                                    <div class="row g-3 mb-3 layanan-item">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="layanan_detail[nama][]" placeholder="Nama Layanan" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="layanan_detail[deskripsi][]" placeholder="Deskripsi Layanan" required>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-layanan" title="Hapus Layanan">&times;</button>
                                        </div>
                                    </div>
                                @else
                                    @foreach($layananDetail as $i => $layanan)
                                    <div class="row g-3 mb-3 layanan-item">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="layanan_detail[nama][]" value="{{ $layanan['nama'] }}" placeholder="Nama Layanan" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="layanan_detail[deskripsi][]" value="{{ $layanan['deskripsi'] }}" placeholder="Deskripsi Layanan" required>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-layanan" title="Hapus Layanan">&times;</button>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="add-layanan">
                                <i class="bi bi-plus-circle me-1"></i>Tambah Layanan
                            </button>
                        </div>
                    </div>
                </form>

                <div id="viewMode">
                    <h4 class="fw-bold mb-4 text-primary">Informasi Outlet</h4>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-4 p-4 h-100 info-card">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-shop text-primary me-2 fs-4"></i>
                                    <h6 class="text-muted mb-0">Nama Outlet</h6>
                                </div>
                                <p class="fw-semibold mb-0">{{ $outlet['nama_outlet'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-4 p-4 h-100 info-card">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone text-primary me-2 fs-4"></i>
                                    <h6 class="text-muted mb-0">Nomor Layanan</h6>
                                </div>
                                <p class="fw-semibold mb-0">{{ $outlet['nomor_layanan'] }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-light border-0 rounded-4 p-4 info-card">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-info-circle text-primary me-2 fs-4"></i>
                                    <h6 class="text-muted mb-0">Deskripsi</h6>
                                </div>
                                <p class="fw-semibold mb-0">{{ $outlet['deskripsi_outlet'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-4 p-4 h-100 info-card">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt text-primary me-2 fs-4"></i>
                                    <h6 class="text-muted mb-0">Alamat</h6>
                                </div>
                                <p class="fw-semibold mb-0">{{ $outlet['alamat_outlet'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Services Section -->
                    <div class="mt-5">
                        <h4 class="fw-bold mb-4 text-primary">Layanan Outlet</h4>
                        <div class="row g-4">
                            @php
                                $layananDetail = isset($outlet['layanan_detail']) && $outlet['layanan_detail'] ? json_decode($outlet['layanan_detail'], true) : [];
                            @endphp
                            @if(!empty($layananDetail))
                                @foreach($layananDetail as $layanan)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 service-card">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-check2-circle text-primary me-2 fs-4"></i>
                                                <h5 class="card-title fw-bold mb-0">{{ $layanan['nama'] }}</h5>
                                            </div>
                                            @if(!empty($layanan['deskripsi']))
                                                <p class="card-text text-muted mb-0">{{ $layanan['deskripsi'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <div class="alert alert-info rounded-4">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Belum ada layanan yang ditambahkan
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

<style>
body {
    background-color: #f8fafc;
    font-size: 0.875rem;
}

.card {
    transition: all 0.3s ease;
}

.profile-card {
    background: linear-gradient(to bottom, #ffffff, #f8f9fa);
}

.profile-card h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.profile-card p {
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.info-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
    padding: 1.25rem !important;
}

.info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.05);
}

.info-card h6 {
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.info-card p {
    font-size: 0.875rem;
    margin-bottom: 0;
}

.service-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.service-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.05);
}

.service-card h5 {
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.service-card p {
    font-size: 0.875rem;
    margin-bottom: 0;
}

.form-label {
    font-weight: 600;
    font-size: 0.875rem;
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-control {
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.15);
}

.btn {
    font-weight: 500;
    font-size: 0.875rem;
    padding: 0.75rem 1.25rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

.text-primary {
    color: #0d6efd !important;
}

.badge {
    font-weight: 500;
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
}

.alert {
    border: none;
    border-radius: 0.5rem;
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    font-size: 0.875rem;
}

.alert-info {
    background-color: #e3f2fd;
    color: #0d6efd;
}

/* Ensure consistent heights */
.h-100 {
    height: 100% !important;
}

/* Improve spacing in forms */
.row.g-4 {
    margin-bottom: 1.5rem;
}

/* Improve button alignment */
.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

/* Improve card content alignment */
.card-body {
    display: flex;
    flex-direction: column;
}

/* Ensure consistent icon sizes */
.bi {
    line-height: 1;
    font-size: 1rem;
}

/* Adjust heading sizes */
h4 {
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
}

h5 {
    font-size: 1rem;
}

h6 {
    font-size: 0.875rem;
}

/* Adjust icon sizes in cards */
.info-card .bi {
    font-size: 1.25rem;
}

.service-card .bi {
    font-size: 1.25rem;
}

/* Adjust card spacing */
.card {
    margin-bottom: 1.5rem;
}

/* Adjust grid spacing */
.g-4 {
    gap: 1.5rem !important;
}

/* Adjust section spacing */
.mt-5 {
    margin-top: 3rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

/* Adjust info card content spacing */
.info-card .d-flex {
    margin-bottom: 0.75rem;
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

    // Layanan dinamis
    const layananList = document.getElementById('layanan-list');
    document.getElementById('add-layanan').addEventListener('click', function() {
        const layananItem = document.createElement('div');
        layananItem.className = 'row g-3 mb-3 layanan-item';
        layananItem.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="layanan_detail[nama][]" placeholder="Nama Layanan" required>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="layanan_detail[deskripsi][]" placeholder="Deskripsi Layanan" required>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm remove-layanan" title="Hapus Layanan">&times;</button>
            </div>
        `;
        layananList.appendChild(layananItem);
    });
    layananList.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-layanan')) {
            const item = e.target.closest('.layanan-item');
            if (item) item.remove();
        }
    });
});
</script>
@endsection