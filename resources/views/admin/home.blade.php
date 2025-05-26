@extends('layouts.appadmin')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="fw-bold mb-3">
          Solution for your <span style="color: #15858f;">Laundry-In</span> Service
        </h1>
        <p class="text-justify" style="font-size: 1.1rem;">
          Laundry-In menghadirkan layanan laundry modern dengan sistem pelacakan status secara real-time, input pesanan cepat, dan pelayanan profesional.
        </p>
      </div>
      <div class="col-lg-6 text-center">
        <img src="{{ asset('gambar/baju1.png') }}" alt="Laundry Illustration" class="img-fluid" style="max-width: 90%;">
      </div>
    </div>
  </div>
</section>

<!-- Info Section -->
<div class="container-fluid px-5 pb-4">
  <div class="row align-items-center">
    <div class="col-md-6 text-center">
      <img src="{{ asset('gambar/baju2.png') }}" alt="Laundry Illustration" class="img-fluid" style="max-width: 90%;">
    </div>
    <div class="col-md-6">
      <h1 class="fw-bold mb-3"><span style="color: #15858f;">Laundry-In</span> memberikan kemudahan layanan laundry!</h1>
      <p>Kami menyediakan fitur unggulan seperti mencari laundry terdekat, berbagai layanan laundry berkualitas, dan pelacakan status laundry secara real-time.</p>
    </div>
  </div>
</div>

<!-- Fitur Section -->
<div class="container-fluid px-5 pb-5">
  <h3 class="text-center mb-4">Fiturs</h3>
  <div class="row g-4">
    
    <div class="col-md-6">
      <div class="fitur-box text-center">
        <a href="{{ url('input-pesanan') }}" class="text-decoration-none" style="color: inherit;">
          <i class="fas fa-sign-out-alt fitur-icon mb-3"></i>
        </a>
        <h4>Input Pesanan</h4>
        <p>Input Pesanan memungkinkan pelanggan untuk memasukkan pesanan laundry dengan mudah dan cepat.</p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="fitur-box text-center">
        <a href="{{ url('/pelacakan-status') }}" class="text-decoration-none" style="color: inherit;">
          <i class="fas fa-gear fitur-icon mb-3"></i>
        </a>
        <h4>Pelacakan Status</h4>
        <p>Fitur pelacakan status memberikan informasi secara real-time mengenai status pengerjaan laundry Anda.</p>
      </div>
    </div>

  </div>
</div>
@endsection
