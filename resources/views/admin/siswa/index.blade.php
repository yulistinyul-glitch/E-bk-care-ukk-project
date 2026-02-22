@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 

    .header-title { font-size: 26px; font-weight: 700; color: #333; } 
    .header-subtitle { font-size: 13px; color: #888; margin-top: -5px; margin-bottom: 25px; }

    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 10px 20px;
        border-radius: 12px; font-weight: 600;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.2);
    }
    .btn-catat:hover { color: white; opacity: 0.9; transform: translateY(-2px); }

    .btn-history {
        background-color: #b5b5b5;
        color: white;
        padding: 10px 25px;
        border-radius: 15px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.3s;
    }
    .btn-history:hover { background-color: #999; color: white; transform: translateY(-2px); }

    .main-wrapper {
        background: white;
        border-radius: 24px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .filter-area { padding: 25px; }
    
    .input-group-custom {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        height: 35px;
        padding: 0 15px;
        font-size: 14px;
        width: 100%;
    }

    .btn-search-outline {
        height: 35px;
        background: white;
        border: 2px solid #3b82f6;
        color: #3b82f6;
        border-radius: 12px;
        font-weight: 600;
        padding: 0 25px;
        transition: 0.3s;
    }
    .btn-search-outline:hover { background: #3b82f6; color: white; }

    .btn-export-solid {
        height: 35px;
        background: #5bcb65;
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .table-container { padding: 0 20px 20px 20px; }
    .table thead th { 
        background-color: #f8fafc;
        border: none; 
        font-size: 13px; 
        color: #888; 
        font-weight: 600; 
        padding: 15px;
    }
    .table tbody td { padding: 15px; color: #444; font-size: 14px; border-bottom: 1px solid #f8f9fa; }
    
    .badge-jk { padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; }
    .badge-l { background-color: #e3f2fd; color: #1976d2; }
    .badge-p { background-color: #fce4ec; color: #d81b60; }

    .btn-action-icon {
        border: none;
        background: none;
        padding: 0;
        font-size: 1.25rem;
        transition: 0.2s;
        cursor: pointer;
    }
    .icon-edit { color: #ffb74d; }
    .icon-edit:hover { color: #f5a623; transform: scale(1.2); }
    .icon-delete { color: #ff7070; }
    .icon-delete:hover { color: #ff4d4d; transform: scale(1.2); }
    
    .pagination-wrapper {
        display: flex !important;
        justify-content: center !important;
        padding: 30px 0;
        width: 100%;
    }
    .pagination-wrapper nav {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .pagination { margin-bottom: 12px; gap: 4px; }
    .page-link {
        padding: 4px 12px;
        font-size: 12px;
        color: #666;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px !important;
    }
    .page-item.active .page-link {
        background-color: #b5b5b5;
        border-color: #b5b5b5;
        color: #fff;
    }
    .page-link:hover { color: #333; background-color: #f1f1f1; }

    .import-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 15px;
        margin-top: 15px;
    }

    .my-swal-popup { 
        border-radius: 24px !important; 
        padding: 2.5em !important; 
        width: 400px !important; 
    }

    .swal2-title { 
        font-family: 'Poppins', sans-serif; 
        font-weight: 700 !important; 
        color: #333 !important; 
    }

    .swal2-html-container { 
        font-family: 'Poppins', sans-serif; 
        color: #666 !important; 
    }

    .swal-button-custom {
        border-radius: 10px !important; 
        padding: 8px 25px !important; 
        font-size: 14px !important;
        font-weight: 600 !important;
        margin: 0 8px !important;
        transition: all 0.3s ease !important;
    }

    .swal-button-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .swal-btn-cancel {
        background-color: #f1f1f1 !important;
        color: #888 !important;
    }

    .swal2-icon.swal2-warning {
        animation: swal2-animate-pulse 1.5s infinite;
    }

    @keyframes swal2-animate-pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.08); }
        100% { transform: scale(1); }
    }

    .swal2-styled:focus {
        box-shadow: none !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">Manajemen Data Siswa</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.siswa.history') }}" class="btn-history">
                <i class="bi bi-clock-history"></i> History
            </a>
            <a href="{{ route('admin.siswa.create') }}" class="btn-catat">
                <i class="bi bi-plus-lg"></i> Catat Siswa
            </a>
        </div>
    </div>

    <div class="main-wrapper shadow">
        <div class="filter-area">
            <form action="" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #b5b5b5;"></i>
                            <input type="text" name="search" class="input-group-custom" 
                                placeholder="Cari Nama atau NIPD..." 
                                value="{{ request('search') }}" 
                                style="padding-left: 45px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="kelas" class="input-group-custom" style="appearance: auto;">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas ?? [] as $k)
                                <option value="{{ $k->id_kelas }}" {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                                    {{ $k->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn-search-outline">Search</button>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('admin.siswa.cetak.semua') }}" class="btn-export-solid shadow">
                            <i class="bi bi-file-earmark-pdf"></i> Export Data
                        </a>
                    </div>
                </div>
            </form>

            <div class="import-box">
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-center">
                    @csrf
                    <div class="col-auto">
                        <span class="small fw-bold text-muted"><i class="bi bi-file-earmark-excel"></i> IMPORT:</span>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="file" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success btn-sm px-3" style="border-radius: 8px;">
                            <i class="bi bi-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIPD</th>
                            <th class="text-start">Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th> 
                            <th>JK</th> 
                            <th>No. Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                        <tr>
                            <td>{{ $siswa->firstItem() + $index }}</td>
                            <td class="fw-bold text-dark">{{ $s->NIPD }}</td>
                            <td class="text-start fw-semibold">{{ $s->nama_siswa }}</td>
                            <td>{{ $s->kelas->nama_lengkap ?? '-' }}</td> 
                            <td>{{ $s->kelas?->walikelas?->nama_guru ?? '-' }}</td>
                            <td>
                                <span class="badge-jk {{ $s->JK == 'L' ? 'badge-l' : 'badge-p' }}">
                                    {{ $s->JK == 'L' ? 'L' : 'P' }}
                                </span>
                            </td>
                            <td>{{ $s->no_telp }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('admin.siswa.edit', $s->id_siswa) }}" class="btn-action-icon icon-edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="delete-form-{{ $s->id_siswa }}" action="{{ route('admin.siswa.destroy', $s->id_siswa) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-action-icon icon-delete" onclick="confirmDelete('{{ $s->id_siswa }}', '{{ $s->nama_siswa }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-person-exclamation" style="font-size: 50px; opacity: 0.5;"></i>
                                <p class="mt-3 fw-bold">Belum ada data siswa.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $siswa->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            iconColor: '#00C897',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            showClass: { popup: 'animate__animated animate__fadeInUp animate__faster' },
            customClass: { popup: 'my-swal-popup' }
        });
    @endif

function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Siswa?',
        text: "Yakin ingin menghapus " + nama + "? Data ini akan dipindahkan ke folder History.",
        icon: 'warning',
        iconColor: '#ff7070',
        showCancelButton: true,
        confirmButtonColor: '#ff7070',
        cancelButtonColor: '#f1f1f1',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        showClass: {
            popup: 'animate__animated animate__zoomIn animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__zoomOut animate__faster'
        },
        customClass: {
            popup: 'my-swal-popup',
            confirmButton: 'swal-button-custom',
            cancelButton: 'swal-button-custom swal-btn-cancel'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>

@endsection