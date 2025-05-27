@extends('layouts.appadmin')

@section('content')
<div class="background-container">
    <div class="container py-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="row g-4">
            @foreach($pesanans as $pesanan)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Detail Pesanan</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $pesanan->id }}">
                                Edit Status
                            </button>
                        </div>

                        <div class="mb-3">
                            <p class="mb-1"><strong>Nama Customer:</strong> {{ $pesanan->nama_pelanggan }}</p>
                            <p class="mb-1"><strong>Tanggal Pesanan:</strong> {{ $pesanan->tgl_order }}</p>
                            <p class="mb-1"><strong>Jenis Pesanan:</strong> {{ $pesanan->jenis_paket }}</p>
                            <p class="mb-1"><strong>Berat:</strong> {{ $pesanan->berat_kg }} Kg</p>
                            <p class="mb-1"><strong>Status Pesanan:</strong> 
                                <span class="badge 
                                    {{ $pesanan->status == 'Pencucian' ? 'bg-info' : 
                                       ($pesanan->status == 'Pengeringan' ? 'bg-warning' : 'bg-success') }}">
                                    {{ $pesanan->status }}
                                </span>
                            </p>
                            <p class="mb-1"><strong>Status Pembayaran:</strong> 
                                <span class="badge {{ $pesanan->payment_status == 'Belum Bayar' ? 'bg-danger' : 'bg-success' }}">
                                    {{ $pesanan->payment_status }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pesanan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $pesanan->id }}">Edit Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('pesanan.update-status', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_pelanggan" class="form-label">Nama Customer</label>
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ $pesanan->nama_pelanggan }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_order" class="form-label">Tanggal Pesanan</label>
                                    <input type="date" class="form-control" id="tgl_order" name="tgl_order" value="{{ $pesanan->tgl_order }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_paket" class="form-label">Jenis Pesanan</label>
                                    <select class="form-select" id="jenis_paket" name="jenis_paket" required>
                                        <option value="Cuci Kiloan" {{ $pesanan->jenis_paket == 'Cuci Kiloan' ? 'selected' : '' }}>Cuci Kiloan</option>
                                        <option value="Cuci Satuan" {{ $pesanan->jenis_paket == 'Cuci Satuan' ? 'selected' : '' }}>Cuci Satuan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="berat_kg" class="form-label">Berat (Kg)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="berat_kg" name="berat_kg" value="{{ $pesanan->berat_kg }}" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="decrementBerat({{ $pesanan->id }})">-</button>
                                        <button class="btn btn-outline-secondary" type="button" onclick="incrementBerat({{ $pesanan->id }})">+</button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Pesanan</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Pencucian" {{ $pesanan->status == 'Pencucian' ? 'selected' : '' }}>Pencucian</option>
                                        <option value="Pengeringan" {{ $pesanan->status == 'Pengeringan' ? 'selected' : '' }}>Pengeringan</option>
                                        <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="payment_status" class="form-label">Status Pembayaran</label>
                                    <select class="form-select" id="payment_status" name="payment_status" required>
                                        <option value="Belum Bayar" {{ $pesanan->payment_status == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                        <option value="Sudah Bayar" {{ $pesanan->payment_status == 'Sudah Bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary btn-confirm-update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Kirim Notifikasi -->
<div id="confirmModal" class="modal" tabindex="-1" style="display:none; background:rgba(0,0,0,0.5);">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="text-align:center;">
      <div class="modal-body">
        <h5>Kirim notifikasi kepada Customer<br>Pesanan Selesai?</h5>
        <button id="noBtn" class="btn btn-secondary">No</button>
        <button id="yesBtn" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<style>
.background-container {
    background-color: #f8f9fa;
    min-height: 100vh;
}

.card {
    border-radius: 10px;
    border: none;
}

.badge {
    padding: 0.5em 1em;
    border-radius: 20px;
}

.modal-content {
    border-radius: 10px;
    border: none;
}

.btn {
    border-radius: 5px;
}

.form-control, .form-select {
    border-radius: 5px;
}
</style>

<script>
function incrementBerat(id) {
    const input = document.querySelector(`#editModal${id} input[name="berat_kg"]`);
    input.value = parseInt(input.value) + 1;
}

function decrementBerat(id) {
    const input = document.querySelector(`#editModal${id} input[name="berat_kg"]`);
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

document.querySelectorAll('.btn-confirm-update').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = btn.closest('form');
        document.getElementById('confirmModal').style.display = 'block';
        document.getElementById('yesBtn').onclick = function() {
            document.getElementById('confirmModal').style.display = 'none';
            form.submit();
        };
        document.getElementById('noBtn').onclick = function() {
            document.getElementById('confirmModal').style.display = 'none';
        };
    });
});
</script>
@endsection
