@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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

    .main-wrapper {
        background: white;
        border-radius: 24px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .nav-tabs-custom {
        display: flex;
        background: #f8fafc;
        padding: 12px 20px 0;
        border-bottom: 1px solid #edf2f7;
    }
    .tab-item {
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 600;
        color: #94a3b8;
        cursor: pointer;
        border-radius: 12px 12px 0 0;
    }
    .tab-item.active {
        background: white;
        color: #3b82f6;
        border: 1px solid #edf2f7;
        border-bottom: 1px solid white;
    }

    .filter-area { padding: 25px; }
    .label-mini { font-size: 13px; font-weight: 600; color: #444; margin-bottom: 8px; display: block; }
    
    .input-group-custom {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        height: 35px;
        padding: 0 15px;
        font-size: 14px;
        width: 80%;
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

    .btn-action {
        width: 32px; height: 32px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; border: none; transition: 0.2s; color: white;
    }
    .btn-edit { background-color: #ffb74d; }
    .btn-delete { background-color: #ff7070; }
    
    .import-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 15px;
        margin-top: 15px;
    }
</style>

<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-4">Manajemen Data Siswa</h4>
        </div>
        <a href="{{ route('admin.siswa.create') }}" class="btn-catat">
            <i class="bi bi-plus-lg"></i> Catat Siswa
        </a>
    </div>

    <div class="main-wrapper shadow">
        
        <div class="filter-area">
            <form action="" method="GET">
                <div class="row g-3 align-items-end">
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
                    <div class="col-md-2">
                        <button type="submit" class="btn-search-outline w-100">Search</button>
                    </div>
                    <div class="col-md-3">
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

        @if(session('success'))
        <div class="p-4 pb-0">
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 15px;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

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
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.siswa.edit', $s->id_siswa) }}" class="btn-action btn-edit shadow-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.siswa.destroy', $s->id_siswa) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete shadow-sm" onclick="return confirm('Hapus data siswa ini?')">
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
                                <small>Silakan tambah data atau import file excel.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center pb-2">
                {{ $siswa->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection