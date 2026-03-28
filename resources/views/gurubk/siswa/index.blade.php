@extends('gurubk.layouts.app')

@section('title', 'Data Seluruh Siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .header-section { margin-bottom: 25px; }
    .header-title { font-size: 24px; font-weight: 700; color: #1a1a1a; }
    .header-subtitle { color: #71717a; font-size: 13px; }

    /* Layout Filter & Search */
    .filter-wrapper {
        display: flex;
        gap: 10px;
        justify-content: flex-start;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .search-container {
        position: relative;
        width: 100%;
        max-width: 320px; 
    }
    .search-input {
        width: 100%;
        padding: 9px 15px 9px 40px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: white;
        font-size: 13px;
        transition: 0.3s;
    }
    .search-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        outline: none;
    }
    .search-container i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 16px;
    }

    .filter-select {
        padding: 9px 12px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: white;
        font-size: 13px;
        color: #475569;
        min-width: 160px;
        outline: none;
        cursor: pointer;
    }

    /* Modern Table */
    .table-container {
        background: white;
        border-radius: 12px;
        padding: 10px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .table thead th {
        background: #f8fafc;
        border: none;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 12px;
    }
    .table tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
    }

    .badge-poin {
        background-color: #fff1f2;
        color: #e11d48;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 800;
        border: 1px solid #ffe4e6;
        font-size: 12px;
    }
    
    .walikelas-info {
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }
    .nama-wali {
        font-weight: 600;
        color: #4f46e5;
        font-size: 13px;
    }
    .id-wali {
        font-size: 10px;
        color: #94a3b8;
    }
    .small-jk { font-size: 10px; font-weight: 500; }
</style>

<div class="header-section">
    <h4 class="header-title">Data Seluruh Siswa</h4>
    <p class="header-subtitle">Kelola informasi siswa dan pantau hasil akumulasi poin pelanggaran.</p>
</div>

<div class="filter-wrapper">
    <form action="{{ route('gurubk.siswa.index') }}" method="GET" class="d-flex gap-2 w-100">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" name="search" class="search-input" 
                   placeholder="Cari NIPD atau Nama..." 
                   value="{{ request('search') }}">
        </div>

        <select name="id_kelas" class="filter-select" onchange="this.form.submit()">
            <option value="">-- Semua Kelas --</option>
            @foreach($list_kelas as $kls)
                <option value="{{ $kls->id_kelas }}" {{ request('id_kelas') == $kls->id_kelas ? 'selected' : '' }}>
                    {{ $kls->nama_lengkap }}
                </option>
            @endforeach
        </select>
        
        @if(request('search') || request('id_kelas'))
            <a href="{{ route('gurubk.siswa.index') }}" class="btn btn-light btn-sm d-flex align-items-center px-3" style="border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px;">
                Reset
            </a>
        @endif
    </form>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table align-middle text-center">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>NIPD</th>
                    <th class="text-start">Nama Siswa / JK</th>
                    <th>Kelas</th>
                    <th class="text-start">Wali Kelas</th>
                    <th>Poin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $index => $s)
                <tr>
                    <td class="text-muted">{{ $siswa->firstItem() + $index }}</td>
                    <td class="fw-bold text-dark">{{ $s->NIPD }}</td>
                    <td class="text-start">
                        <div class="fw-bold text-dark">{{ $s->nama_siswa }}</div>
                        <div class="text-muted small-jk text-uppercase">{{ $s->JK }}</div>
                    </td>
                    <td>
                        <span class="badge bg-light text-primary border px-2 py-1" style="font-size: 10px;">
                            {{ $s->kelas->nama_lengkap ?? '-' }}
                        </span>
                    </td>
                    <td class="text-start">
                        <div class="walikelas-info">
                            <span class="nama-wali">
                                {{ $s->kelas->walikelas->nama_guru ?? 'Belum Diatur' }}
                            </span>
                            <span class="id-wali">
                                ID: {{ $s->kelas->id_walikelas ?? '-' }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <span class="badge-poin">
                            {{ $s->total_poin ?? 0 }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-5 text-center text-muted">
                        <i class="bi bi-search mb-2" style="font-size: 24px;"></i>
                        <p style="font-size: 13px;">Data tidak ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($siswa->hasPages())
    <div class="mt-4 d-flex justify-content-center">
        {{ $siswa->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection