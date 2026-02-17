@extends('admin.layouts.app')

@section('title', 'Data Pelanggaran')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 
    .header-title { font-size: 28px; font-weight: 700; color: #333; }

    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 12px 25px;
        border-radius: 12px; font-weight: 600;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.3);
    }
    .btn-catat:hover { 
        background-color: #4a4cd9; 
        color: white; 
        transform: translateY(-2px);
    }

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

    .table-container {
        background: white; border-radius: 20px;
        padding: 20px; margin-top: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .badge-tingkat {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .ringan { background: #e3f2fd; color: #1976d2; }
    .sedang { background: #fff3e0; color: #ef6c00; }
    .berat { background: #ffebee; color: #c62828; }

    .btn-action {
        width: 36px; height: 36px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; border: none; color: white;
        font-size: 16px;
        transition: 0.2s;
    }
    .btn-action:hover { transform: translateY(-1px); }
    .btn-edit { background-color: #ffb74d; }
    .btn-delete { background-color: #ff7070; }

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

<div class="d-flex justify-content-between align-items-center mb-3 mt-3">
    <h4 class="header-title">Data Pelanggaran</h4>
    <a href="{{ route('admin.pelanggaran.create') }}" class="btn-catat">
        + Tambah Pelanggaran
    </a>
</div>

<div class="import-card">
    <form action="{{ route('admin.pelanggaran.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
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

<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Jenis Kegiatan</th>
                    <th>Tingkatan</th>
                    <th>Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggaran as $i => $p)
                <tr>
                    <td>{{ $pelanggaran->firstItem() + $i }}</td>
                    <td class="fw-bold">{{ $p->id_pelanggaran }}</td>
                    <td>{{ $p->kategori_pelanggaran }}</td>
                    <td class="text-start">{{ $p->jenis_kegiatan }}</td>
                    <td>
                        <span class="badge-tingkat {{ $p->tingkatan }}">
                            {{ ucfirst($p->tingkatan) }}
                        </span>
                    </td>
                    <td>{{ $p->poin_pelanggaran }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.pelanggaran.edit', $p->id_pelanggaran) }}" class="btn-action btn-edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.pelanggaran.destroy', $p->id_pelanggaran) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action btn-delete" onclick="return confirm('Hapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted py-5">
                        <i class="bi bi-exclamation-circle fs-1"></i>
                        <p class="mt-3">Belum ada data pelanggaran</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $pelanggaran->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
