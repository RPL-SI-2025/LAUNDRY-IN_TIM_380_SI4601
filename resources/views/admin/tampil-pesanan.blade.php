@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0" style="color: #15858f;">Data Pesanan</h1>
                <a href="{{ route('input.pesanan') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Pesanan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Berat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanans as $pesanan)
                        <tr>
                            <td>{{ $pesanan->no_order }}</td>
                            <td>{{ $pesanan->tgl_order }}</td>
                            <td>{{ $pesanan->nama_pelanggan }}</td>
                            <td>{{ $pesanan->jenis_paket }}</td>
                            <td>{{ $pesanan->berat_kg }} Kg</td>
                            <td>
                                <span class="badge bg-primary">{{ $pesanan->status }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('pesanan.edit', $pesanan->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pesanan.destroy', $pesanan->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada pesanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.btn-primary {
    background-color: #15858f;
    border-color: #15858f;
}
.btn-primary:hover {
    background-color: #0d6a72;
    border-color: #0d6a72;
}
.btn-outline-primary {
    color: #15858f;
    border-color: #15858f;
}
.btn-outline-primary:hover {
    background-color: #15858f;
    border-color: #15858f;
    color: white;
}
</style>
@endsection