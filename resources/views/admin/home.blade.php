@extends('layouts.appadmin')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-4">
                    Solution for your <span style="color: #15858f;">Laundry-In</span> Service
                </h1>
                <p class="lead text-muted">
                    Laundry-In menghadirkan layanan laundry modern dengan sistem pelacakan status secara real-time, 
                    input pesanan cepat, dan pelayanan profesional.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('gambar/baju1.png') }}" alt="Laundry Hero" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <img src="{{ asset('gambar/baju2.png') }}" alt="Laundry Services" class="img-fluid mb-4 mb-lg-0">
        </div>
        <div class="col-lg-6">
            <h2 class="h3 fw-bold mb-4">
                <span style="color: #15858f;">Laundry-In</span> memberikan kemudahan layanan laundry!
            </h2>
            <p class="text-muted">
                Kami menyediakan fitur unggulan seperti mencari laundry terdekat, berbagai layanan laundry berkualitas, 
                dan pelacakan status laundry secara real-time.
            </p>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container py-5">
    <h3 class="text-center fw-bold mb-5">Fitur Unggulan</h3>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <a href="{{ url('input-pesanan') }}" class="text-decoration-none">
                        <i class="fas fa-sign-out-alt fs-1 mb-3" style="color: #15858f;"></i>
                        <h4 class="card-title fw-bold mb-3">Input Pesanan</h4>
                        <p class="card-text text-muted">
                            Input Pesanan memungkinkan pelanggan untuk memasukkan pesanan laundry dengan mudah dan cepat.
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <a href="{{ url('/pelacakan-status') }}" class="text-decoration-none">
                        <i class="fas fa-gear fs-1 mb-3" style="color: #15858f;"></i>
                        <h4 class="card-title fw-bold mb-3">Pelacakan Status</h4>
                        <p class="card-text text-muted">
                            Fitur pelacakan status memberikan informasi secara real-time mengenai status pengerjaan laundry Anda.
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.3s ease;
    border-radius: 15px;
}
.hover-card:hover {
    transform: translateY(-5px);
}
.card-body a {
    color: inherit;
}
</style>
@endsection