<footer class="footer">
  <div class="container px-4">
    <div class="row g-5">

      <div class="col-12 col-md-6 col-xl-6" data-aos="fade-up" data-aos-delay="100">
        <h3 class="footer-logo">E-BK Care</h3>
        <p class="footer-desc">
          Platform layanan bimbingan konseling sekolah yang aman, nyaman, dan terpercaya. Kami hadir untuk membantu setiap siswa meraih kesejahteraan mental dan akademik dengan privasi yang terjaga.
        </p>
        <div class="footer-social">
          <a href="#"><img src="/img/001-facebook.png" alt="FB"></a>
          <a href="#"><img src="/img/002-twitter.png" alt="IG"></a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-2" data-aos="fade-up" data-aos-delay="200">
        <h5>Layanan</h5>
        <ul class="footer-links">
          <li><a href="#">Konseling Online</a></li>
          <li><a href="#">Jadwal Konseling</a></li>
          <li><a href="#">Self-Report</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-6 col-xl-2" data-aos="fade-up" data-aos-delay="300">
        <h5>Informasi</h5>
        <ul class="footer-links">
          <li><a href="#">Tentang Kami</a></li>
          <li><a href="#">Kebijakan Privasi</a></li>
          <li><a href="#">Syarat & Ketentuan</a></li>
          <li><a href="#">Bantuan Teknis</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-6 col-xl-2" data-aos="fade-up" data-aos-delay="400">
        <h5>Kontak</h5>
        <ul class="footer-contact">
          <li><img src="/img/email-2.png"><span><?php echo e($locations->email ?? 'bk@sekolah.sch.id'); ?></span></li>
          <li><img src="/img/call.png"><span><?php echo e($locations->phone ?? '-'); ?></span></li>
          <li><img src="/img/lokasi.png"><span><?php echo e($locations->address ?? 'Ruang BK Sekolah'); ?></span></li>
        </ul>
        <a href="/self-report" class="footer-report-btn">
            <i class="fas fa-exclamation-triangle"></i> Lapor Anonim
        </a>
      </div>

    </div>
  </div>

  <div class="footer-copyright">
    © 2026 E-BK Care. Seluruh hak cipta dilindungi.
  </div>
</footer><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/layouts/footer.blade.php ENDPATH**/ ?>