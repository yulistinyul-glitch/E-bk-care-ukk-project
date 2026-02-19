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
        margin-bottom: 0;
        color: #fff;
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
                <img src="{{ asset('assets/images/bbc.png') }}" 
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
                    {{ auth()->user()->name ?? 'Admin' }}
                </h6>
                <small class="profile-role">NIP.</small>
            </div>

            <div class="divider-white"></div>

            <ul class="nxl-navbar">
                <li class="nxl-item">
                    <a href="{{ route('admin.dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('admin.siswa.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Data Siswa</span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user-check"></i></span>
                        <span class="nxl-mtext">Data Guru</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>

                    <ul class="nxl-submenu">
                        <li class="nxl-item">
                            <a href="{{ route('admin.gurubk.index') }}" class="nxl-link">
                                <span class="nxl-mtext">Data Guru BK</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="{{ route('admin.walikelas.index') }}" class="nxl-link">
                                <span class="nxl-mtext">Data Walikelas</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nxl-item">
                    <a href="{{ route('admin.kelas.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-layers"></i></span>
                        <span class="nxl-mtext">Data Kelas</span>
                    </a>
                </li>

                <li class="nxl-item">
                    <a href="{{ route('admin.pelanggaran.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-file-text"></i></span>
                        <span class="nxl-mtext">Data Pelanggaran</span>
                    </a>
                </li>

                <li class="nxl-item">
                    <a href="{{ route('admin.template_surats.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
                        <span class="nxl-mtext">Laporan E-SP</span>
                    </a>
                </li>

                <li class="nxl-item">
                    <a href="" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-activity"></i></span>
                        <span class="nxl-mtext">Monitoring</span>
                    </a>
                </li>

            </ul>
            <div class="divider-white"></div>
            <div class="logout-btn">
                <form method="POST" action="">
                    @csrf
                    <button type="submit" class="btn btn-light px-4">
                        <i class="feather-log-out me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
