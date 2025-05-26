@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <img src="{{ asset('gambar/baju3.jpg') }}" alt="Laundry Illustration" class="img-fluid rounded" style="max-width: 100%;">
      </div>
      <div class="col-lg-6">
        <h2 class="fw-bold" style="color: #15858f;">FreshClean Laundry</h2>
        <p class="text-justify" style="font-size: 1.1rem;">
          FreshClean Laundry didirikan pada tahun 2018 dengan tujuan memberikan layanan laundry berkualitas tinggi bagi masyarakat Malang. Berawal dari usaha kecil, kini FreshClean Laundry telah berkembang menjadi salah satu penyedia layanan terpercaya dengan peralatan modern dan tenaga profesional.
        </p>
        <p class="text-justify" style="font-size: 1.1rem;">
          Kami memahami pentingnya pakaian yang bersih, wangi, dan terawat, sehingga setiap proses pengerjaan kami dilakukan dengan standar tinggi.
        </p>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-6">
        <h5 class="fw-bold">Visi & Misi:</h5>
        <p><strong>Visi:</strong> Menjadi penyedia layanan laundry terbaik dan terpercaya di Malang.</p>
        <p><strong>Misi:</strong></p>
        <ul>
          <li>Memberikan hasil laundry berkualitas tinggi dengan harga terjangkau.</li>
          <li>Menggunakan teknologi modern untuk pencucian yang lebih efisien.</li>
          <li>Menyediakan layanan antar-jemput gratis.</li>
          <li>Berorientasi pada lingkungan dengan penggunaan produk ramah lingkungan.</li>
        </ul>
        <p class="mt-3">
          <i class="fas fa-map-marker-alt text-danger"></i> Alamat: Jl. Soekarno Hatta No. 45, Lowokwaru, Malang<br>
          <i class="fas fa-phone-alt text-success"></i> 0812-3456-7890
        </p>
      </div>
      <div class="col-md-6 text-center">
        <img src="{{ asset('gambar/baju4.jpg') }}" alt="Laundry Outlet" class="img-fluid rounded" style="max-width: 90%;">
      </div>
    </div>
  </div>
</section>

<!-- Layanan Section -->
<section class="py-5 bg-light">
    <div class="container">
      <h3 class="mb-5 fw-bold">Layanan</h3>
      <div class="row g-4">
        
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0 text-center" style="background-color: #0E6A80; color: white; border-radius: 12px;">
            <img src="{{ asset('gambar/baju5.png') }}" class="card-img-top" alt="Satuan" style="height: 200px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Kiloan</h5>
              <p class="card-text">Layanan laundry ekonomis untuk mencuci pakaian dalam jumlah banyak. Termasuk pencucian, pengeringan, dan penyetrikaan dengan teknologi modern untuk hasil bersih dan wangi.</p>
              <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Kiloan%20Laundry-In" class="btn btn-warning text-white">Pilih Laundry</a>
            </div>
          </div>
        </div>
  
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0 text-center" style="background-color: #0E6A80; color: white; border-radius: 12px;">
            <img src="{{ asset('gambar/baju6.png') }}" class="card-img-top" alt="Satuan" style="height: 200px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Satuan</h5>
              <p class="card-text">Cocok untuk pakaian atau barang berbahan khusus seperti jas, gaun, dan bed cover. Menggunakan metode pencucian yang aman agar tetap terawat dan tahan lama.</p>
              <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Satuan%20Laundry-In" class="btn btn-warning text-white">Pilih Laundry</a>
            </div>
          </div>
        </div>
  
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0 text-center" style="background-color: #0E6A80; color: white; border-radius: 12px;">
            <img src="{{ asset('gambar/baju7.png') }}" class="card-img-top" alt="Satuan" style="height: 200px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Express</h5>
              <p class="card-text">Solusi cepat bagi yang butuh pakaian bersih dalam waktu singkat. Dengan proses pencucian dan pengeringan modern, pakaian siap pakai hanya dalam beberapa jam.</p>
              <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Express%20Laundry-In" class="btn btn-warning text-white">Pilih Laundry</a>
            </div>
          </div>
        </div>
  
      </div>
    </div>
</section>

@endsection
