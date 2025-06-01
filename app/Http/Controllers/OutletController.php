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

    // Method to display all outlets (for customers)
    public function index()
    {
        $outlets = Outlet::all();
        return view('outlet', compact('outlets'));
    }

    // Method to toggle favorite status for an outlet
    public function toggleFavorite(Outlet $outlet)
    {
        $user = Auth::user();
        $isFavorited = $user->favoriteOutlets()->where('outlet_id', $outlet->id)->exists();

        if ($isFavorited) {
            // Remove from favorites
            $user->favoriteOutlets()->detach($outlet->id);
            $message = 'Outlet removed from favorites.';
            $favorited = false;
        } else {
            // Add to favorites
            $user->favoriteOutlets()->attach($outlet->id);
            $message = 'Outlet added to favorites.';
            $favorited = true;
        }

        return response()->json(['success' => true, 'message' => $message, 'favorited' => $favorited]);
    }

    // Method to display favorite outlets for the authenticated user
    public function favoriteOutlets()
    {
        $user = Auth::user();
        $favoriteOutlets = $user->favoriteOutlets()->get();
        return view('favorite-outlets', compact('favoriteOutlets'));
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

    public function dashboard()
    {
        $user = auth()->user();
        $outlet = \App\Models\Outlet::where('user_id', $user->id)->first();
        return view('admin.home', compact('outlet'));
    }

    // Dashboard customer: tampilkan semua outlet
    public function customerDashboard()
    {
        $outlets = Outlet::all();
        return view('home', compact('outlets'));
    }

    // Tampilkan detail outlet
    public function show(Outlet $outlet)
    {
        return view('outlet-detail', compact('outlet'));
    }
}