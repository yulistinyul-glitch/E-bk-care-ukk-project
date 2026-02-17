@extends('admin.layouts.app')

@section('title', 'Data Walikelas')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 28px; font-weight: 700; color: #333; text-transform: none; }
    
    /* Tombol Tambah */
    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 12px 25px;
        border-radius: 12px; font-weight: 600;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.3);
    }
    .btn-catat:hover { background-color: #4a4cd9; color: white; }

    .search-container {
        position: relative;
        max-width: 400px;
        margin-top: 28px;
    }
    .search-input {
        width: 100%;
        padding: 12px 45px; 
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        outline: none;
        font-size: 14px;
    }
    .icon-left { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #b5b5b5; }
    .icon-right { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #b5b5b5; }

    /* Tombol cetak */
    .btn-history {
        background-color: #b5b5b5;
        color: white; padding: 10px 25px;
        border-radius: 15px; font-weight: 500;
        text-decoration: none; display: flex; align-items: center; gap: 8px; transition: 0.3s;
    }
    .btn-history:hover { background-color: #999; color: white; }

    /* Tabel */
    .table-container {
        background: white; border-radius: 20px;
        padding: 20px; margin-top: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .table thead th { border: none; font-size: 14px; color: #888; font-weight: 600; padding: 15px; }
    .table tbody td { padding: 15px; color: #444; font-size: 14px; border-bottom: 1px solid #f8f9fa; }

    /* Badge jk */
    .badge-jk { padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; }
    .badge-l { background-color: #e3f2fd; color: #1976d2; }
    .badge-p { background-color: #fce4ec; color: #d81b60; }

    /* Action btn */
    .btn-action {
        width: 34px; height: 28px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; border: none; transition: 0.2s; color: white;
    }
    .btn-view { background-color: #4dabff; }
    .btn-edit { background-color: #ffb74d; }
    .btn-delete { background-color: #ff7070; }
    .btn-action:hover { opacity: 0.8; color: white; }

    .empty-state { padding: 60px 0; color: #b5b5b5; }

    /* Tombol Import */
    .btn-import {
        background-color: #28a745;
        color: white; padding: 8px 18px;
        border-radius: 8px; font-weight: 600;
        transition: 0.3s;
    }
    .btn-import:hover {
        background-color: #218838;
        transform: translateY(-1px);
    }

    /* Import form */
    .import-card {
        margin-top: 25px;  
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .import-card input[type="file"] {
        width: 280px; 
    } 
</style>

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3 mt-3">
    <h4 class="header-title">Data Walikelas</h4>
    <a href="{{ route('admin.walikelas.create') }}" class="btn-catat">
        + Tambah Walikelas
    </a>
</div>

{{-- Filter --}}
<div class="row align-items-end mb-3">
    <div class="col-md-8">
        <div class="search-container">
            <i class="bi bi-search icon-left"></i>
            <input type="text" class="search-input" placeholder="Cari walikelas (Nama/NIP)">
            <i class="bi bi-sliders icon-right"></i>
        </div>
    </div>

    <div class="col-md-4 text-end">
        <a href="#" class="btn-history d-inline-flex shadow-sm">
            <i class="bi bi-file-earmark-pdf"></i> Cetak data
        </a>
    </div>
</div>

{{-- Import --}}
<div class="import-card">
    <form action="{{ route('admin.walikelas.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
        @csrf
        <input type="file" name="file" class="form-control" required>
        <button class="btn btn-import">
            <i class="bi bi-upload"></i> Import
        </button>
    </form>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


{{-- Tabel --}}
<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Walikelas</th>
                    <th>Kelas</th>
                    <th>JK</th>             
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($walikelas as $index => $w)
                <tr>
                    <td>{{ $walikelas->firstItem() + $index }}</td>
                    <td class="fw-bold">{{ $w->NIP }}</td>
                    <td class="text-start">{{ $w->nama_guru }}</td>                
                    <td>
                        <span class="badge bg-light text-dark border">
                            {{ $w->kelas->nama_lengkap ?? 'Belum Ada Kelas' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge-jk {{ $w->JK == 'L' ? 'badge-l' : 'badge-p' }}">
                            {{ $w->JK == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.walikelas.show', $w->id_walikelas) }}" class="btn-action btn-view shadow-sm" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.walikelas.edit', $w->id_walikelas) }}" class="btn-action btn-edit shadow-sm" title="Edit Data">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.walikelas.destroy', $w->id_walikelas) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete shadow-sm" onclick="return confirm('Hapus data walikelas ini?')" title="Hapus Data">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <i class="bi bi-person-exclamation" style="font-size: 48px;"></i>
                        <p class="mt-3 mb-0">Belum ada data tersedia.</p>
                        <small>Data akan muncul setelah Anda menginput walikelas baru.</small>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $walikelas->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection