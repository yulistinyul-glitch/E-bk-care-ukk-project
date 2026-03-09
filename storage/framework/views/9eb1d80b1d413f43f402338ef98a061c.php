

<?php $__env->startSection('content'); ?>

<div class="lg:ml-28 px-6 lg:px-10 max-w-7xl mx-auto mb-20 font-['Poppins']">
  
  <div class="py-6">
    <h2 class="text-2xl font-bold text-[#1A374C]">Kotak Pesan</h2>
    <p class="text-sm text-gray-500">Informasi Surat panggilan, Jadwal dan undangan konselingmu</p>
  </div>

  
    <div class="space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div id="card-<?php echo e($item->id); ?>"
                 onclick="showDetail('<?php echo e($item->id); ?>', '<?php echo e(addslashes($item->subject)); ?>', <?php echo e(json_encode($item->message)); ?>)"
                 class="bg-white border-2 <?php echo e($item->is_read ? 'border-gray-100' : 'border-blue-400'); ?> p-5 rounded-3xl shadow-sm hover:shadow-md transition-all cursor-pointer flex items-center gap-4 group">
                
                <div class="p-3 <?php echo e($item->is_read ? 'bg-gray-100 text-gray-400' : 'bg-blue-100 text-blue-600'); ?> rounded-2xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>

                <div class="flex-1">
                    <h4 class="font-bold text-[#1A374C] <?php echo e($item->is_read ? 'opacity-70' : ''); ?>"><?php echo e($item->subject); ?></h4>
                    <p class="text-xs text-gray-500 truncate max-w-xs md:max-w-md"><?php echo e($item->message); ?></p>
                    <span class="text-[10px] text-gray-400 mt-1 block"><?php echo e($item->created_at->diffForHumans()); ?></span>
                </div>

                <?php if(!$item->is_read): ?>
                  <div id="dot-<?php echo e($item->id); ?>" class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-20">
                <img src="https://illustrations.popsy.co/blue/no-messages.svg" class="w-40 mx-auto opacity-50">
                <p class="text-gray-400 mt-4">Belum ada pesan untukmu saat ini.</p>
            </div>    
    <?php endif; ?>
  </div>
</div>


<div id="modalDetail" class="fixed inset-0 z-99 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
  <div class="bg-white w-full max-w-md rounded-4xl overflow-hidden shadow-2xl animate-fade-in">
    <div class="bg-[#1A374C] p-6 text-white">
      <h3 id="modalSubject" class="text-lg font-bold">Detail Pesan</h3>
    </div>
    <div class="p-8">
     <p id="modalMessage" class="text-gray-600 leading-relaxed mb-6 whitespace-pre-line"></p>
      <div id="jadwalInfo" class="bg-blue-50 p-4 rounded-2xl mb-6 hidden">
          <p id="detailWaktu" class="text-sm text-blue-700"></p>
          <p id="detailLokasi" class="text-sm text-blue-700 font-semibold"></p>
      </div>
      <button onclick="closeModal()" class="w-full bg-[#1A374C] text-white py-4 rounded-2xl font-bold hover:bg-blue-900 transition-colors">
        Tutup & Tandai telah dibaca
      </button>
    </div>
  </div>
</div>


<script>
 function showDetail(id, subject, message) {
    document.getElementById('modalSubject').innerText = subject;
    document.getElementById('modalMessage').innerText = message;
    document.getElementById('modalDetail').classList.remove('hidden');
    document.getElementById('modalDetail').classList.add('flex');
        
        fetch(`/siswa/mailbox/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const dot = document.getElementById(`dot-${id}`);
                const card = document.getElementById(`card-${id}`);
                if(dot) dot.remove();
                if(card) card.classList.replace('border-blue-400', 'border-gray-100');
            }
        });
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
        document.getElementById('modalDetail').classList.remove('flex');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\e-bk-care-venusvault\resources\views/siswa/kotaksurat/index.blade.php ENDPATH**/ ?>