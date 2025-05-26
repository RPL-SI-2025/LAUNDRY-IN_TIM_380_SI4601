@extends('layouts.appadmin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="text-center fw-bold mb-4" style="color: #15858f;">Tambah Pesanan Laundry</h2>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('pesanan.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="no_order" class="form-label">No Orderan</label>
                                <input type="text" class="form-control" id="no_order" name="no_order" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_order" class="form-label">Tanggal Order</label>
                                <input type="date" class="form-control" id="tgl_order" name="tgl_order" required>
                            </div>
                            <div class="col-12">
                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_paket" class="form-label">Jenis Paket</label>
                                <select class="form-select" id="jenis_paket" name="jenis_paket" required>
                                    <option value="" selected disabled>Pilih Jenis Paket</option>
                                    <option value="Cuci Kiloan">Cuci Kiloan</option>
                                    <option value="Cuci Satuan">Cuci Satuan</option>
                                    <option value="Cuci Express">Cuci Express</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="berat_kg" class="form-label">Berat (Kg)</label>
                                <input type="number" class="form-control" id="berat_kg" name="berat_kg" required>
                            </div>
                            <div class="col-12">
                                <label for="waktu_kerja" class="form-label">Waktu Kerja</label>
                                <input type="text" class="form-control" id="waktu_kerja" name="waktu_kerja" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Simpan Pesanan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus, .form-select:focus {
    border-color: #15858f;
    box-shadow: 0 0 0 0.25rem rgba(21, 133, 143, 0.25);
}
.btn-primary {
    background-color: #15858f;
    border-color: #15858f;
}
.btn-primary:hover {
    background-color: #0d6a72;
    border-color: #0d6a72;
}
</style>
@endsection