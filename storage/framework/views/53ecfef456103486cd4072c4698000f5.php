<style>
.footer {
  background-color: #000;
  color: #fff;
  font-family: 'Poppins';
  padding-top: 4rem;
}

.footer h3.footer-logo {
  font-size: 1.7rem;
  font-weight: 700;
  margin-bottom: 2rem;
}
.footer h5 {
  color: #fff;
  font-weight: 600;
  margin-bottom: 1.2rem;
}

.footer p.footer-desc {
  font-size: 10px;
  line-height: 1.6;
  color: #b0b0b0;
  margin-bottom: 2rem;
}

/* Social */
.footer-social a img {
  width: 2rem;
  height: 2rem;
  margin-right: 0.5rem;
  transition: opacity 0.3s;
}
.footer-social a img:hover {
  opacity: 0.8;
}

/* Links */
.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-links li {
  margin-bottom: 1.5rem;
  font-size: 14px;
}
.footer-links li a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}
.footer-links li a:hover {
  color: #fbbf24;
}

/* Contact */
.footer-contact {
  list-style: none;
  padding: 0;
  margin: 0;
  font-size: 0.875rem;
}
.footer-contact li {
  display: flex;
  align-items: center;
  margin-bottom: 1.5rem;
  flex-wrap: nowrap;
}
.footer-contact li img {
  width: 14px;
  height: 12px;
  margin-right: 0.6rem;
}
.footer-contact li span {
  white-space: nowrap;
}

@media (max-width: 767px) {
  .footer-links,
  .footer-contact {
    margin-top: 1rem;
  }

  .footer p.footer-desc {
    font-size: 10px;
    line-height: 1.6;
  }
}

@media (min-width: 768px) and (max-width: 1023px) {
  .footer-links,
  .footer-contact {
    margin-top: 1.5rem;
  }

  .footer p.footer-desc {
    font-size: 15px;
    line-height: 1.8;
    max-width: 355px;
    text-align: left;
  }
}

@media (min-width: 1024px) and (max-width: 1199px) {
  .footer-links,
  .footer-contact {
    margin-top: 1.5rem;
  }

  .footer p.footer-desc {
    font-size: 15px;
    line-height: 1.8;
    max-width: 355px;
    text-align: left;
  }

  .footer .row > div.col-xl-2 {
    position: relative;
    left: 0;
  }
}

@media (min-width: 1200px) {
  .footer-links,
  .footer-contact {
    margin-top: 2rem;
  }

  .footer p.footer-desc {
    font-size: 15px;
    line-height: 1.8;
    max-width: 355px;
    text-align: left;
  }

  .footer .row > div.col-xl-2 {
    position: relative;
    left: -80px;
  }
}

.footer-copyright {
  text-align: center;
  color: #b0b0b0;
  font-size: 0.75rem;
  padding: 1.5rem 0;
  margin-top: 4rem;
}
</style>
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