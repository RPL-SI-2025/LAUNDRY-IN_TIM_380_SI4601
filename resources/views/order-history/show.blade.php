@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Pesanan</h4>
                <a href="{{ route('order-history.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">No. Order</th>
                        <td>#{{ $order->no_order }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Order</th>
                        <td>{{ $order->tgl_order }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Paket</th>
                        <td>{{ $order->jenis_paket }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Kerja</th>
                        <td>{{ $order->waktu_kerja }}</td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td>{{ $order->berat_kg }} kg</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 
                                               ($order->status == 'processing' ? 'bg-primary' : 
                                               ($order->status == 'cancelled' ? 'bg-danger' : 'bg-warning')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>
                            <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 
                                               ($order->payment_status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Pembayaran</th>
                        <td class="fw-bold">Rp {{ number_format($order->berat_kg * 10000, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 