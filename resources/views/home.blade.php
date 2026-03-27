<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - E-BK Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Herr+Von+Muellerhoff&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/app.css') }}">
</head>
<body>
    <div class="hero-section">
        <div class="hero-slideshow">
            <div class="slide active" style="background-image: url('/img/hero.jpeg')"></div>
        </div>
        <div class="hero-overlay"></div>

        <div class="header-top">
            <div class="container px-4 position-relative">
                <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
                <div class="logo-placeholder">
                      <img src="{{asset('img/logo_ebk-careGold.png')}}" alt="Logo" width="40" class="logo-img">
                </div>
                <a href="{{route('login')}}" class="font-poppins login-btn">LOGIN</a>
                <div class="font-montserrat nav-menu" id="navMenu">
                    <a href="home">BERANDA</a><a href="tentang">TENTANG</a><a href="artikel">ARTIKEL</a><a href="layanan">LAYANAN</a><a href="kotaksaran">KOTAK SARAN</a> 
                </div>
            </div>
        </div>

        <div class="container px-4">
            <div class="content-area" data-aos="fade-up">
                <div class="font-herr title-large ">Your Safety is Our Priority</div>
                <div class="font-herr title-small">Voice is Your Power</div>
                <p class="description">Identity remains strictly confidential. You are never alone.</p>
                <a href="#values-section" class="font-poppins btn-see-more">
                SEE MORE <span class="arrow">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

<section id="values-section" class="values-section" data-aos="fade-up">
    <div class="container px-4">

        <div class="row align-items-center">

            <div class="col-lg-5 mb-4 mb-lg-0">

                <div class="values-title-box">

                    <p class="font-montserrat section-subtitle">TENTANG KAMI</p>

                    <h2 class="font-poppins values-title">
                        Why You Can Trust BK Care, <span class="font-herr values-script">Our Values</span>
                    </h2>

                </div>

            </div>

            <div class="col-lg-7">
                <div class="font-poppins values-content">
                    <p>{{ $data->desc_1 ?? 'Deskripsi belum diisi.' }}</p>
                </div>
            </div>

        </div>

    </div>
</section>
<section class="stats-section" data-aos="fade-up">
    <div class="container px-4">
<div class="row g-4 justify-content-center">
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="100" data-suffix="%">0</h3>
            <p class="font-poppins">Tingkat Kerahasiaan</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="24" data-suffix="">0</h3>
            <p class="font-poppins">Jam Respon Cepat</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="450" data-suffix="+">0</h3>
            <p class="font-poppins">Konsultasi Selesai</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="100" data-suffix="%">0</h3>
            <p class="font-poppins">Aksesibilitas Digital</p>
        </div>
    </div>
</div>
    </div>
</section>

<section class="card-slider-section" data-aos="fade-up">
    <div class="container px-4"></div>
            <div class="voh-wrapper">
                <span class="font-montserrat sub-title">ARTIKEL TERBARU</span>
                <div class="gold-line-center"></div>
            </div>

    <div class="slider-wrapper" id="sliderContainer">

        @foreach($semua_artikel->take(5) as $item)
        <div class="custom-card">
            
            <img src="{{ asset('storage/' . $item->image) }}" 
                 class="card-img-top" 
                 alt="{{ $item->title }}">

            <div class="card-body-text">
                <h5>{{ Str::limit($item->title, 60) }}</h5>
            </div>

            <div class="card-footer-box">
                <div class="author-group">
                    <div class="author-icon"></div>
                    <span class="author-name">
                        direct by {{ $item->penulis ?? 'Admin' }} {{ $item->created_at->format('Y') }}
                    </span>
                </div>

                <div class="arrow-icon">→</div>
            </div>

        </div>
        @endforeach

    </div>

    <div class="dots-container" id="dotsContainer" style="justify-content: center;"></div>
</section>

<section class="feedback-section" data-aos="fade-up">
    <div class="container px-4">
        <div class="feedback-header text-center mb-5">
            <div class="voh-wrapper">
                <span class="font-montserrat sub-title">VOICE OF HEALING</span>
                <div class="gold-line-center"></div>
            </div>
            
            <div class="dampak-wrapper text-start mt-4">
                <h2 class="font-poppins main-title">Dampak Positif E-BK CARE</h2>
                <p class="font-poppins description">
                    Di balik setiap aspirasi, ada perubahan nyata. Simak pengalaman tulus dari mereka yang telah merasakan manfaat layanan E-BK Care.
                </p>
            </div>
        </div>

        <div class="row g-4 mt-2 justify-content-center">
            <div class="col-md-4">
                <div class="feedback-card shadow font-poppins">
                    <i class="fas fa-quote-right quote-icon"></i>
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="feedback-text">"Sistem anonimitasnya luar biasa. Saya merasa sangat aman saat melakukan konseling pribadi tanpa takut identitas tersebar."</p>
                    <div class="user-info">
                        <div class="avatar" style="background-color: #1A374D;"></div>
                        <div class="user-details">
                            <h6>Siswa Kelas XI</h6>
                            <p>Layanan Konseling</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feedback-card shadow font-poppins">
                    <i class="fas fa-quote-right quote-icon"></i>
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="feedback-text">"Kotak saran ini benar-benar didengar! Masalah di kelas saya selesai dalam seminggu setelah melapor di sini."</p>
                    <div class="user-info">
                        <div class="avatar" style="background-color: #B89551;"></div>
                        <div class="user-details">
                            <h6>Siswa Kelas XI</h6>
                            <p>Layanan Kotak Saran</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feedback-card shadow font-poppins">
                    <i class="fas fa-quote-right quote-icon"></i>
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="feedback-text">"Artikel edukasinya sangat mencerahkan. Saya jadi lebih paham cara mengelola stres saat ujian akhir."</p>
                    <div class="user-info">
                        <div class="avatar" style="background-color: #1A374D;"></div>
                        <div class="user-details">
                            <h6>Rizka Amelia</h6>
                            <p>Layanan Artikel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="feedback-footer-bar mt-5 font-poppins">
        <div class="container px-4">
            <a href="{{ route('kotaksaran') }}" class="cta-link">
                “ Bantu Kami Berkembang, Kirim Feedback Anda ” <span class="ms-5">&rarr;</span>
            </a>
        </div>
    </div>


<section class="faq-section" data-aos="fade-up" style=" background-color: #f1f5f9; ">
    <div class="container px-4">
        <div class="text-center">
            <h2 style="font-weight: 800; color: #0f2744; font-size: 2rem; margin-bottom: 60px; ">Frequently Asked Questions</h2>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-6">
                <div class="accordion accordion-flush" id="faqAccordionLeft">
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#l1" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Bagaimana cara melakukan konseling anonim?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="l1" class="accordion-collapse collapse" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.95rem;">
                                <p class="mb-3">Untuk menjaga privasi dan kenyamanan Anda, berikut adalah langkah-langkah melakukan konseling secara anonim:</p>
                                
                                <div class="mb-2">
                                    <span class="fw-bold text-dark">1. Pengajuan Jadwal:</span> Siswa mengklik tombol untuk mengajukan jadwal konseling kepada Guru BK melalui menu 'Layanan' dan memilih <strong>'Mode Anonim'</strong>.
                                </div>

                                <div class="mb-2">
                                    <span class="fw-bold text-dark">2. Menunggu Respon:</span> Siswa menunggu konfirmasi atau respon dari Guru BK terkait permohonan konseling tersebut.
                                </div>

                                <div class="mb-2">
                                    <span class="fw-bold text-dark">3. Penetapan Jadwal:</span> Jika disetujui, Guru BK akan memberikan informasi mengenai <strong>jadwal, tanggal, dan waktu</strong> pelaksanaan konseling.
                                </div>

                                <div class="mb-2">
                                    <span class="fw-bold text-dark">4. Sesi Konseling:</span>
                                    <ul class="mt-2 mb-0 ps-3">
                                        <li><span class="fw-bold">Sistem Online:</span> Siswa akan diarahkan ke halaman <strong>chat pribadi</strong> yang aman antara siswa dan Guru BK.</li>
                                        <li><span class="fw-bold">Sistem Offline:</span> Siswa akan diarahkan untuk datang langsung ke <strong>ruang BK sekolah</strong> sesuai jadwal yang telah ditentukan.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#l2" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Berapa lama respon kotak saran?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="l2" class="accordion-collapse collapse" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.9rem;">
                                Setiap saran yang masuk akan ditinjau oleh gurubk dalam waktu 1x24 jam. Masukan Anda akan divalidasi kepada pihak sekolah untuk memastikan kelayakan tindak lanjut, dan penjadwalan aksi atas saran tersebut akan dilakukan dalam jangka waktu kurang lebih 1 hingga 2 minggu.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#l3" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Bagaimana cara login dan aktivasi akun siswa?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="l3" class="accordion-collapse collapse" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.95rem;">
                                <p class="mb-3">Ikuti langkah-langkah berikut untuk mengaktifkan akun E-BK Care Anda:</p>
                                
                                <ul class="ps-3 mb-0">
                                    <li class="mb-2"><strong>Akses Halaman Login:</strong> Buka halaman login dan pilih opsi <strong>sebagai siswa</strong>.</li>
                                    <li class="mb-2"><strong>Masukkan Identitas:</strong> Masukkan <strong>Nama Lengkap</strong> dan <strong>NIPD</strong> siswa dengan benar.</li>
                                    <li class="mb-2"><strong>Registrasi Data:</strong> Anda akan diarahkan ke halaman berikutnya untuk mengisi <strong>Email Belajar aktif</strong> dan membuat <strong>Password Baru</strong>.</li>
                                    <li class="mb-2"><strong>Aktivasi:</strong> Klik tombol <strong>'Aktivasi Akun'</strong>.</li>
                                    <li class="mb-2"><strong>Selesai:</strong> Jika data email ditemukan di database, Anda akan diarahkan kembali ke halaman login dan akan muncul notifikasi <strong>sukses</strong>.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="accordion accordion-flush" id="faqAccordionRight">
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#selfReport" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Sudah memahami tata cara Self-Report?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="selfReport" class="accordion-collapse collapse" data-bs-parent="#faqAccordionSelfReport">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.95rem;">
                                <p class="mb-3">Kerahasiaan identitas Anda adalah prioritas kami. Berikut adalah prosedur pelaporannya:</p>
                                
                                <ul class="ps-3 mb-3" style="list-style-type: decimal;">
                                    <li class="mb-2"><strong>Akses Fitur:</strong> Klik tombol laporan untuk memulai sesi Self-Report.</li>
                                    <li class="mb-2"><strong>Lengkapi Data:</strong> Isi formulir dengan detail kejadian yang sebenar-benarnya.</li>
                                    <li class="mb-2"><strong>Lampirkan Bukti:</strong> Sertakan dokumentasi pendukung (foto/dokumen) yang relevan.</li>
                                    <li class="mb-2"><strong>Kirim Laporan:</strong> Identitas Anda akan tetap terenkripsi dan terlindungi oleh sistem.</li>
                                </ul>
                                
                                <p class="small text-center mt-3 mb-0" style="color: #0f2744; opacity: 0.8;">
                                    <i class="fas fa-lock me-1"></i> Seluruh data laporan dijamin kerahasiaannya secara profesional.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#r2" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Siapa yang mengelola laporan dan poin saya?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="r2" class="accordion-collapse collapse" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.9rem;">
                                Laporan dikelola langsung oleh <strong>Guru BK</strong>. Selain itu, informasi poin pelanggaran akan <strong>muncul secara otomatis</strong> di halaman profil Anda untuk pemantauan kedisiplinan yang transparan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#r3" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Lupa akun atau kendala teknis?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="r3" class="accordion-collapse collapse" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.9rem;">
                                <p class="mb-3">Jika Anda lupa kata sandi akun, silakan ikuti langkah berikut:</p>
                                <ul class="ps-3 mb-3">
                                    <li class="mb-1"><strong>Klik 'Lupa Password'</strong> pada halaman login.</li>
                                    <li class="mb-1"><strong>Isi Email Belajar</strong> dan buat kata sandi baru.</li>
                                    <li class="mb-1">Cek inbox email belajar untuk menerima <strong>kode OTP</strong>.</li>
                                    <li class="mb-1">Masukkan <strong>kode OTP</strong> di halaman verifikasi.</li>
                                    <li class="mb-1">Login kembali dengan <strong>NIPD</strong> sebagai username dan kata sandi baru Anda.</li>
                                </ul>
                                <p class="mb-0">Jika masih terkendala, hubungi bantuan teknis melalui WhatsApp Admin dibagian bawah situs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    @include('layouts.footer')
   <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // 1. Inisialisasi AOS (Animate On Scroll)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        }

        // 2. Hamburger Menu Logic
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        if (hamburger && navMenu) {
            hamburger.onclick = () => {
                hamburger.classList.toggle('open');
                navMenu.classList.toggle('active');
            };
        }

        // 3. Slider Artikel Logic
        const cards = document.querySelectorAll('.custom-card');
        const dotsContainer = document.getElementById('dotsContainer');
        let currentIndex = 2; // Mulai dari tengah
        let autoPlayTimer;

        if (cards.length > 0) {
            // Generate Dots berdasarkan jumlah kartu
            cards.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.classList.add('dot');
                if (i === currentIndex) dot.classList.add('active');
                dot.onclick = () => {
                    currentIndex = i;
                    updateSlider();
                    resetAutoPlay();
                };
                dotsContainer.appendChild(dot);
            });

            const dots = document.querySelectorAll('.dot');

            function updateSlider() {
                const n = cards.length;
                cards.forEach((card, i) => {
                    // Bersihkan class posisi lama
                    card.classList.remove('pos-left-2', 'pos-left-1', 'pos-center', 'pos-right-1', 'pos-right-2');
                    if (dots[i]) dots[i].classList.remove('active');

                    // Hitung posisi relatif
                    let diff = (i - currentIndex + n) % n;
                    if (diff === 0) card.classList.add('pos-center');
                    else if (diff === 1) card.classList.add('pos-right-1');
                    else if (diff === 2) card.classList.add('pos-right-2');
                    else if (diff === n - 1) card.classList.add('pos-left-1');
                    else if (diff === n - 2) card.classList.add('pos-left-2');

                    // Update dot aktif
                    if (i === currentIndex && dots[i]) dots[i].classList.add('active');
                });
            }

            function startAutoPlay() {
                autoPlayTimer = setInterval(() => {
                    currentIndex = (currentIndex + 1) % cards.length;
                    updateSlider();
                }, 3000);
            }

            function resetAutoPlay() {
                clearInterval(autoPlayTimer);
                startAutoPlay();
            }

            updateSlider();
            startAutoPlay();
        }

        // 4. Counter Animation Logic
        const counters = document.querySelectorAll('.count');

        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const suffix = counter.getAttribute('data-suffix') || '';
            const duration = 2000;
            let start = null;

            const step = (timestamp) => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                const currentCount = Math.floor(progress * target);
                
                counter.innerText = currentCount + suffix;

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    counter.innerText = target + suffix; // Pastikan angka akhir tepat
                }
            };
            window.requestAnimationFrame(step);
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    // Berhenti mengamati setelah animasi jalan sekali agar tidak terus-menerus reset
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(c => observer.observe(c));
    });
</script>
</body>
</html>