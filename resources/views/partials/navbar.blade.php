<nav class="navbar navbar-expand-lg navbar-light bg-white px-4">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
        <img src="{{ asset('gambar/icon.png') }}" alt="Logo" style="height: 40px;">
        <span class="ms-2 fw-bold">Laundry-In</span>
      </a>
  
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fw-bold" href="{{ url('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="{{ url('about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="{{ url('outlet') }}">Outlet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="{{ route('vouchers.available') }}">Voucher</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="#">Lacak Pesanan</a>
          </li>
          <li class="nav-item">
            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger fw-bold px-3 py-2" style="border-radius: 8px;" onclick="return confirm('Yakin ingin LogOut?')">Log Out</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  