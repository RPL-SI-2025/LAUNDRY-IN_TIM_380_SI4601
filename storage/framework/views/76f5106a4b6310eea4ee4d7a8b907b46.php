<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid vh-100 position-relative overflow-hidden">
    <div class="row w-75 shadow-lg rounded overflow-hidden position-absolute top-10 start-50 translate-middle-x" style="height: 75vh;">
        
        
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="<?php echo e(asset('gambar/login.jpg')); ?>" alt="Login Image" class="img-fluid">
        </div>

        
        <div class="col-md-6 bg-white p-5 d-flex flex-column justify-content-start">
            <div class="text-start mb-4">
                <h2 style="color: #0E6A80; font-weight: bold;">Welcome to the Laundry-In Internal Portal</h2>
            </div>
            <div class="text-start mb-4">
                <h4 style="color: #0E6A80; font-weight: bold;">Login</h4>
            </div>

            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
        
            <form method="POST" action="<?php echo e(route('login.submit')); ?>">
                <?php echo csrf_field(); ?>
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
                Belum punya akun? <a href="<?php echo e(route('register')); ?>">Register</a>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\LAUNDRY-IN_TIM_380_SI4601\resources\views/auth/login.blade.php ENDPATH**/ ?>