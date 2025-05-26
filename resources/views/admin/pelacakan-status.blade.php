@extends('layouts.appadmin')

@section('content')

<div class="background-container">
  <div class="container py-5 d-flex justify-content-center">
    <div class="row">
      @foreach($pesanans as $pesanan)
      <div class="col-md-6 mb-4"> <!-- 2 card per baris -->
        <!-- Card memanjang -->
        <div class="card" style="border-radius: 10px; background-color: #00aaff; color: white; height: 300px;"> <!-- Memanfaatkan height langsung di dalam tag card -->
          <div class="card-body d-flex flex-column justify-content-between">
            <h5 class="card-title">{{ $pesanan->nama_pelanggan }}</h5>
            <p class="card-text">{{ $pesanan->jenis_paket }} - {{ $pesanan->berat_kg }} pcs</p>
            <p class="card-text">{{ $pesanan->tgl_order }}</p>
            <p>Status: 
              <span class="badge bg-warning">Pengeringan</span>
            </p>
            <div class="d-flex justify-content-between">
              <a href="{{ route('pesanan.detail', $pesanan->id) }}" class="btn btn-info btn-sm">Edit</a>
              <form action="{{ route('pesanan.hapus', $pesanan->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
