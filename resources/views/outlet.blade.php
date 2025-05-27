@extends('layouts.app')

@section('content')
<div class="container py-4">
  <!-- Header with Search, Favorite Link, and Filter Toggle -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div class="input-group" style="max-width: 300px;">
        <input type="text" class="form-control" placeholder="Cari Outlet..." aria-label="Search">
        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
      </div>
    <div class="d-flex align-items-center gap-2">
        {{-- Link to Favorite Outlets page --}}
        <a href="{{ route('favorite.outlets') }}" class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="color: #ff4d6d; width: 38px; height: 38px;">
            <i class="far fa-heart"></i> {{-- Use outline heart for the link --}}
        </a>
        {{-- Filter Toggle Button --}}
        <button class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas" style="width: 38px; height: 38px;">
        <i class="fas fa-filter"></i>
        </button>
    </div>
  </div>

  <!-- Container Cards -->
  <div class="row g-4">
    @foreach($outlets as $outlet)
    <div class="col-12 col-md-6 col-lg-3"> {{-- Adjusted column classes for grid layout --}}
      <div class="card h-100 shadow">
        <img src="{{ asset($outlet->image) }}" class="card-img-top" alt="Outlet Image" style="height: 150px; object-fit: cover;"> {{-- Adjusted image height --}}
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ $outlet->nama_outlet }}</h5>
          {{-- Check if deskripsi_outlet is available, otherwise use layanan_laundry or a default --}}
          <p class="card-text text-muted small">{{ $outlet->deskripsi_outlet ?? $outlet->layanan_laundry ?? 'Layanan Laundry' }}</p> 
          <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $outlet->alamat_outlet }}</p>
          
          <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
            <a href="#" class="btn btn-warning text-white fw-bold rounded">View Laundry</a> {{-- Adjusted button size and rounded corners --}}
            {{-- Favorite heart icon --}}
            <button class="btn btn-light btn-sm rounded-circle favorite-toggle" data-outlet-id="{{ $outlet->id }}" style="color: #ff4d6d;" title="{{ Auth::user()->favoriteOutlets->contains($outlet->id) ? 'Remove from Favorites' : 'Add to Favorites' }}">
              <i class="{{ Auth::user()->favoriteOutlets->contains($outlet->id) ? 'fas' : 'far' }} fa-heart"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<!-- Filter Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="filterOffcanvasLabel">Filter</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <h6>Lokasi</h6>
    <div class="d-flex flex-wrap gap-2 mb-4">
      {{-- Placeholder for Location Tags --}}
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
    </div>

    <h6>Penilaian</h6>
    <div class="d-flex flex-wrap gap-2 mb-4">
      {{-- Placeholder for Rating Tags --}}
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
      <span class="badge bg-secondary">Nama</span>
    </div>

    {{-- Save Button --}}
    <div class="mt-auto">
        <button type="button" class="btn btn-primary w-100">Save</button>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.favorite-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const outletId = this.getAttribute('data-outlet-id');
            const icon = this.querySelector('i');
            const isFavorited = icon.classList.contains('fas');
            const titleAttr = this;

            fetch(`/outlets/${outletId}/favorite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.favorited) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        titleAttr.title = 'Remove from Favorites'; // Update tooltip
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        titleAttr.title = 'Add to Favorites'; // Update tooltip
                    }
                    console.log(data.message);
                } else {
                    console.error('Failed to toggle favorite status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>
@endpush
