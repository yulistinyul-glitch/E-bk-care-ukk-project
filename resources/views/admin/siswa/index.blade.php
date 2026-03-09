@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
.header-title { font-size: 24px; font-weight: 800; color: #333; }
/* SUBTITLE */
.header-subtitle { font-size: 13px; color: #888; margin-top: 5px; display: block; }

.btn-catat { background:#5d5fef;color:white;padding:8px 18px;border-radius:10px;font-weight:600;font-size:13px;text-decoration:none;transition:.3s; }
.btn-catat:hover { transform:translateY(-2px); }
.btn-history { background:#b5b5b5;color:white;padding:8px 20px;border-radius:10px;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;gap:8px; }
.btn-history:hover { background:#999;color:white; }
.main-wrapper { background:white;border-radius:10px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.03); }
.filter-area { padding:20px; }

/* SEARCH ICON WRAPPER */
.search-wrapper { position: relative; display: flex; align-items: center; }
.search-wrapper i { position: absolute; left: 12px; color: #a0aec0; font-size: 14px; }
.search-wrapper .input-group-custom { padding-left: 35px !important; }

.input-group-custom { border:1px solid #e2e8f0;border-radius:10px;height:34px;font-size:12px;padding:0 12px;width:100%; outline: none; }
.btn-export-solid { height:34px;background:#5bcb65;color:white;border:none;border-radius:10px;font-size:12px;padding:0 15px;display:inline-flex;align-items:center;gap:6px;text-decoration:none; }
.table-container { padding:0 20px 20px 20px; }
.table thead th { background:#f8fafc;border:none;font-size:12px;color:#888;font-weight:600;padding:12px; }
.table tbody td { font-size:12.5px;padding:12px;border-bottom:1px solid #f1f1f1; }

/* TABLE CLASS DROPDOWN STYLE */
.table-select-display { 
    border: 1px solid #eef2f7; 
    background: #f8fafc; 
    font-size: 11px; 
    font-weight: 700; 
    padding: 4px 10px; 
    border-radius: 7px; 
    color: #0000009e;
    appearance: none;
    cursor: default;
}

.badge-jk { padding:4px 10px;border-radius:6px;font-size:11px;font-weight:600; }
.badge-l { background:#e3f2fd;color:#1976d2; }
.badge-p { background:#fce4ec;color:#d81b60; }
.btn-action-icon { border:none;background:none;font-size:1.1rem;cursor:pointer; }
.icon-edit { color:#ffb74d; }
.icon-delete { color:#ff7070; }
.btn-action-icon:hover { transform:scale(1.15); }
.pagination-wrapper { display: flex !important; justify-content: center !important; padding: 20px 0; }
.page-link { padding: 3px 10px; font-size: 11px; border-radius: 5px !important; }
.import-box { background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px;padding:12px;margin-top:12px; }

/* SWAL CUSTOM (TIDAK DIGANTI) */
.my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
.swal2-title { font-size: 18px !important; font-weight: 700 !important; }
.swal2-html-container { font-size: 13px !important; }
.swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
.swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
</style>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">Manajemen Data Siswa</h4>
            <span class="header-subtitle">Daftar seluruh siswa aktif beserta informasi kelas dan jurusan.</span>
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
            <form action="{{ route('admin.siswa.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" class="input-group-custom"
                                   placeholder="Cari Nama atau NIPD..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <select name="kelas" class="input-group-custom" onchange="this.form.submit()">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas ?? [] as $k)
                                <option value="{{ $k->id_kelas }}"
                                    {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                                    {{ $k->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('admin.siswa.cetak.semua') }}" class="btn-export-solid">
                           <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
            </form>

            <div class="import-box">
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-center">
                    @csrf
                    <div class="col-md-4">
                        <input type="file" name="file" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success btn-sm">
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
                            <th class="text-start">Nama</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>JK</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                        <tr>
                            <td>{{ $siswa->firstItem() + $index }}</td>
                            <td class="fw-bold">{{ $s->NIPD }}</td>
                            <td class="text-start">{{ $s->nama_siswa }}</td>
                            <td>
                                <select class="table-select-display" disabled>
                                    <option>{{ $s->kelas->nama_lengkap ?? '-' }}</option>
                                </select>
                            </td>
                            <td>{{ $s->kelas?->walikelas?->nama_guru ?? '-' }}</td>
                            <td>
                                <span class="badge-jk {{ $s->JK == 'L' ? 'badge-l' : 'badge-p' }}">
                                    {{ $s->JK }}
                                </span>
                            </td>
                            <td>{{ $s->no_telp }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('admin.siswa.edit', $s->id_siswa) }}" class="btn-action-icon icon-edit">
                                         <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn-action-icon icon-delete" onclick="hapusData('{{ $s->id_siswa }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-{{ $s->id_siswa }}" action="{{ route('admin.siswa.destroy', $s->id_siswa) }}" method="POST" style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted py-5">Data tidak ditemukan</td>
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
            timer: 2000,
            timerProgressBar: true,
            customClass: { popup: 'my-swal-popup', title: 'swal2-title', htmlContainer: 'swal2-html-container' }
        });
    @endif

    function hapusData(id) {
        Swal.fire({
            title: 'Pindahkan ke History?',
            text: "Data siswa akan dipindahkan ke history.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Pindahkan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: { popup: 'my-swal-popup', confirmButton: 'swal-button-custom', cancelButton: 'swal-button-custom' }
        }).then(function(result) {
            if (result.value) { document.getElementById('delete-' + id).submit(); }
        });
    }
</script>
@endsection