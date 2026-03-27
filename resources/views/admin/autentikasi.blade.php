@extends('admin.layouts.app')
@section('title', 'Dashboard Admin | Sistem BK Digital')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    body, h1, h2, h3, h4, h5, h6, .card, table, span {
        font-family: 'Poppins', sans-serif !important;
    }

    table { font-size: 0.85rem; }

    .status-pill {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
        display: inline-block;
        min-width: 90px;
    }

    .status-online {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-logout {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .icon-box {
        font-size: 3rem;
        opacity: 0.25;
        transition: all 0.3s ease;
    }

    .card:hover .icon-box {
        opacity: 0.5;
        transform: scale(1.1);
    }

    .card-body { padding: 1.25rem !important; }
</style>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h1 class="h3 text-gray-800" style="font-weight: 600;">
            Manajemen Sesi & Autentikasi
        </h1>
        <p class="text-muted">
            Pantau aktivitas login pengguna dan kelola status sesi secara real-time.
        </p>
    </div>

    <!-- BOX STATUS -->
    <div class="row">
        @php
            $boxes = [
                ['success', 'Sedang Login', 'Sedang Login', 'fas fa-user-check'],
                ['danger', 'Telah Logout', 'Telah Logout', 'fas fa-sign-out-alt'],
                ['secondary', 'Belum Login', 'Belum Login', 'fas fa-user-slash']
            ];
        @endphp

        @foreach($boxes as $item)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-{{$item[0]}} shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-{{$item[0]}} text-uppercase mb-1">
                                {{ $item[1] }}
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-dark">
                                {{ collect($data)->where('status', $item[2])->count() }} User
                            </div>
                        </div>

                        <div class="col-auto icon-box text-{{$item[0]}}">
                            <i class="{{ $item[3] }}"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- TABEL -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Daftar Aktivitas Pengguna
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>USER / ID</th>
                            <th>JABATAN</th>
                            <th>STATUS</th>
                            <th>TERAKHIR AKTIVITAS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse(collect($data)->whereIn('status', ['Sedang Login', 'Telah Logout']) as $u)
                        <tr>

                            <td class="align-middle">
                                <div style="font-weight: 600; color: #333;">
                                    {{ $u->nama_tampil ?? $u->username }}
                                </div>
                                <div style="font-size: 0.7rem; color: #858796;">
                                    ID: {{ $u->id_tampil ?? $u->id_pengguna }}
                                </div>
                            </td>

                            <td class="align-middle">
                                <span class="badge badge-light border text-dark">
                                    {{ $u->role }}
                                </span>
                            </td>

                            <td class="align-middle">
                                <span class="status-pill {{ $u->status == 'Sedang Login' ? 'status-online' : 'status-logout' }}">
                                    {{ $u->status }}
                                </span>
                            </td>

                            <td class="align-middle">
                                {{ $u->last_activity 
                                    ? \Carbon\Carbon::createFromTimestamp($u->last_activity)->diffForHumans() 
                                    : '-' 
                                }}
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                Belum ada aktivitas sesi pengguna yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>

<!-- AUTO REFRESH -->
<script>
    setInterval(() => {
        if (document.hasFocus()) {
            window.location.reload();
        }
    }, 60000);
</script>

@endsection