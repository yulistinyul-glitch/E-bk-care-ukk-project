<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Guru Bk</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/css/vendors.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/css/daterangepicker.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/theme.min.css')); ?>" />

    <style> body { font-family: 'Poppins', sans-serif; background: #f0f2f5; } </style>

</head>

<body>
    <?php echo $__env->make('gurubk.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('gurubk.layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="nxl-container">
        <div class="nxl-content">
            <div class="main-content">
                <?php echo $__env->yieldContent('content'); ?> 
            </div>
        </div>
    </main>

    <script src="<?php echo e(asset('assets/vendors/js/vendors.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/common-init.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/theme-customizer-init.min.js')); ?>"></script>
</body>
</html><?php /**PATH D:\e-bk-care-venusvault\resources\views/gurubk/layouts/app.blade.php ENDPATH**/ ?>