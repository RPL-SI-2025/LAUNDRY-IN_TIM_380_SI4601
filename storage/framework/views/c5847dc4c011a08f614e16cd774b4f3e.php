<nav class="navbar navbar-expand-lg navbar-light bg-white px-4">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('home')); ?>">
        <img src="<?php echo e(asset('gambar/icon.png')); ?>" alt="Logo" style="height: 40px;">
        <span class="ms-2 fw-bold">Laundry-In</span>
      </a>
  
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fw-bold" href="<?php echo e(url('home')); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="<?php echo e(url('about')); ?>">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="<?php echo e(route('outlets.index')); ?>">Outlet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="#">Lacak Pesanan</a>
          </li>
          <li class="nav-item">
            <form id="logout-form" action="<?php echo e(url('logout')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger fw-bold px-3 py-2" style="border-radius: 8px;" onclick="return confirm('Yakin ingin LogOut?')">Log Out</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php /**PATH C:\laragon\www\LAUNDRY-IN_TIM_380_SI4601\resources\views/partials/navbar.blade.php ENDPATH**/ ?>