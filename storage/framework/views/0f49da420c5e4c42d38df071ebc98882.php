

<?php $__env->startSection('content'); ?>

<section class="lg:ml-28 px-6 py-10">
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl border border-gray-100">
    <h2 class="text-2xl font-bold text-[#1A374C] mb-6">Ajukan Jadwal Konseling</h2>

    <?php if($errors->any()): ?>
      <div class="bg-red-100 text0res-700 p-3 rounded-2xl mb-4">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>  
    <?php endif; ?>

    <form action="<?php echo e(route('siswa.konseling.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori masalah</label>
        <select name="kategori" class="w-full p-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none" id="">
          <option value="Pribadi">Pribadi</option>
          <option value="Sosial">Sosial</option>
          <option value="Belajar">Belajar</option>
          <option value="Karir">Karir</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Konseling</label>
        <select name="pilihan_metode" class="w-full p-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none" id="">
          <option value="Offline">Tatap muka (Offline)</option>
          <option value="Online">Chat (Online)</option>
        </select>
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
        <textarea name="deskripsi" rows="4" class="w-full p-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none"
        placeholder="Ceritakan sedikit masalahmu..."></textarea>
        <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-red-500 text-xs"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <button type="submit" class="w-full bg-[#1a374c] text-white py-4 rounded-full font-semibold hover:bg-slate-800 transition-all">
        Kirim permintaan
      </button>

    </form>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\e-bk-care-venusvault\resources\views/siswa/konseling/create.blade.php ENDPATH**/ ?>