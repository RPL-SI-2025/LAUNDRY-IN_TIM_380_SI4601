@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" style="color: #15858f;">Manajemen Voucher</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.vouchers.export') }}" class="btn btn-success">
                <i class="fas fa-file-export me-2"></i> Export CSV
            </a>
            <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Tambah Voucher
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Voucher Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Diskon</th>
                            <th>Berlaku Sampai</th>
                            <th>Status</th>
                            <th>Penggunaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vouchers as $voucher)
                        <tr>
                            <td>{{ $voucher->code }}</td>
                            <td>{{ $voucher->description }}</td>
                            <td>Rp {{ number_format($voucher->discount_amount, 0, ',', '.') }}</td>
                            <td>{{ $voucher->valid_until->format('d M Y') }}</td>
                            <td>
                                <span class="badge {{ $voucher->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $voucher->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>{{ $voucher->current_uses }}/{{ $voucher->max_uses ?: '∞' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.vouchers.edit', $voucher) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vouchers.destroy', $voucher) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus voucher ini?');">
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
                            <td colspan="7" class="text-center text-muted">
                                Belum ada voucher yang tersedia
                            </td>
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
}
</style>
@endsection
