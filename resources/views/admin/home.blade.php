@extends('layouts.appadmin')

@section('content')
<div class="background-container">
  <div class="container py-5 d-flex flex-column align-items-center justify-content-center">
    <h2 class="mb-5 fw-bold text-center">{{ $outlet->nama_outlet ?? 'Nama Outlet' }}</h2>
    <div class="row justify-content-center w-100 gap-4" style="max-width: 900px;">
      <div class="col-md-5">
        <a href="{{ url('input-pesanan') }}" class="text-decoration-none">
          <div class="card shadow text-center p-4 h-100" style="background: #388896; color: #fff; border-radius: 18px; min-height: 320px;">
            <div class="mb-3">
              <i class="fas fa-sign-out-alt" style="font-size: 3rem;"></i>
            </div>
            <h4 class="fw-bold mb-2">Input Pesanan</h4>
            <p style="font-size: 1rem;">Input Pesanan memungkinkan pelanggan memasukkan detail laundry dengan mudah, termasuk jenis layanan, jumlah pakaian, dan metode pengambilan.</p>
          </div>
        </a>
      </div>
      <div class="col-md-5">
        <a href="{{ url('/pelacakan-status') }}" class="text-decoration-none">
          <div class="card shadow text-center p-4 h-100" style="background: #388896; color: #fff; border-radius: 18px; min-height: 320px;">
            <div class="mb-3">
              <i class="fas fa-gear" style="font-size: 3rem;"></i>
            </div>
            <h4 class="fw-bold mb-2">Pelacakan Status</h4>
            <p style="font-size: 1rem;">Anda dapat memantau proses laundry secara real-time, mulai dari pencucian hingga siap diantar. Semua bisa dipantau dengan mudah.</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

      <div class="col-md-5">
        <a href="{{ route('admin.vouchers.index') }}" class="text-decoration-none">
          <div class="card shadow text-center p-4 h-100" style="background: #388896; color: #fff; border-radius: 18px; min-height: 320px;">
            <div class="mb-3">
              <i class="fas fa-ticket-alt" style="font-size: 3rem;"></i>
            </div>
            <h4 class="fw-bold mb-2">Kelola Voucher</h4>
            <p style="font-size: 1rem;">Manajemen voucher diskon untuk pelanggan, termasuk pembuatan, pengeditan, dan pemantauan penggunaan voucher.</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
