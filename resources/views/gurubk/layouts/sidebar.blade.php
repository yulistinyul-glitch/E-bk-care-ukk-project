<style>
    .profile-wrapper {
        text-align: center;
        padding: 20px 0;
    }

    .profile-frame {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        padding: 4px;
        background: #ffffff;
        margin: 0 auto 10px auto;
    }

    .profile-frame img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-name {
        font-weight: 600;
        color: #fff;
        margin-bottom: 0;
    }

    .profile-role {
        font-size: 12px;
        color: #ccc;
    }

    .divider-white {
        height: 1px;
        background: rgba(255,255,255,0.3);
        margin: 20px;
    }

    .logout-btn {
        margin: 0 20px 20px 20px;
        display: flex;
        justify-content: center;
    }
</style>

<nav class="nxl-navigation">
    <div class="navbar-wrapper">

        <div class="m-header text-center">
            <a href="{{ route('gurubk.dashboard') }}" class="b-brand">
                <img src="{{ asset('img/logo_ebk-careGold.png') }}" 
                     alt="Logo" 
                     class="logo logo-sm" />
            </a>
        </div>

        <div class="navbar-content">

            <div class="profile-wrapper">
                <div class="profile-frame">
                    <img src="{{ asset('assets/images/profile.jpeg') }}" alt="Profile">
                </div>

                <h6 class="profile-name">
                    {{ auth()->user()->name ?? 'Guru BK' }}
                </h6>
                <small class="profile-role">NIP.</small>
            </div>

            <div class="divider-white"></div>

            <ul class="nxl-navbar">
                <li class="nxl-item">
                    <a href="{{ route('gurubk.dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Manajemen Siswa</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.siswa.index') }}">Data Siswa</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.riwayatpelanggaran.index') }}">Data Pelanggaran</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.riwayatpelanggaran.akumulasi')}}">Akumulasi Poin</a></li>
                    </ul>
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-message-circle"></i></span>
                        <span class="nxl-mtext">Layanan Konseling</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.chat.index') }}">Pesan Chat</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.konseling.index') }}">Request Konseling</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.konseling.konseling') }}">List Konseling</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.saran.index') }}">Saran Siswa</a></li>
                    </ul>
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-printer"></i></span>
                        <span class="nxl-mtext">Administrasi</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.selfreport.index') }}">Self Report</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('gurubk.e_surat.index') }}">Cetak E-SP</a></li>
                    </ul>
                </li>
            </ul>

            <div class="divider-white"></div>
            <div class="logout-btn">
                <form method="POST" action="{{ route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-light px-4">
                        <i class="feather-log-out me-1"></i> Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>
