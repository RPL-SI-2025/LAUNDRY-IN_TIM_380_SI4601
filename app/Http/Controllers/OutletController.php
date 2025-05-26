<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OutletController extends Controller
{
    // Method to display the form for creating a new outlet
    public function create()
    {
        return view('admin.input-outlet'); 
    }

    // Method to store the outlet data
    public function store(Request $request)
    {
        try {
            // Validate the form input
            $validated = $request->validate([
                'nama_outlet' => 'required|max:255',
                'alamat_outlet' => 'required',
                'nomor_layanan' => 'required',
                'layanan_laundry' => 'required',
                'deskripsi_outlet' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                
                // Make sure the uploads/outlets directory exists
                if (!file_exists(public_path('uploads/outlets'))) {
                    mkdir(public_path('uploads/outlets'), 0777, true);
                }
                
                // Move the uploaded image
                $image->move(public_path('uploads/outlets'), $imageName);
                $imagePath = 'uploads/outlets/' . $imageName;
            }

            // Create the outlet record
            $outlet = Outlet::create([
                'nama_outlet' => $request->nama_outlet,
                'alamat_outlet' => $request->alamat_outlet,
                'nomor_layanan' => $request->nomor_layanan,
                'layanan_laundry' => $request->layanan_laundry,
                'deskripsi_outlet' => $request->deskripsi_outlet,
                'user_id' => Auth::id(),
                'image' => $imagePath ?? null
            ]);

            if (!$outlet) {
                throw new \Exception('Failed to create outlet');
            }

            return redirect()->route('admin.home')->with('success', 'Outlet berhasil ditambahkan!');
        } catch (\Exception $e) {
            // If there's an error, delete the uploaded image if it exists
            if (isset($imagePath) && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan outlet: ' . $e->getMessage());
        }
    }
}
