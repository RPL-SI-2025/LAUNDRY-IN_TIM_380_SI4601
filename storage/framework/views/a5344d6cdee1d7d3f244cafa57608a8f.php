<?php $__env->startSection('content'); ?>
<div class="background-container">
  <div class="container py-5 d-flex flex-column align-items-center justify-content-center">
    <h2 class="mb-5 fw-bold text-center"><?php echo e($outlet->nama_outlet ?? 'Nama Outlet'); ?></h2>
    <div class="row justify-content-center w-100 gap-4" style="max-width: 900px;">
      <div class="col-md-5">
        <a href="<?php echo e(url('input-pesanan')); ?>" class="text-decoration-none">
          <div class="card shadow text-center p-4 h-100" style="background: #388896; color: #fff; border-radius: 18px; min-height: 320px;">
            <div class="mb-3">
              <i class="fas fa-sign-out-alt" style="font-size: 3rem;"></i>
            </div>
            <h4 class="fw-bold mb-2">Input Pesanan</h4>
            <p style="font-size: 1rem;">Input Pesanan memungkinkan pelanggan memasukkan detail laundry dengan mudah, termasuk jenis layanan, jumlah pakaian, dan metode pengambilan.</p>
          </div>
        </a>
      </div>
      <div class="col-md-5">
        <a href="<?php echo e(url('/pelacakan-status')); ?>" class="text-decoration-none">
          <div class="card shadow text-center p-4 h-100" style="background: #388896; color: #fff; border-radius: 18px; min-height: 320px;">
            <div class="mb-3">
              <i class="fas fa-gear" style="font-size: 3rem;"></i>
            </div>
            <h4 class="fw-bold mb-2">Pelacakan Status</h4>
            <p style="font-size: 1rem;">Anda dapat memantau proses laundry secara real-time, mulai dari pencucian hingga siap diantar. Semua bisa dipantau dengan mudah.</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\LAUNDRY-IN_TIM_380_SI4601\resources\views/admin/home.blade.php ENDPATH**/ ?>