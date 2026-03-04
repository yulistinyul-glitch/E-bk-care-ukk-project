<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $__env->yieldContent('title', 'Dashboard Admin'); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/css/vendors.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/css/daterangepicker.min.css')); ?>" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/theme.min.css')); ?>" />

    <style> 
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; } 
    </style>

    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <?php echo $__env->make('admin.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('admin.layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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

    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>