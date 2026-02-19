@extends('admin.layouts.app')

@section('title', 'Data Walikelas')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 

    /* Judul & Tombol di Luar Card */
    .header-title { font-size: 26px; font-weight: 700; color: #333; } 
    
    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 10px 20px;
        border-radius: 12px; font-weight: 600;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.2);
    }
    .btn-catat:hover { background-color: #4a4cd9; color: white; transform: translateY(-2px); }

    /* Pembungkus Utama (Card) */
    .main-wrapper {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        margin-top: 10px;
    }

    /* Area Filter */
    .filter-area { padding: 25px; }
    
    .input-group-custom {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        height: 38px;
        padding: 0 15px;
        font-size: 14px;
        width: 70%;
        outline: none;
        transition: 0.3s;
    }
    .input-group-custom:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }

    .btn-search-outline {
        height: 38px;
        background: white;
        border: 2px solid #3b82f6;
        color: #3b82f6;
        border-radius: 12px;
        font-weight: 600;
        padding: 0 25px;
        transition: 0.3s;
        width: 60%;
    }
    .btn-search-outline:hover { background: #3b82f6; color: white; }

    .btn-export-solid {
        height: 38px;
        background: #5bcb65;
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        width: 80%;
        transition: 0.3s;
    }
    .btn-export-solid:hover { background: #48b352; color: white; opacity: 0.9; }

    /* Import Box */
    .import-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 15px;
        margin-top: 20px;
    }

    /* Tabel Section */
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
    .btn-view { background-color: #4dabff; }
    .btn-edit { background-color: #ffb74d; }
    .btn-delete { background-color: #ff7070; }
    .btn-action:hover { opacity: 0.8; color: white; transform: scale(1.05); }
</style>

<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title">Data Walikelas</h4>
        </div>
        <a href="{{ route('admin.walikelas.create') }}" class="btn-catat">
            <i class="bi bi-plus-lg"></i> Tambah Walikelas
        </a>
    </div>

    <div class="main-wrapper shadow">
        
        <div class="filter-area">
            <form action="" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #b5b5b5;"></i>
                            <input type="text" name="search" class="input-group-custom" 
                                placeholder="Cari Nama atau NIP..." 
                                value="{{ request('search') }}" 
                                style="padding-left: 45px;">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn-search-outline">Search</button>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.walikelas.cetak.semua') }}" class="btn-export-solid">
                            <i class="bi bi-file-earmark-pdf"></i> Export
                        </a>
                    </div>
                </div>
            </form>

            <div class="import-box">
                <form action="{{ route('admin.walikelas.import') }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-center">
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
                            <th>NIP</th>
                            <th class="text-start">Nama Walikelas</th>
                            <th>Kelas</th>
                            <th>JK</th> 
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($walikelas as $index => $w)
                        <tr>
                            <td>{{ $walikelas->firstItem() + $index }}</td>
                            <td class="fw-bold text-dark">{{ $w->NIP }}</td>
                            <td class="text-start fw-semibold">{{ $w->nama_guru }}</td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1" style="border-radius: 8px;">
                                    {{ $w->kelas->nama_lengkap ?? 'Belum Ada Kelas' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-jk {{ $w->JK == 'L' ? 'badge-l' : 'badge-p' }}">
                                    {{ $w->JK }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.walikelas.show', $w->id_walikelas) }}" class="btn-action btn-view shadow-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.walikelas.edit', $w->id_walikelas) }}" class="btn-action btn-edit shadow-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.walikelas.destroy', $w->id_walikelas) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete shadow-sm" onclick="return confirm('Hapus data walikelas ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-person-exclamation" style="font-size: 50px; opacity: 0.5;"></i>
                                <p class="mt-3 fw-bold">Belum ada data walikelas.</p>
                                <small>Silakan tambah data atau import file excel.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center pb-2">
                {{ $walikelas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection