<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title', 'E-Counseling - E-BK Care'); ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Herr+Von+Muellerhoff&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/frontend/tentang.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/frontend/artikel.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/frontend/layanan.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/frontend/galeri.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/frontend/saran.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/frontend/app.css')); ?>">

</head>
<style>
.font-herr {
  font-family: 'Herr Von Muellerhoff', cursive;
  font-size: 70px;
  line-height: 1.1;
  color: #1A374D;
}
.font-montserrat {
  font-family: 'Montserrat', sans-serif;
}
.font-poppins {
  font-family: 'Poppins', sans-serif;
}
.font-poppins-italic {
  font-family: 'Poppins', sans-serif;
  font-style: italic;
}
</style>
<body>
  <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main>
    <?php echo $__env->yieldContent('content'); ?>
  </main>
  <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000, 
      once: true,     
    });
  </script>
</body>
</html><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/layouts/app.blade.php ENDPATH**/ ?>