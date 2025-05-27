@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: #15858f;">Voucher Tersedia</h2>
            <p class="text-muted">Pilih dan klaim voucher untuk mendapatkan diskon pada pesanan Anda</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-4">
        @forelse($vouchers as $voucher)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title fw-bold" style="color: #15858f;">{{ $voucher->code }}</h5>
                            <p class="card-text text-muted mb-0">{{ $voucher->description }}</p>
                        </div>
                        <span class="badge bg-primary">Rp {{ number_format($voucher->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Berlaku sampai: {{ $voucher->valid_until->format('d M Y') }}
                        </small>
                        <br>
                        <small class="text-muted">
                            <i class="fas fa-refresh me-1"></i>
                            Sisa: {{ $voucher->max_uses - $voucher->current_uses }} kali
                        </small>
                    </div>

                    <form action="{{ route('vouchers.claim', $voucher) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="btn w-100" 
                                style="background-color: #15858f; color: white;"
                                {{ $voucher->max_uses > 0 && $voucher->current_uses >= $voucher->max_uses ? 'disabled' : '' }}>
                            {{ $voucher->max_uses > 0 && $voucher->current_uses >= $voucher->max_uses ? 'Voucher Habis' : 'Klaim Voucher' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="{{ asset('gambar/empty.png') }}" alt="No Vouchers" style="max-width: 200px; opacity: 0.5;">
            <p class="text-muted mt-3">Belum ada voucher yang tersedia</p>
        </div>
        @endforelse
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
    border-radius: 12px;
}

.card:hover {
    transform: translateY(-5px);
}

.btn {
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

.badge {
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 500;
}
</style>
@endsection