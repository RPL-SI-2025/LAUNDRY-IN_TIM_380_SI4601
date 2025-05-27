@extends('layouts.app')

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

<!-- Outlet Section -->
<div class="container-fluid px-5 pb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Outlet</h3>
    <a href="{{ route('outlets.index') }}" class="text-decoration-none" style="color: #15858f;">See all</a>
  </div>

  <div class="row g-4 text-center">
    @foreach($outlets as $outlet)
    <div class="col-md-4">
      <div class="card h-100 shadow" style="background-color: #15858f; color: white;">
        <img src="{{ asset($outlet->image) }}" class="card-img-top" alt="Laundry Image">
        <div class="card-body">
          <h5 class="card-title">{{ $outlet->nama_outlet }}</h5>
          <p class="card-text">{{ $outlet->deskripsi_outlet }}</p>
          <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $outlet->alamat_outlet }}</p>
          <a href="{{ route('outlets.show', $outlet->id) }}" class="btn btn-warning text-white fw-bold rounded">View Laundry</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection
