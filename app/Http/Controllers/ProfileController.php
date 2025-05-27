<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $outlet = Outlet::where('user_id', $user->id)->first();

        if (!$outlet) {
            $outlet = [
                'nama_outlet' => 'Belum ada outlet',
                'alamat_outlet' => 'Belum ada alamat',
                'nomor_layanan' => 'Belum ada nomor',
                'layanan_laundry' => 'Belum ada layanan',
                'deskripsi_outlet' => 'Belum ada deskripsi',
                'image' => null
            ];
        }

        return view('admin.profil', compact('outlet'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $outlet = Outlet::where('user_id', $user->id)->first();

        if (!$outlet) {
            return redirect()->back()->with('error', 'Outlet tidak ditemukan');
        }

        $validatedData = $request->validate([
            'nama_outlet' => 'required|string',
            'alamat_outlet' => 'required|string',
            'nomor_layanan' => 'required|string',
            'layanan_laundry' => 'required|string',
            'deskripsi_outlet' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($outlet->image && file_exists(public_path($outlet->image))) {
                unlink(public_path($outlet->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/outlets'), $imageName);
            $validatedData['image'] = 'uploads/outlets/' . $imageName;
        }

        // Handle layanan_detail
        if ($request->has('layanan_detail')) {
            $namaArr = $request->input('layanan_detail.nama', []);
            $deskArr = $request->input('layanan_detail.deskripsi', []);
            $layananDetail = [];
            foreach ($namaArr as $i => $nama) {
                if (trim($nama) !== '' && isset($deskArr[$i])) {
                    $layananDetail[] = [
                        'nama' => $nama,
                        'deskripsi' => $deskArr[$i]
                    ];
                }
            }
            $validatedData['layanan_detail'] = json_encode($layananDetail, JSON_UNESCAPED_UNICODE);
        }

        $outlet->update($validatedData);

        // Ambil ulang data outlet dari database (opsional, untuk memastikan update)
        // $outlet = Outlet::where('user_id', $user->id)->first();

        return redirect()->route('profile')->with('success', 'Data outlet berhasil diperbarui');
    }

    public function delete()
    {
        $user = Auth::user();
        $outlet = Outlet::where('user_id', $user->id)->first();

        if (!$outlet) {
            return redirect()->back()->with('error', 'Outlet tidak ditemukan');
        }

        // Delete outlet image if exists
        if ($outlet->image && file_exists(public_path($outlet->image))) {
            unlink(public_path($outlet->image));
        }

        $outlet->delete();

        return redirect()->route('profile')->with('success', 'Outlet berhasil dihapus');
    }
}
