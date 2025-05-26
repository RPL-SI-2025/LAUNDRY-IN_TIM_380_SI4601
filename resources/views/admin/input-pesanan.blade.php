@extends('layouts.appadmin')

@section('content')

<div class="background-container">
  <div class="container py-5 d-flex justify-content-center">
    <div class="form-wrapper bg-white p-5 rounded shadow" style="width: 100%; max-width: 1000px;">

      <h4 class="mb-4 text-center">Tambah Pesanan Laundry</h4>

      <!-- Form Input Pesanan -->
      <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="no_order" class="form-label">No Orderan</label>
          <input type="text" class="form-control" id="no_order" name="no_order" required>
        </div>

        <div class="mb-3">
          <label for="tgl_order" class="form-label">Tanggal Order</label>
          <input type="date" class="form-control" id="tgl_order" name="tgl_order" required>
        </div>

        <div class="mb-3">
          <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
          <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>

        <div class="mb-3">
          <label for="jenis_paket" class="form-label">Jenis Paket</label>
          <select class="form-select" id="jenis_paket" name="jenis_paket" required>
            <option selected disabled>Pilih Jenis Paket</option>
            <option value="Cuci Kiloan">Cuci Kiloan</option>
            <option value="Cuci Satuan">Cuci Satuan</option>
            <option value="Cuci Express">Cuci Express</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="waktu_kerja" class="form-label">Waktu Kerja</label>
          <input type="text" class="form-control" id="waktu_kerja" name="waktu_kerja" required>
        </div>

        <div class="mb-3">
          <label for="berat_kg" class="form-label">Berat (Kg)</label>
          <input type="number" class="form-control" id="berat_kg" name="berat_kg" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan Pesanan</button>
      </form>

    </div>
  </div>
</div>

@endsection
