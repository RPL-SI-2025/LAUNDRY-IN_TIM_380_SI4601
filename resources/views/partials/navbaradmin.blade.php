<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('admin/home') }}">
            <img src="{{ asset('gambar/icon.png') }}" alt="Logo" style="height: 40px;">
            <span class="ms-2 fw-bold">Laundry-In</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link fw-medium {{ request()->is('admin/home') ? 'active' : '' }}" href="{{ url('admin/home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium {{ request()->is('tampil-pesanan') ? 'active' : '' }}" href="{{ url('tampil-pesanan') }}">Data Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium {{ request()->is('pelacakan-status') ? 'active' : '' }}" href="{{ url('pelacakan-status') }}">Pelacakan Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium {{ request()->routeIs('admin.vouchers.*') ? 'active' : '' }}" href="{{ route('admin.vouchers.index') }}">Voucher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profil</a>
                </li>
            </ul>
            
            <form action="{{ url('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin LogOut?')">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>