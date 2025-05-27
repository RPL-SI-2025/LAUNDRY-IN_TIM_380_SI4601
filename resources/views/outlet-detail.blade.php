@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row mb-4">
    <div class="col-md-7">
      <img src="{{ asset($outlet->image) }}" class="img-fluid rounded shadow" alt="Outlet Image" style="width: 100%; max-height: 340px; object-fit: cover;">
    </div>
    <div class="col-md-5 d-flex flex-column justify-content-center">
      <h2 class="fw-bold" style="color: #15858f;">{{ $outlet->nama_outlet }}</h2>
      <p class="mt-3">{{ $outlet->deskripsi_outlet }}</p>
      <h5 class="fw-bold mt-4">Visi & Misi</h5>
      <ul>
        <li>Menyediakan layanan laundry berkualitas, cepat, dan ramah lingkungan.</li>
        <li>Memberikan pengalaman pelanggan yang nyaman dan terpercaya.</li>
        <li>Menjadi solusi utama kebutuhan laundry masyarakat modern.</li>
      </ul>
      <div class="mt-3">
        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> {{ $outlet->alamat_outlet }}</p>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $outlet->nomor_layanan) }}" target="_blank" class="btn btn-success mb-2"><i class="fab fa-whatsapp"></i> Chat WhatsApp</a>
        <span class="d-block"><i class="fas fa-phone-alt me-2"></i>{{ $outlet->nomor_layanan }}</span>
      </div>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-12">
      <h4 class="fw-bold mb-3">Layanan</h4>
      <div class="row g-4">
        @php
          $layananDetail = isset($outlet->layanan_detail) && $outlet->layanan_detail ? json_decode($outlet->layanan_detail, true) : [];
        @endphp
        @if(!empty($layananDetail))
          @foreach($layananDetail as $layanan)
          <div class="col-md-4">
            <div class="card h-100 shadow" style="background-color: #15858f; color: white;">
              <img src="{{ asset($outlet->image) }}" class="card-img-top" alt="{{ $layanan['nama'] }}">
              <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title">{{ $layanan['nama'] }}</h5>
                <p class="card-text">{{ $layanan['deskripsi'] }}</p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $outlet->nomor_layanan) }}" target="_blank" class="btn btn-warning text-white fw-bold rounded mt-3">Pilih Layanan</a>
              </div>
            </div>
          </div>
          @endforeach
        @else
        <div class="col-md-4">
          <div class="card h-100 shadow" style="background-color: #15858f; color: white;">
            <img src="{{ asset($outlet->image) }}" class="card-img-top" alt="Cuci Kiloan">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Cuci Kiloan</h5>
              <p class="card-text">Layanan laundry dengan sistem per kilogram, cocok untuk kebutuhan harian Anda.</p>
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $outlet->nomor_layanan) }}" target="_blank" class="btn btn-warning text-white fw-bold rounded mt-3">Pilih Layanan</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow" style="background-color: #15858f; color: white;">
            <img src="{{ asset($outlet->image) }}" class="card-img-top" alt="Cuci Satuan">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Cuci Satuan</h5>
              <p class="card-text">Layanan laundry untuk item tertentu seperti jas, bed cover, dan lainnya.</p>
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $outlet->nomor_layanan) }}" target="_blank" class="btn btn-warning text-white fw-bold rounded mt-3">Pilih Layanan</a>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection 