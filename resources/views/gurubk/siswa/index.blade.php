@extends('gurubk.layouts.app')

@section('title', 'Data Siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 
    .header-title { font-size: 28px; font-weight: 700; color: #333; }

    .btn-history {
        background-color: #b5b5b5;
        color: white; padding: 10px 25px;
        border-radius: 15px; font-weight: 500;
        text-decoration: none; display: flex;
        align-items: center; gap: 8px; transition: 0.3s;
    }
    .btn-history:hover { background-color: #999; color: white; }

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

    .select-kelas {
        width: 100%;
        max-width: 400px;
        padding: 12px 20px;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        background-color: white;
        color: #666;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .table-container {
        background: white; border-radius: 20px;
        padding: 20px; margin-top: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .table thead th { 
        border: none; 
        font-size: 14px; 
        color: #888; 
        font-weight: 600; 
        padding: 15px;
    }
    .table tbody td {
        padding: 15px;
        color: #444;
        font-size: 14px;
        border-bottom: 1px solid #f8f9fa;
    }

    .btn-view {
        background-color: #a5a6f6;
        color: white;
        border-radius: 8px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .empty-state { padding: 60px 0; color: #b5b5b5; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h4 class="header-title">Data Siswa</h4>

    <a href="{{ route('gurubk.siswa.cetak.semua') }}" 
       class="btn-history shadow-sm">
        <i class="bi bi-file-earmark-pdf"></i> Cetak data
    </a>
</div>

<div class="row align-items-end mb-3">
    <div class="col-md-8">
        <div class="search-container">
            <i class="bi bi-search icon-left"></i>
            <input type="text" class="search-input" placeholder="Cari siswa (Nama/NIPD)">
        </div>

        <select class="select-kelas">
            <option value="">Semua kelas</option>
            @foreach($kelas ?? [] as $k)
                <option value="{{ $k->id_kelas }}">{{ $k->nama_lengkap }}</option>
            @endforeach
        </select>
    </div>
</div>

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
                    <th>Detail</th>
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
                    <td>{{ $s->JK }}</td>
                    <td>{{ $s->no_telp }}</td>
                    <td>
                        <a href="{{ route('gurubk.siswa.show', $s->id_siswa) }}" 
                           class="btn-view shadow-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="bi bi-person-exclamation" style="font-size: 48px;"></i>
                        <p class="mt-3 mb-0">Belum ada data tersedia.</p>
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
