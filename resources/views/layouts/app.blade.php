<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry-In</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand img {
            height: 40px;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #006d77;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-logout:hover {
            background-color: #c82333;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
                <img src="{{ asset('gambar/icon.png') }}" alt="Logo">
                <span class="ms-2 fw-bold">Laundry-In</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/outlets') }}">Outlet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vouchers.available') }}">Voucher</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.lacak-pesanan') }}">Lacak Pesanan</a>
                    </li>
                </ul>
                <div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-logout fw-bold" onclick="return confirm('Yakin ingin LogOut?')">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
