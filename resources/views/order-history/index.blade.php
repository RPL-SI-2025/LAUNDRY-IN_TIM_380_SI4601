@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-white">
            <h4 class="mb-0">Riwayat Pesanan</h4>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <form action="{{ route('order-history.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Cari No. Order</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan no. order" class="form-control">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal</th>
                            <th>Jenis Paket</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->no_order }}</td>
                                <td>{{ $order->tgl_order }}</td>
                                <td>{{ $order->jenis_paket }}</td>
                                <td>
                                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 
                                                       ($order->status == 'processing' ? 'bg-primary' : 
                                                       ($order->status == 'cancelled' ? 'bg-danger' : 'bg-warning')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($order->berat_kg * 10000, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('order-history.show', $order) }}" class="btn btn-sm btn-info text-white">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Tidak ada pesanan yang ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 