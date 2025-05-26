@extends('layouts.appadmin')

@section('content')

<div class="background-container">
  <div class="container py-5 d-flex justify-content-center">
    <div class="form-wrapper bg-white p-5 rounded shadow" style="width: 100%; max-width: 1000px;">

      <!-- Menampilkan Pesan Sukses jika ada -->
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif

      <!-- Tombol Tambah Pesanan -->
      <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('input.pesanan') }}" class="btn btn-primary">(+) Tambah Pesanan</a>
      </div>

      <!-- Tabel Order Pesanan -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id</th>
            <th>No Orderan</th>
            <th>Tgl Order</th>
            <th>Nama Pelanggan</th>
            <th>Jenis Paket</th>
            <th>Waktu Kerja</th>
            <th>Berat (Kg)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pesanans as $key => $pesanan)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $pesanan->no_order }}</td>
            <td>{{ $pesanan->tgl_order }}</td>
            <td>{{ $pesanan->nama_pelanggan }}</td>
            <td>{{ $pesanan->jenis_paket }}</td>
            <td>{{ $pesanan->waktu_kerja }}</td>
            <td>{{ $pesanan->berat_kg }} Kg</td>
            <td>
              <a href="{{ route('pesanan.detail', $pesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
