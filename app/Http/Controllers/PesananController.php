<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        // Mengambil semua data pesanan dari database
        $pesanans = Pesanan::all();

        // Kirim data pesanan ke view tampil-pesanan
        return view('admin.tampil-pesanan', compact('pesanans'));
    }

    // Menampilkan form untuk menambah pesanan
    public function create()
    {
        return view('admin.input-pesanan');
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        // Ambil pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
        
        // Hitung total bayar berdasarkan berat dan harga per kilogram
        $total_bayar = $pesanan->berat_kg * 6000; 

        return view('admin.invoice', compact('pesanan', 'total_bayar'));
    }

    // Menghapus pesanan
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('input.pesanan')->with('success', 'Pesanan berhasil dihapus');
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_order' => 'required',
            'tgl_order' => 'required|date',
            'nama_pelanggan' => 'required',
            'jenis_paket' => 'required',
            'waktu_kerja' => 'required',
            'berat_kg' => 'required|numeric',
        ]);

        Pesanan::create([
            'no_order' => $validated['no_order'],
            'tgl_order' => $validated['tgl_order'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'jenis_paket' => $validated['jenis_paket'],
            'waktu_kerja' => $validated['waktu_kerja'],
            'berat_kg' => $validated['berat_kg'],
            'status' => 'Pencucian', // Default status
            'payment_status' => 'Belum Bayar' // Default payment status
        ]);

        return redirect()->route('input.pesanan')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // Menangani pembayaran
    public function processPayment(Request $request)
    {
        // Validasi nominal pembayaran
        $validated = $request->validate([
            'nominal' => 'required|numeric|min:1',
        ]);

        // Temukan pesanan berdasarkan order_id
        $pesanan = Pesanan::findOrFail($request->order_id);

        // Update status pesanan menjadi 'dibayar'
        $pesanan->status = 'dibayar';
        $pesanan->save();

        // Redirect ke halaman invoice setelah pembayaran berhasil
        return redirect()->route('admin.invoice', ['id' => $pesanan->id])->with('success', 'Pembayaran Berhasil!');
    }

    // Menampilkan pelacakan status pesanan
    public function pelacakanStatus()
    {
        $pesanans = Pesanan::all(); 
        return view('admin.pelacakan-status', compact('pesanans'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'tgl_order' => 'required|date',
            'jenis_paket' => 'required',
            'berat_kg' => 'required|numeric',
            'status' => 'required',
            'payment_status' => 'required'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'tgl_order' => $request->tgl_order,
            'jenis_paket' => $request->jenis_paket,
            'berat_kg' => $request->berat_kg,
            'status' => $request->status,
            'payment_status' => $request->payment_status
        ]);

        return redirect()->route('pelacakan.status')->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Menampilkan pelacakan status untuk customer
    public function customerLacakPesanan()
    {
        $pesanans = Pesanan::all(); 
        return view('customer.lacak-pesanan', compact('pesanans'));
    }
}
