@extends('layouts.app')

@section('content')
<div class="container py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5>Favorite Outlets</h5>
    <a href="{{ route('outlets.index') }}" class="btn btn-warning text-white fw-bold rounded">
      <i class="fas fa-arrow-left"></i> Back to All Outlets
    </a>
  </div>

  <!-- Container Cards -->
  <div class="row g-5">
    @forelse($favoriteOutlets as $outlet)
    <div class="col-12 col-md-6"> 
      <div class="card h-100 shadow" style="background-color: #15858f; color: white;">
        <img src="{{ asset($outlet->image) }}" class="card-img-top" alt="Outlet Image" style="height: 200px; object-fit: cover;">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title">{{ $outlet->nama_outlet }}</h5>
            <p class="card-text">
              {{ $outlet->deskripsi_outlet }}
            </p>
            <p class="card-text">
              <i class="fas fa-map-marker-alt"></i> {{ $outlet->alamat_outlet }}
            </p>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-center w-100">
              <a href="#" class="btn btn-warning text-white fw-bold rounded">View Laundry</a> {{-- Adjusted button size and rounded corners --}}
            </div>
            <div class="d-flex align-items-center gap-2">
              {{-- Favorite heart icon (solid for favorited, with remove functionality) --}}
              <button class="btn btn-light btn-sm rounded-circle favorite-toggle" data-outlet-id="{{ $outlet->id }}" style="color: #ff4d6d;">
                <i class="fas fa-heart"></i> {{-- Solid heart icon for favorited --}}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="col-12">
        <p>You have no favorite outlets yet.</p>
    </div>
    @endforelse
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.favorite-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const outletId = this.getAttribute('data-outlet-id');
            // For the favorite-outlets page, clicking the heart should always remove
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
                    // If removed successfully, remove the card from the view
                    if (!data.favorited) {
                        button.closest('.col-12.col-md-6').remove();
                         // If no favorite outlets are left, display the message
                        if (document.querySelectorAll('.favorite-toggle').length === 0) {
                            const container = document.querySelector('.row.g-5');
                            container.innerHTML = '<div class="col-12"><p>You have no favorite outlets yet.</p></div>';
                        }
                    }
                    console.log(data.message);
                } else {
                    console.error('Failed to remove from favorites');
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