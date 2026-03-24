@extends('gurubk.layouts.app')

@section('title', 'Akumulasi Poin Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="header-title">Akumulasi Poin Siswa</h4>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3" style="border-radius: 15px; background: #5d5fef; color: white;">
            <small>Total Siswa Melanggar</small>
            <h2 class="fw-bold mb-0">{{ $totalSiswaMelanggar }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 text-white" style="border-radius: 15px; background: #ff4757;">
            <small>Siswa Zona Merah (SP 3/DO)</small>
            <h2 class="fw-bold mb-0">{{ $siswaSp3 }}</h2>
        </div>
    </div>
</div>

<div class="table-container shadow-sm p-4 bg-white" style="border-radius: 20px;">
    <form action="{{ route('gurubk.riwayatpelanggaran.akumulasi') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control rounded-pill" placeholder="Cari nama siswa..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="id_kelas" class="form-select rounded-pill" onchange="this.form.submit()">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                        {{ $k->nama_kelas }} {{ $k->jurusan }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle text-center">
            <thead class="text-muted">
                <tr>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>Total Poin</th>
                    <th>Status SP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswaList as $s)
                @if($s->total_poin > 0) <tr>
                    <td class="text-start">
                        <div class="fw-bold">{{ $s->nama_siswa }}</div>
                        <small class="text-muted">{{ $s->NISN }}</small>
                    </td>
                    <td>{{ $s->kelas->nama_kelas }} {{ $s->kelas->jurusan }}</td>
                    <td>
                        <span class="badge {{ $s->total_poin >= 50 ? 'bg-danger' : 'bg-light text-dark' }} px-3 py-2 rounded-pill">
                            {{ $s->total_poin }} Poin
                        </span>
                    </td>
                    <td>
                        @php
                            $badgeColor = 'bg-success';
                            if($s->status_sp == 'SP 1') $badgeColor = 'bg-warning text-dark';
                            if($s->status_sp == 'SP 2') $badgeColor = 'bg-orange text-white'; // Tambahkan css orange jika perlu
                            if($s->status_sp == 'SP 3' || $s->status_sp == 'DROP OUT') $badgeColor = 'bg-danger';
                        @endphp
                        <span class="badge {{ $badgeColor }} rounded-pill px-3">
                            {{ $s->status_sp }}
                        </span>
                    </td>
                    <td style="display: flex; gap: 10px;">
                        <a href="{{ route('gurubk.riwayatpelanggaran.akumulasi', ['search' => $s->nama_siswa]) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                            Lihat Detail
                        </a>
                        <a href="{{ route('gurubk.e_surat.index', ['id_siswa' => $s->id_siswa]) }}" class="btn btn-sm btn-danger shadow-sm">
                            <i class="bi bi-file-earmark-plus"></i>Buat E-SP
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection