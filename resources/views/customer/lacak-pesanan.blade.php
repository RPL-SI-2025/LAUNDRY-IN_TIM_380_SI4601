@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Pelacakan Status Customer</h4>
                <div class="search-box">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari pesanan...">
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="pesananContainer">
        @foreach($pesanans as $pesanan)
        <div class="col-12 mb-4 pesanan-item">
            <div class="card" style="background-color: #006d77; border: none; border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <!-- Profile Image Column -->
                        <div class="col-md-2 text-center">
                            <div class="profile-image bg-white rounded-circle p-3 d-inline-block">
                                <i class="fas fa-user" style="font-size: 2rem; color: #006d77;"></i>
                            </div>
                        </div>
                        
                        <!-- Customer Details Column -->
                        <div class="col-md-7">
                            <h5 class="text-white mb-2">{{ $pesanan->nama_pelanggan }}</h5>
                            <p class="text-white mb-1">{{ $pesanan->tgl_order }}</p>
                            <p class="text-white mb-1">{{ $pesanan->jenis_paket }}</p>
                            <p class="text-white mb-0">{{ $pesanan->berat_kg }} Kg</p>
                        </div>
                        
                        <!-- Status Badges Column -->
                        <div class="col-md-3">
                            <div class="d-flex flex-column gap-2">
                                <span class="badge {{ $pesanan->status == 'Pencucian' ? 'bg-info' : 
                                    ($pesanan->status == 'Pengeringan' ? 'bg-warning' : 'bg-success') }} 
                                    p-2 w-100">{{ $pesanan->status }}</span>
                                <span class="badge {{ $pesanan->payment_status == 'Belum Bayar' ? 'bg-danger' : 'bg-success' }} 
                                    p-2 w-100">{{ $pesanan->payment_status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.search-box {
    max-width: 300px;
}

.search-box .form-control {
    border-radius: 20px;
    padding: 10px 20px;
    border: 1px solid #ddd;
}

.badge {
    font-size: 0.9rem;
    border-radius: 20px;
}

.profile-image {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .col-md-2, .col-md-7, .col-md-3 {
        margin-bottom: 15px;
        text-align: center;
    }
    
    .col-md-3 .d-flex {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const pesananItems = document.querySelectorAll('.pesanan-item');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        pesananItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if(text.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endsection 