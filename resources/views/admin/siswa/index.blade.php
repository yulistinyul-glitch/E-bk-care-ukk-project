@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 
    .header-title { font-size: 28px; font-weight: 700; color: #333; text-transform: none; } 
    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 12px 25px;
        border-radius: 12px; font-weight: 600;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.3);
    }
    .btn-catat:hover { background-color: #4a4cd9; color: white; }
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
.import-card {
    margin-top: 20px;
    margin-bottom: 10px; /* kecilkan ini */
    display: flex;
    align-items: center;
    gap: 10px;
}
    .import-card input[type="file"] {
        width: 280px; /

    }
    
    .search-container {
        position: relative;
        max-width: 400px;
        margin-bottom: 12px;
    }
    .search-input {
        width: 100%;
        padding: 12px 45px; 
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        outline: none;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .icon-left {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #b5b5b5;
    }
    .icon-right {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #b5b5b5;
    }
    .select-kelas {
        width: 100%;
        max-width: 400px;
        padding: 12px 20px;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        background-color: white;
        color: #666;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23b5b5b5' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .btn-history {
        background-color: #b5b5b5;
        color: white; padding: 10px 25px;
        border-radius: 15px; font-weight: 500;
        text-decoration: none; display: flex; align-items: center; gap: 8px; transition: 0.3s;
    }
    .btn-history:hover { background-color: #999; color: white; }
    .table-container {
        background: white; border-radius: 20px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .table thead th { 
        border: none; 
        font-size: 14px; 
        color: #888; 
        font-weight: 600; 
        padding: 15px;
        text-transform: none;
    }
    .table tbody td { padding: 15px; color: #444; font-size: 14px; border-bottom: 1px solid #f8f9fa; }
    .badge-jk {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-l { background-color: #e3f2fd; color: #1976d2; }
    .badge-p { background-color: #fce4ec; color: #d81b60; }
    .btn-action {
        width: 32px; height: 32px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; border: none; transition: 0.2s; color: white;
    }
    .btn-edit { background-color: #ffb74d; }
    .btn-delete { background-color: #ff7070; }
    .btn-view { background-color: #a5a6f6; }
    .empty-state { padding: 60px 0; color: #b5b5b5; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h4 class="header-title">Data Siswa</h4>
    <a href="{{ route('admin.siswa.create') }}" class="btn-catat">
        + Tambah Siswa
    </a>
</div>

<div class="row align-items-end mb-3">
    <div class="col-md-8">
        <div class="search-container">
            <i class="bi bi-search icon-left"></i>
            <input type="text" class="search-input" placeholder="Cari siswa (Nama/NIPD)">
            <i class="bi bi-sliders icon-right"></i>
        </div>

        <select class="select-kelas">
            <option value="">Semua kelas</option>
            @foreach($kelas ?? [] as $k)
                <option value="{{ $k->id_kelas }}">{{ $k->nama_lengkap }}</option>
            @endforeach
        </select>
    </div>

 <div class="import-card d-flex justify-content-between align-items-center">

    <!-- FORM IMPORT -->
    <form action="{{ route('admin.siswa.import') }}" method="POST"
          enctype="multipart/form-data"
          class="d-flex gap-2 align-items-center">
        @csrf
        <input type="file" name="file" class="form-control" required>

        <button class="btn btn-import">
            <i class="bi bi-upload"></i> Import
        </button>
    </form>

    <!-- TOMBOL CETAK -->
    <a href="{{ route('admin.siswa.cetak.semua') }}"
       class="btn-history shadow-sm">
        <i class="bi bi-file-earmark-pdf"></i> Cetak Data
    </a>

</div>


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIPD</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Walikelas</th> 
                    <th>JK</th>                   
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $index => $s)
                <tr>
                    <td>{{ $siswa->firstItem() + $index }}</td>
                    <td class="fw-bold">{{ $s->NIPD }}</td>
                    <td class="text-start">{{ $s->nama_siswa }}</td>
                    <td>{{ $s->kelas->nama_lengkap ?? '-' }}</td> 
                    <td>{{ $s->kelas?->walikelas?->nama_guru ?? '-' }}</td>
                    <td> <span class="badge-jk {{ $s->JK == 'L' ? 'badge-l' : 'badge-p' }}"> {{ $s->JK }} </span> </td>
                    <td>{{ $s->no_telp }}</td>

                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.siswa.edit', $s->id_siswa) }}" class="btn-action btn-edit shadow-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.siswa.destroy', $s->id_siswa) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete shadow-sm" onclick="return confirm('Hapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="bi bi-person-exclamation" style="font-size: 48px;"></i>
                        <p class="mt-3 mb-0">Belum ada data tersedia.</p>
                        <small>Data akan muncul setelah anda menginput siswa baru.</small>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $siswa->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
