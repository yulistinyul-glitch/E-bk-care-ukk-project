<style>
.footer {
  background-color: #000;
  color: #fff;
  font-family: 'Poppins';
  padding-top: 4rem;
}

/* Headings */
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

/* Deskripsi */
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

/* Responsive spacing */

/* Mobile <768px */
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

/* Tablet 768–1023px */
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
        <h3 class="footer-logo">Tasty Food</h3>
        <p class="footer-desc">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
        <div class="footer-social">
          <a href="https://facebook.com" target="_blank"><img src="/img/001-facebook.png" alt="Facebook"></a>
          <a href="https://twitter.com" target="_blank"><img src="/img/002-twitter.png" alt="Twitter/X"></a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-xl-2" data-aos="fade-up" data-aos-delay="200">
        <h5>Useful Links</h5>
        <ul class="footer-links">
          <li><a href="#">Blog</a></li>
          <li><a href="#">Hewan</a></li>
          <li><a href="#">Galeri</a></li>
          <li><a href="#">Testimonial</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-6 col-xl-2" data-aos="fade-up" data-aos-delay="300">
        <h5>Privacy</h5>
        <ul class="footer-links">
          <li><a href="#">Karir</a></li>
          <li><a href="#">Tentang Kami</a></li>
          <li><a href="#">Kontak Kami</a></li>
          <li><a href="#">Servis</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-6 col-xl-2" data-aos="fade-up" data-aos-delay="400">
        <h5>Contact Info</h5>
<ul class="footer-contact">
    <li><img src="/img/email-2.png"><span>{{ $locations->email ?? 'email@anda.com' }}</span></li>
    <li><img src="/img/call.png"><span>{{ $locations->phone ?? '-' }}</span></li>
    <li><img src="/img/lokasi.png"><span>{{ $locations->address ?? 'Alamat Belum Diatur' }}</span></li>
</ul>
      </div>

    </div>
  </div>

  <div class="footer-copyright">
    © Copyright 2025. All rights reserved.
  </div>
</footer>
