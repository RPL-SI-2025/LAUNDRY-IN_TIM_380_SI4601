@extends('layouts.app')

@section('content')
<div class="container py-4">
  <!-- Search dan Icon -->
  <div class="d-flex justify-content-end align-items-center mb-4">
    <div class="d-flex align-items-center gap-2">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari Outlet..." aria-label="Search">
        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
      </div>
      <a href="#" class="btn btn-outline-secondary">
        <i class="fas fa-filter"></i>
      </a>
      <a href="#" class="btn btn-light btn-sm rounded-circle" style="color: #ff4d6d;">
        <i class="far fa-heart"></i>
      </a>
    </div>
  </div>

  <!-- Container Cards -->
  <div class="row g-5">
    @for ($i = 0; $i < 8; $i++)
    <div class="col-12 col-md-6"> 
      <div class="card h-100 shadow" style="background-color: #15858f; color: white;">
        <img src="{{ asset('gambar/baju5.png') }}" class="card-img-top" alt="Laundry Image" style="height: 200px; object-fit: cover;">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title">FreshClean Laundry</h5>
            <p class="card-text">
              FreshClean Laundry menyediakan layanan cuci kilat, satuan, dan ekspres dengan teknologi modern. Menawarkan hasil cuci bersih, wangi, dan cepat.
            </p>
            <p class="card-text">
              <i class="fas fa-map-marker-alt"></i> Jl. Soekarno Hatta No. 45, Lowokwaru, Malang, Jawa Timur
            </p>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-center w-100">
              <a href="#" class="btn btn-warning text-white fw-bold">View Laundry</a>
            </div>
            <div class="d-flex align-items-center gap-2">
              <a href="#" class="btn btn-light btn-sm rounded-circle" style="color: #ff4d6d;">
                <i class="far fa-heart"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endfor
  </div>
</div>
@endsection
