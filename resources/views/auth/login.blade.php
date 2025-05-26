@extends('layouts.login-layout')

@section('title', 'Login')

@section('content')
<div class="container-fluid vh-100 position-relative overflow-hidden">
    <div class="row w-75 shadow-lg rounded overflow-hidden position-absolute top-10 start-50 translate-middle-x" style="height: 75vh;">
        
        {{-- KIRI (gambar) --}}
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="{{ asset('gambar/login.jpg') }}" alt="Login Image" class="img-fluid">
        </div>

        {{-- KANAN (form) --}}
        <div class="col-md-6 bg-white p-5 d-flex flex-column justify-content-start">
            <div class="text-start mb-4">
                <h2 style="color: #0E6A80; font-weight: bold;">Welcome to the Laundry-In Internal Portal</h2>
            </div>
            <div class="text-start mb-4">
                <h4 style="color: #0E6A80; font-weight: bold;">Login</h4>
            </div>

            {{-- Tampilkan error jika ada --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-4">
                    <label for="username" style="color: #0E6A80; font-weight: bold;">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-4">
                    <label for="password" style="color: #0E6A80; font-weight: bold;">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
            </form>
        
            <div class="text-center mt-4">
                Belum punya akun? <a href="{{ route('register') }}">Register</a>
            </div>
        </div>

    </div>
</div>
@endsection
