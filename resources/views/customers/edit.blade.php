<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Customer</title>
    {{-- Link CSS Bootstrap (Anda mungkin sudah punya ini di layout utama) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('gambar/background.jpg') }}'); /* Ganti dengan path gambar latar belakang Anda */
            background-size: 100%;
            background-position: center;
        }
        .form-container {
            background-color: white;
            padding: 2rem; /* p-8 */
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* shadow-lg */
            width: 100%;
            max-width: 480px; /* max-w-md */
        }
        .btn-custom-teal {
            background-color: #1a4d46; /* Mirip dengan warna di gambar (teal tua) */
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem; /* py-2 px-4 */
            border-radius: 0.5rem; /* rounded-lg */
            border: none;
            width: 100%;
        }
        .btn-custom-teal:hover {
            background-color: #143b36; /* Warna lebih gelap saat hover */
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light"> {{-- flex items-center justify-center min-h-screen bg-gray-200 --}}
    <div class="form-container">
        <div class="back-button-container">
                <a href="{{ route('customers.index') }}" class="back-button">
                    {{-- Ikon Panah Kiri (SVG sederhana) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                </a>
                <h2 class="fs-3 fw-bold mb-0">Edit Data Customer</h2> {{-- Tambahkan mb-0 --}}
            </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong class="fw-bold">Oops!</strong>
                Ada beberapa masalah dengan input Anda.
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk metode PUT untuk update --}}
            <div class="mb-3">
                <label for="nama_cust" class="form-label fw-semibold">Nama Customer</label>
                <input type="text" name="nama_cust" id="nama_cust" class="form-control" value="{{ old('nama_cust', $customer->nama_cust) }}">
            </div>
            <div class="mb-3">
                <label for="alamat_cust" class="form-label fw-semibold">Alamat</label>
                <input type="text" name="alamat_cust" id="alamat_cust" class="form-control" value="{{ old('alamat_cust', $customer->alamat_cust) }}">
            </div>
            <div class="mb-3">
                <label for="nomor_cust" class="form-label fw-semibold">No Handphone</label>
                <input type="text" name="nomor_cust" id="nomor_cust" class="form-control" value="{{ old('nomor_cust', $customer->nomor_cust) }}">
            </div>
            <div class="mb-4">
                <label for="tglmasuk_cust" class="form-label fw-semibold">Tanggal Masuk</label>
                <input type="date" name="tglmasuk_cust" id="tglmasuk_cust" class="form-control" value="{{ old('tglmasuk_cust', \Carbon\Carbon::parse($customer->tglmasuk_cust)->format('Y-m-d')) }}">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-custom-teal">Update</button>
            </div>
        </form>
    </div>
    {{-- Link JavaScript Bootstrap (Anda mungkin sudah punya ini di layout utama) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>