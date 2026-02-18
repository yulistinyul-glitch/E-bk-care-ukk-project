@extends('gurubk.layouts.app')

@section('title', 'Pelanggaran siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 28px; font-weight: 700; color: #333; }

    .btn-catat {
        background-color: #5d5fef;
        color: white;
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.3);
    }
    .btn-catat:hover {
        background-color: #4a4cd9;
        color: white;
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
        max-width: 500px;
        padding: 12px 20px;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        background-color: white;
        color: #666;
        appearance: none;
        background-repeat: no-repeat;
        background-position: right 20px center;
    }

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
    }

    .table-container {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-top: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .table thead th {
        border: none;
        font-size: 14px;
        color: #888;
        font-weight: 600;
        padding: 15px;
    }

    .empty-state {
        padding: 80px 0;
        color: #b5b5b5;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="header-title">Pelanggaran siswa</h4>

    <a href="{{ route('gurubk.riwayatpelanggaran.create') }}" class="btn-catat">
        + Catat pelanggaran
    </a>
</div>

<div class="row align-items-end mb-3">
    <div class="col-md-8">
        <div class="search-container">
            <i class="bi bi-search icon-left"></i>
            <input type="text" class="search-input" placeholder="Cari pelanggaran">
            <i class="bi bi-sliders icon-right"></i>
        </div>

        <select class="select-kelas">
            <option value="">Semua kelas</option>
            @if(isset($kelas) && $kelas->count())
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            @endif
        </select>

    </div>

    <div class="col-md-4 text-end">
        <a href="#" class="btn-history">
            <i class="bi bi-clock-history"></i> History
        </a>
    </div>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="bi bi-folder2-open" style="font-size: 48px;"></i>
                        <p class="mt-3 mb-0">Belum ada data tersedia.</p>
                        <small>Data akan muncul setelah anda menginput pelanggaran baru.</small>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

@endsection
