<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Outlet;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                // Cek apakah admin sudah memiliki outlet
                $hasOutlet = Outlet::where('user_id', $user->id)->exists();
                
                if ($hasOutlet) {
                    // Jika sudah punya outlet, langsung ke dashboard admin
                    return redirect()->route('admin.home');
                } else {
                    // Jika belum punya outlet, arahkan ke halaman input outlet
                    return redirect()->route('input.outlet');
                }
            } else if ($user->role === 'customer') {
                return redirect()->route('home');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors([
            'error' => 'Username atau password salah!',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'telepon' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
