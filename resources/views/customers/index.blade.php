<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer</title>
    {{-- Link CSS Bootstrap (Anda mungkin sudah punya ini di layout utama) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles untuk menyesuaikan tampilan jika perlu */
        .customer-card {
            background-color: #2e8b57; /* Warna hijau tua */
            color: white;
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* shadow-md */
            padding: 1.5rem; /* p-6 */
            display: flex;
            align-items: flex-start;
            gap: 1rem; /* space-x-4 */
        }
        .customer-card .edit-btn {
            background-color: #1e7157; /* Hijau sedikit gelap */
            color: white;
            padding: 0.5rem 1rem; /* px-4 py-2 */
            border-radius: 0.5rem; /* rounded-lg */
            font-size: 0.875rem; /* text-sm */
            text-align: center;
            display: block; /* Agar setiap tombol ada di baris baru */
            margin-bottom: 0.5rem; /* Jarak antar tombol */
        }
        .customer-card .delete-btn {
            background-color: #ef4444; /* Merah */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            text-align: center;
            width: 100%; /* Agar lebarnya sama dengan edit-btn */
            border: none; /* Hapus border default button */
        }
        .customer-card .delete-btn:hover, .customer-card .edit-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body class="bg-light p-4"> {{-- bg-gray-100 p-8 --}}
    <div class="container mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-4"> {{-- flex justify-between items-center mb-6 --}}
            <div class="back-button-container">
                <a href="{{ url('admin/home') }}" class="back-button">
                    {{-- Ikon Panah Kiri (SVG sederhana) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-800 mb-0">Data Customer</h1> {{-- Tambahkan mb-0 untuk menghilangkan margin bawah default h1 --}}
            </div>
            <div class="position-relative">
                <input type="text" placeholder="Search..." class="form-control ps-4 pe-5" style="border-radius: 0.5rem;"> {{-- border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 --}}
                <svg class="position-absolute end-0 top-50 translate-middle-y me-3" style="width: 20px; height: 20px; color: #ced4da;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4"> {{-- grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 --}}
            @forelse ($customers as $customer)
                <div class="col">
                    <div class="customer-card">
                        <div class="flex-shrink-0">
                            <svg class="h-16 w-16 text-white" style="height: 64px; width: 64px;" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1">
                            <p class="font-weight-bold fs-5 mb-1">{{ $customer->nama_cust }}</p> {{-- font-semibold text-xl mb-1 --}}
                            <p class="fs-6 mb-1">{{ $customer->alamat_cust }}</p> {{-- text-sm mb-1 --}}
                            <p class="fs-6 mb-1">{{ $customer->nomor_cust }}</p> {{-- text-sm mb-1 --}}
                            <p class="fs-6">{{ \Carbon\Carbon::parse($customer->tglmasuk_cust)->format('d/m/Y') }}</p> {{-- text-sm --}}
                        </div>
                        <div class="d-flex flex-column" style="gap: 0.5rem;"> {{-- flex flex-col space-y-2 --}}
                            <a href="{{ route('customers.edit', $customer->id) }}" class="edit-btn">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data Customer {{ $customer->nama_customer }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-secondary">Belum ada data customer.</p> {{-- text-gray-600 --}}
                </div>
            @endforelse
        </div>

        <div class="position-fixed bottom-0 end-0 p-4"> {{-- fixed bottom-8 right-8 --}}
            <a href="{{ route('customers.create') }}" class="btn btn-primary rounded-circle shadow-lg" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: #0d6efd;"> {{-- bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-full shadow-lg --}}
                <svg class="w-6 h-6" style="width: 24px; height: 24px;" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>

    {{-- Link JavaScript Bootstrap (Anda mungkin sudah punya ini di layout utama) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>