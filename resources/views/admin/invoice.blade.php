@extends('layouts.appadmin')

@section('content')

<div class="container py-5">
    <!-- Tombol Kembali -->
    <a href="{{ route('input.pesanan') }}" class="btn btn-secondary mb-3">Kembali</a>

    <button onclick="window.print()" class="btn btn-primary mb-3">Print Invoice</button> <!-- Tombol untuk cetak invoice -->

    <!-- Menampilkan Pesan Keberhasilan Pembayaran -->
    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Invoice Pesanan</h4>
        </div>
        <div class="card-body">
            <h5>Customer</h5>
            <table class="table">
                <tr>
                    <th style="text-align: left;">Nama</th>
                    <td style="text-align: left;">{{ $pesanan->nama_pelanggan }}</td>
                </tr>
            </table>

            <h5>Order</h5>
            <table class="table">
                <tr>
                    <th style="text-align: left;">Order Masuk</th>
                    <td style="text-align: left;">{{ $pesanan->tgl_order }}</td>
                </tr>
                <tr>
                    <th style="text-align: left;">Durasi Kerja</th>
                    <td style="text-align: left;">{{ $pesanan->waktu_kerja }}</td>
                </tr>
                <tr>
                    <th style="text-align: left;">Jenis Paket</th>
                    <td style="text-align: left;">{{ $pesanan->jenis_paket }}</td>
                </tr>
            </table>

            <h5>Order Details</h5>
            <table class="table">
                <tr>
                    <th style="text-align: left;">Berat (Kg)</th>
                    <td style="text-align: left;">{{ $pesanan->berat_kg }} Kg</td>
                </tr>
                <tr>
                    <th style="text-align: left;">Harga Per-Kg</th>
                    <td style="text-align: left;">Rp 6000</td>
                </tr>
                <tr>
                    <th style="text-align: left;">Total Bayar</th>
                    <td style="text-align: left;">Rp {{ number_format($total_bayar, 0, ',', '.') }}</td>
                </tr>
            </table>

            <!-- Tombol untuk membuka modal pembayaran -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#paymentModal">Bayar</button>
        </div>
    </div>
</div>

<!-- Modal QRIS -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Pembayaran Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Nomor Order: {{ $pesanan->no_order }}</h5>
                <p>Nominal Pembayaran: Rp {{ number_format($total_bayar, 0, ',', '.') }}</p>

                <!-- Menampilkan QRIS -->
                <div class="text-center mb-3">
                    <img src="{{ asset('gambar/qris.png') }}" alt="QRIS" class="img-fluid">
                    <p>Scan QRIS ini untuk menyelesaikan pembayaran.</p>
                </div>

                <!-- Tombol Next untuk melanjutkan ke halaman pembayaran berhasil -->
                <button class="btn btn-success w-100" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#paymentSuccessModal">Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembayaran Berhasil -->
<div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentSuccessModalLabel">Pembayaran Berhasil!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Terima kasih, pembayaran Anda telah berhasil diproses.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
