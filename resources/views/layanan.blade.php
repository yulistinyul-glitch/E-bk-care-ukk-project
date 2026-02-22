@extends('layouts.app')

@section('title', 'Layanan - E-BK Care')

@section('content')
<<<<<<< HEAD
{{-- <style>
    /* Global & Variables */
=======
<style>
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46
    :root {
        --teal-color: #20c997;
        --dark-navy: #1e2a3a;
        --light-bg: #fcfdfe;
        --gold-accent: #d4af37; 
    }

    .text-teal { color: var(--teal-color) !important; }
    .section-padding { padding: 100px 0; }

    .hero-service { background-color: var(--light-bg); padding: 100px 0; position: relative; overflow: hidden;}

    .hero-service::after {
        content: "✕"; position: absolute; top: -50px; right: -30px; 
        font-size: 300px; color: #f1f1f1; z-index: 0; font-weight: bold; opacity: 0.5;
    }

    .hero-img-box { position: relative; z-index: 1; }
    .hero-img-box img { border-radius: 0; box-shadow: 15px 15px 0px var(--light-bg), 15px 15px 0px 1px #ddd; }
    
    .title-accent { border-left: 3px solid var(--gold-accent); padding-left: 15px; }

    .focus-areas {
        background: linear-gradient(rgba(30, 42, 58, 0.85), rgba(30, 42, 58, 0.85)), 
                    url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop');
        background-size: cover; background-position: center; background-attachment: fixed;
        color: white;
    }

    .area-sub { letter-spacing: 2px; font-size: 0.8rem; font-weight: 700; color: #aaa; text-transform: uppercase; }

    .service-card-minimal {
        padding: 40px 20px;
        text-align: left;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.02);
        transition: 0.3s;
    }

    .service-card-minimal:hover { background: rgba(255,255,255,0.05); border-color: var(--teal-color); }

    .icon-box { font-size: 2.5rem; margin-bottom: 30px; color: white; opacity: 0.9; }
    .service-title { font-size: 1rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 20px; }
    .service-desc { font-size: 0.85rem; color: #ccc; line-height: 1.8; margin-bottom: 25px; }
    
    .learn-more-link { 
        color: var(--gold-accent); 
        text-decoration: none; 
        font-weight: 700; 
        font-size: 0.8rem; 
        margin-top: auto;
        letter-spacing: 1px;
    }
    .learn-more-link:hover { color: white; }

    .why-choose { background-color: white; position: relative; }

    .why-choose::before {
        content: "✕"; position: absolute; bottom: -50px; left: -30px; 
        font-size: 250px; color: #f8f9fa; z-index: 0; font-weight: bold;
    }

    .list-bordered { list-style: none; align-content: flex-end; }
    .list-bordered li { 
        padding: 15px 0; 
        border-bottom: 1px solid #eee; 
        display: flex; 
        align-items: flex-end; 
        font-weight: 500;
        color: #555;
        font-size: 0.95rem;
    }
    .list-bordered li i { color: var(--teal-color); margin-right: 12px; font-size: 0.8rem; }

    .btn-action {
        background-color: #2c3e50; color: white; padding: 12px 25px; 
        border-radius: 2px; text-transform: uppercase; font-weight: 700; 
        border: none; font-size: 0.85rem; letter-spacing: 1px; margin-left: 60px; 
    }
    .btn-action:hover { background-color: var(--teal-color); color: white; }
</style> --}}

<<<<<<< HEAD
{{-- <section class="hero-service">
    <div class="container position-relative" style="z-index: 2;">
=======

<section class="hero-service">
    <div class="container px-4" style="z-index: 2;">
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="hero-img-box">
                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2070&auto=format&fit=crop" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-lg-7 ps-lg-5">
                <div class="title-accent">
                    <h1 class="display-6 fw-bold mb-3" style="color: #222;">Committed To Helping<br>Our Clients Succeed.</h1>
                </div>
                <p class="text-muted mt-4" style="line-height: 1.8; font-size: 0.95rem;">
                    Our client's success is our top priority, and we strive to deliver exceptional psychological support, advocacy, and counsel every step of the way. Trust us to be your reliable partner, committed to achieving your personal well-being goals.
                </p>
                <a href="#" class="btn btn-link p-0 mt-3 text-teal fw-bold text-decoration-none border-bottom border-teal">Learn About Our Philosophy →</a>
            </div>
        </div>
    </div>
</section>

<section class="focus-areas section-padding">
    <div class="container px-4">
        <div class="mb-5">
            <p class="area-sub mb-2">Practice Areas</p>
            <div style="border-left: 3px solid var(--gold-accent); padding-left: 15px;">
                <h2 class="fw-bold h1">How We Can Help</h2>
            </div>
        </div>

        {{-- <div class="row g-4">
            @forelse($semua_layanan as $item)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="service-card-minimal">
                        <div class="icon-box">
                            <i class="bi {{ $item->icon }}"></i>
                        </div>
                        <h3 class="service-title">{{ $item->title }}</h3>
                        <p class="service-desc">{{ Str::limit($item->description, 120) }}</p>
                        <a href="{{ route('layanan.show', $item->slug) }}" class="learn-more-link text-uppercase">Learn More <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white-50 py-5">Layanan belum tersedia.</div>
            @endforelse
        </div> 

         <div class="row g-4">
           
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="service-card-minimal">
                        <div class="icon-box">
                            <i class="bi"></i>
                        </div>
                        <h3 class="service-title">layanan</h3>
                        <p class="service-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel aperiam quo vero, dolore doloremque consectetur debitis impedit quisquam. Sint suscipit officia laudantium quisquam? Vero excepturi sapiente perspiciatis debitis cum mollitia.</p>
                        <a href="#" class="learn-more-link text-uppercase">Learn More <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            
        </div>
    </div>
</section>

<section class="why-choose section-padding">
    <div class="container px-4" style="z-index: 2;">
        <div class="row g-5">
            <div class="col-lg-6">
                <p class="area-sub mb-2">We Make A Difference</p>
                <div style="border-left: 3px solid var(--gold-accent); padding-left: 15px;">
                    <h2 class="fw-bold h1">Why E-BK Care?</h2>
                </div>
                <p class="mt-4 text-muted" style="line-height: 1.8;">
                    At E-BK Care, we understand that choosing the right counseling support is crucial for achieving successful outcomes in your mental health journey. We firmly believe that our team stands out for the following reasons.
                </p>
            </div>
            <div class="col-lg-6">
                <ul class="list-bordered mb-4">
                    <li><i class="bi bi-chevron-right"></i> Layanan Orientasi & Informasi</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Konseling Perorangan (Privat)</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Konseling Kelompok</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Penempatan & Penyaluran</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Advokasi</li>
                </ul>
                <button class="btn btn-action shadow-sm">Book A Consultation</button>
            </div>
        </div>
    </div>
</section> --}}

<style>
     .bg-custom {
      background-color: #ffffff;
      background-image:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%230d283d' fill-opacity='1' fill-rule='evenodd'%3E%3Cpath d='M10 10l-2-2m2 2l2 2m-2-2l2-2m-2 2l-2 2M30 30l-2-2m2 2l2 2m-2-2l2-2m-2 2l-2 2' stroke='%230d283d' stroke-width='2'/%3E%3C/g%3E%3C/svg%3E");
    }
</style>

<section class="bg-custom mx-auto max-w-7xl">
    <div class="grid grid-cols-3 gap-8 py-16 px-6">
        <div class="bg-white shadow-lg rounded-2xl p-6 font-['Poppins']">
            <h3 class="text-xl font-black mb-5">Layanan Orientasi & Informasi</h3>
            <p class="text-gray-600 text-sm">Layanan ini dirancang untuk membekali siswa dengan pemahaman komprehensif mengenai lingkungan pendidikan, kurikulum, serta berbagai informasi krusial terkait pengembangan diri. Dengan literasi informasi yang tepat, siswa diharapkan mampu beradaptasi secara efektif dan memiliki landasan pengetahuan yang kuat dalam setiap pengambilan keputusan strategis bagi masa depan akademiknya.</p>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-6 font-['Poppins']">
            <h3 class="text-xl font-black mb-5"> Layanan Konseling Perorangan (Privat)</h3>
            <p class="text-gray-600 text-sm">Merupakan layanan bantuan profesional yang bersifat personal dan rahasia antara guru pembimbing dan siswa. Fokus utamanya adalah memberikan ruang aman bagi siswa untuk mengeksplorasi serta mengentaskan permasalahan pribadi melalui pendekatan psikologis yang terukur, guna mencapai kemandirian dan stabilitas emosional dalam lingkungan sekolah.</p>
        </div> 

        <div class="bg-white shadow-lg rounded-2xl p-6 font-['Poppins']">
            <h3 class="text-xl font-black mb-5">Layanan Konseling Kelompok</h3>
            <p class="text-gray-600 text-sm">Layanan konseling kelompok merupakan bentuk intervensi psikologis yang melibatkan individu dalam setting kelompok kecil dengan fasilitator profesional. Melalui forum ini, peserta memiliki kesempatan untuk berbagi pengalaman, perspektif, dan tantangan yang mereka hadapi dengan sesama anggota kelompok yang memiliki isu serupa. Pendekatan ini memberikan manfaat ganda: pertama, peserta mendapatkan dukungan emosional dari komunitas, merasa bahwa mereka tidak sendirian dalam menghadapi masalah; kedua, mereka dapat belajar dari pengalaman dan strategi coping yang digunakan oleh anggota kelompok lainnya ,</p>
        </div> 

        <div class="bg-white shadow-lg rounded-2xl p-6 font-['Poppins']">
            <h3 class="text-xl font-black mb-5">Layanan Penempatan & Penyaluran</h3>
            <p class="text-gray-600 text-sm">Layanan penempatan dan penyaluran dirancang untuk memastikan bahwa setiap individu mendapatkan akses ke sumber daya dan layanan kesehatan mental yang paling sesuai dengan kebutuhan spesifik mereka. Tim profesional kami melakukan asesmen menyeluruh terhadap kondisi psikologis, latar belakang sosial, dan preferensi personal klien untuk mengidentifikasi layanan yang optimal. Kami memfasilitasi proses rujukan ke berbagai institusi kesehatan mental, baik di tingkat sekolah, klinik, maupun rumah sakit, dengan mempertimbangkan ketersediaan sumber daya dan kecocokan program. </p>
        </div> 

        <div class="bg-white shadow-lg rounded-2xl p-6 font-['Poppins']">
            <h3 class="text-xl font-black mb-5">Layanan Orientasi & Informasi</h3>
            <p class="text-gray-600 text-sm">Layanan orientasi dan informasi merupakan fondasi penting dalam memberikan edukasi komprehensif kepada siswa tentang berbagai aspek dukungan kesehatan mental dan akademik yang tersedia di institusi. Melalui program ini, kami menyediakan informasi terperinci mengenai proses konseling, etika kerahasiaan, manfaat dari berbagai jenis layanan, serta prosedur untuk mengakses dukungan. Siswa diberikan pemahaman mendalam tentang bagaimana setiap layanan bekerja, apa yang dapat mereka harapkan ketika mengunjungi konselor, dan bagaimana informasi pribadi mereka akan dijaga dengan keamanan maksimal.</p>
        </div> 

        <div class="bg-white shadow-lg rounded-2xl p-6 font-['Poppins']">
            <h3 class="text-xl font-black mb-5">Layanan Advokasi</h3>
            <p class="text-gray-600 text-sm">Layanan advokasi kami berkomitmen untuk melindungi dan memperjuangkan hak-hak fundamental setiap individu, khususnya siswa yang mungkin menghadapi diskriminasi, perlakuan tidak adil, atau hambatan dalam mengakses layanan kesehatan mental berkualitas. Tim advokat kami bekerja secara proaktif untuk mengidentifikasi situasi di mana hak-hak siswa terganggu dan mengambil tindakan korektif yang tepat. Kami berinteraksi dengan berbagai pihak—termasuk keluarga, sekolah, dan institusi terkait—untuk memastikan bahwa setiap siswa diperlakukan dengan martabat, keadilan, dan penghormatan terhadap keunikan mereka. </p>

    </div>

</section>
@endsection