@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Voucher</h2>
        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Voucher
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Diskon</th>
                        <th>Berlaku Sampai</th>
                        <th>Status</th>
                        <th>Penggunaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
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
                            <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus voucher ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection