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
            <div class="card border-0 shadow-lg rounded-4 text-center p-4 position-relative">
                <div class="position-relative mx-auto" style="width: 160px;">
                    <img src="{{ isset($outlet['image']) ? asset($outlet['image']) : asset('gambar/icon.png') }}"
                         id="preview-image"
                         class="rounded-circle img-thumbnail border-3 shadow-sm object-fit-cover"
                         style="width: 160px; height: 160px;">
                    <label for="image-upload" class="edit-only d-none position-absolute bottom-0 end-0 bg-light border rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                        <i class="bi bi-camera-fill"></i>
                    </label>
                    <input type="file" id="image-upload" name="image" class="d-none" accept="image/*">
                </div>

                <h3 class="mt-3 fw-bold">{{ $outlet['nama_outlet'] }}</h3>
                <p class="text-muted mb-1"><i class="bi bi-geo-alt-fill me-1"></i>{{ $outlet['alamat_outlet'] }}</p>
                <div class="d-flex justify-content-center gap-2 flex-wrap mt-2">
                    <span class="badge px-3 py-2 rounded-pill" style="background-color: #e3f2fd; color: #0d6efd;">Laundry</span>
                    <span class="badge px-3 py-2 rounded-pill" style="background-color: #e9f7ef; color: #198754;">Active</span>


                </div>

                @if(!isset($outlet['id']))
                    <a href="{{ route('input.outlet') }}" class="btn btn-primary w-100 mt-4 rounded-pill">
                        <i class="bi bi-plus-circle me-1"></i> Input Data Outlet
                    </a>
                @else
                    <button id="editButton" class="btn btn-outline-primary w-100 mt-4 rounded-pill">
                        <i class="bi bi-pencil-square me-1"></i> Edit Profile
                    </button>
                    <form action="{{ route('profile.delete') }}" method="POST" class="mt-2" onsubmit="return confirm('Yakin ingin menghapus outlet ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                            <i class="bi bi-trash3-fill me-1"></i> Hapus Outlet
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Detail Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 p-4">
                <form id="updateForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="d-none">
                    @csrf
                    @method('PUT')

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Edit Informasi Outlet</h4>
                        <div>
                            <button type="button" id="cancelButton" class="btn btn-outline-secondary me-2 rounded-pill">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                        </div>
                    </div>

                    <div class="row g-3">
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
                            <div id="layanan-list">
                                @php
                                    $layananDetail = isset($outlet['layanan_detail']) && $outlet['layanan_detail'] ? json_decode($outlet['layanan_detail'], true) : [];
                                @endphp
                                @if(empty($layananDetail))
                                    <div class="row mb-2 layanan-item">
                                        <div class="col-md-5 mb-2 mb-md-0">
                                            <input type="text" class="form-control" name="layanan_detail[nama][]" placeholder="Nama Layanan" required>
                                        </div>
                                        <div class="col-md-6 mb-2 mb-md-0">
                                            <input type="text" class="form-control" name="layanan_detail[deskripsi][]" placeholder="Deskripsi Layanan" required>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-layanan" title="Hapus Layanan">&times;</button>
                                        </div>
                                    </div>
                                @else
                                    @foreach($layananDetail as $i => $layanan)
                                    <div class="row mb-2 layanan-item">
                                        <div class="col-md-5 mb-2 mb-md-0">
                                            <input type="text" class="form-control" name="layanan_detail[nama][]" value="{{ $layanan['nama'] }}" placeholder="Nama Layanan" required>
                                        </div>
                                        <div class="col-md-6 mb-2 mb-md-0">
                                            <input type="text" class="form-control" name="layanan_detail[deskripsi][]" value="{{ $layanan['deskripsi'] }}" placeholder="Deskripsi Layanan" required>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-layanan" title="Hapus Layanan">&times;</button>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-success btn-sm mt-2" id="add-layanan">Tambah Layanan</button>
                        </div>
                    </div>
                </form>

                <div id="viewMode">
                    <h4 class="fw-bold mb-4">Informasi Outlet</h4>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-3 p-3 h-100">
                                <h6 class="text-muted">Nama Outlet</h6>
                                <p class="fw-semibold">{{ $outlet['nama_outlet'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-3 p-3 h-100">
                                <h6 class="text-muted">Layanan Outlet</h6>
                                @php
                                    $layananDetail = isset($outlet['layanan_detail']) && $outlet['layanan_detail'] ? json_decode($outlet['layanan_detail'], true) : [];
                                @endphp
                                @if(!empty($layananDetail))
                                    <ul class="mb-0 ps-3">
                                        @foreach($layananDetail as $layanan)
                                            <li>
                                                <strong>{{ $layanan['nama'] }}</strong>
                                                @if(!empty($layanan['deskripsi']))
                                                    <span class="text-muted">- {{ $layanan['deskripsi'] }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="fw-semibold">-</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-light border-0 rounded-3 p-3">
                                <h6 class="text-muted">Deskripsi</h6>
                                <p class="fw-semibold">{{ $outlet['deskripsi_outlet'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-3 p-3 h-100">
                                <h6 class="text-muted">Nomor Layanan</h6>
                                <p class="fw-semibold">{{ $outlet['nomor_layanan'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-3 p-3 h-100">
                                <h6 class="text-muted">Alamat</h6>
                                <p class="fw-semibold">{{ $outlet['alamat_outlet'] }}</p>
                            </div>
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
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
}

.form-label {
    font-weight: 600;
    font-size: 0.9rem;
}

.form-control {
    border-radius: 0.5rem;
}

.btn {
    font-weight: 500;
    font-size: 0.9rem;
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
        layananItem.className = 'row mb-2 layanan-item';
        layananItem.innerHTML = `
            <div class="col-md-5 mb-2 mb-md-0">
                <input type="text" class="form-control" name="layanan_detail[nama][]" placeholder="Nama Layanan" required>
            </div>
            <div class="col-md-6 mb-2 mb-md-0">
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