<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers',
            'description' => 'required',
            'discount_amount' => 'required|numeric',
            'valid_until' => 'required|date',
            'max_uses' => 'required|integer|min:0'
        ]);

        // Convert checkbox value to boolean
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['current_uses'] = 0; // Set initial uses to 0

        Voucher::create($data);
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dibuat!');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    

    public function update(Request $request, Voucher $voucher)
    {
        // Validate the request
        $validated = $request->validate([
            'code' => 'required|unique:vouchers,code,' . $voucher->id,
            'description' => 'required',
            'discount_amount' => 'required|numeric|min:0',
            'valid_until' => 'required|date',
            'max_uses' => 'required|integer|min:0'
        ]);

        try {
            // Set is_active value from checkbox
            $validated['is_active'] = $request->has('is_active');

            // Update the voucher with validated data
            $voucher->update($validated);

            return redirect()
                ->route('admin.vouchers.index')
                ->with('success', 'Voucher berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui voucher.']);
        }
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus!');
    }

    // Customer facing methods
    public function showAvailable()
    {
        $vouchers = Voucher::where('is_active', true)
                          ->where('valid_until', '>', now())
                          ->where(function($query) {
                              $query->where('max_uses', 0)
                                    ->orWhere('current_uses', '<', DB::raw('max_uses'));
                          })
                          ->latest()  // This will order by newest first
                          ->get();

        return view('vouchers.available', compact('vouchers'));
    }

    public function claim(Request $request, Voucher $voucher)
    {
        if (!$voucher->is_active || $voucher->valid_until < now()) {
            return back()->with('error', 'Voucher tidak tersedia.');
        }

        if ($voucher->max_uses > 0 && $voucher->current_uses >= $voucher->max_uses) {
            return back()->with('error', 'Voucher sudah mencapai batas penggunaan.');
        }

        $voucher->increment('current_uses');
        return back()->with('success', 'Voucher berhasil diklaim!');
    }



    public function exportCsv()
    {
        $vouchers = Voucher::all();
        $filename = 'vouchers-' . date('Y-m-d') . '.csv';
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
    
        $columns = array('Kode', 'Deskripsi', 'Jumlah Diskon', 'Berlaku Sampai', 'Status', 'Penggunaan', 'Maksimal Penggunaan');
    
        $callback = function() use ($vouchers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
        
            foreach ($vouchers as $voucher) {
                fputcsv($file, array(
                    $voucher->code,
                    $voucher->description,
                    $voucher->discount_amount,
                    $voucher->valid_until->format('d M Y'),
                    $voucher->is_active ? 'Aktif' : 'Nonaktif',
                    $voucher->current_uses,
                    $voucher->max_uses ?: 'Unlimited'
                ));
            }
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }
}