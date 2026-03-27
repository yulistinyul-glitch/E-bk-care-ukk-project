@extends('admin.layouts.app')

@section('title', 'Data Walikelas')

@section('content')
<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 24px; font-weight: 800; color: #333; }
    .header-subtitle { font-size: 13px; color: #888; margin-top: -2px; display: block; }

    .btn-catat { background:#5d5fef;color:white;padding:8px 18px;border-radius:10px;font-weight:600;font-size:13px;text-decoration:none;transition:.3s; }
    .btn-catat:hover { transform:translateY(-2px); color: white; }
    .btn-history { background:#b5b5b5;color:white;padding:8px 20px;border-radius:10px;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;gap:8px; }
    .btn-history:hover { background:#999;color:white; }
    .main-wrapper { background:white;border-radius:10px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.03); }
    .filter-area { padding:20px; }

    .search-wrapper { position: relative; display: flex; align-items: center; width: 100%; }
    .search-wrapper i { position: absolute; left: 12px; color: #a0aec0; font-size: 14px; }
    .search-wrapper .input-group-custom { padding-left: 35px !important; }

    .input-group-custom { border:1px solid #e2e8f0;border-radius:10px;height:34px;font-size:12px;padding:0 12px;width:100%; outline: none; transition: 0.2s; }
    .input-group-custom:focus { border-color: #5d5fef; box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1); }

    .btn-export-solid { height:34px;background:#5bcb65;color:white;border:none;border-radius:10px;font-size:12px;padding:0 15px;display:inline-flex;align-items:center;gap:6px;text-decoration:none; }
    .table-container { padding:0 20px 20px 20px; }
    .table thead th { background:#f8fafc;border:none;font-size:12px;color:#888;font-weight:600;padding:12px; }
    .table tbody td { font-size:12.5px;padding:12px;border-bottom:1px solid #f1f1f1; }
    .badge-jk { padding:4px 10px;border-radius:6px;font-size:11px;font-weight:600; }
    .badge-l { background:#e3f2fd;color:#1976d2; }
    .badge-p { background:#fce4ec;color:#d81b60; }
    .btn-action-icon { border:none;background:none;font-size:1.1rem;cursor:pointer; transition: 0.2s;}
    .icon-view { color: #4dabff; }
    .icon-edit { color:#ffb74d; }
    .icon-delete { color:#ff7070; }
    .btn-action-icon:hover { transform:scale(1.15); }
    .pagination-wrapper { display: flex !important; justify-content: center !important; padding: 20px 0; }
    .page-link { padding: 3px 10px; font-size: 11px; border-radius: 5px !important; }
    .import-box { background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px;padding:12px;margin-top:12px; }

    .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
</style>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">Manajemen Data Walikelas</h4>
            <span class="header-subtitle">Kelola informasi guru yang bertugas sebagai wali kelas.</span>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route(('admin.walikelas.history')) }}" class="btn-history">
                <i class="bi bi-clock-history"></i> History
            </a>
            <a href="{{ route('admin.walikelas.create') }}" class="btn-catat">
                <i class="bi bi-plus-lg"></i> Tambah Walikelas
            </a>
        </div>
    </div>

    <div class="main-wrapper shadow">
        <div class="filter-area">
            <form action="{{ route('admin.walikelas.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" class="input-group-custom"
                                   placeholder="Cari Nama atau NIP..."
                                   value="{{ request('search') }}"
                                   onkeyup="if(event.keyCode == 13) this.form.submit()">
                        </div>
                    </div>

                    <div class="col text-end">
                        <a href="{{ route('admin.walikelas.cetak.semua') }}" class="btn-export-solid">
                           <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
            </form>

            <div class="import-box">
                <form action="{{ route('admin.walikelas.import') }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-center">
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
                            <td class="fw-bold">{{ $w->NIP }}</td>
                            <td class="text-start">{{ $w->nama_guru }}</td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1" style="border-radius: 6px; font-size: 11px;">
                                    {{ $w->kelas->nama_lengkap ?? 'Belum Ada Kelas' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-jk {{ $w->JK == 'L' ? 'badge-l' : 'badge-p' }}">
                                    {{ $w->JK }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('admin.walikelas.show', $w->id_walikelas) }}" class="btn-action-icon icon-view">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.walikelas.edit', $w->id_walikelas) }}" class="btn-action-icon icon-edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button type="button" class="btn-action-icon icon-delete"
                                            onclick="hapusData('{{ $w->id_walikelas }}', '{{ $w->nama_guru }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form id="delete-{{ $w->id_walikelas }}"
                                          action="{{ route('admin.walikelas.destroy', $w->id_walikelas) }}"
                                          method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted py-5">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $walikelas->links('pagination::bootstrap-5') }}
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