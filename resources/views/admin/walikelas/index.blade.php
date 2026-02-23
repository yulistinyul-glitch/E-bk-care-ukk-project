@extends('admin.layouts.app')

@section('title', 'Data Walikelas')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 

    .header-title { font-size: 24px; font-weight: 700; color: #333; } 

    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 8px 18px;
        border-radius: 10px; font-weight: 600;
        font-size: 13px;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.2);
    }
    .btn-catat:hover { color: white; opacity: 0.9; transform: translateY(-2px); }

    .main-wrapper {
        background: white;
        border-radius: 20px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .filter-area { padding: 20px; }
    
    .input-group-custom {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        height: 32px;
        padding: 0 12px;
        font-size: 12px;
        width: 100%;
        outline: none;
    }
    
    .btn-export-solid {
        height: 32px;
        background: #5bcb65;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 12px;
        padding: 0 15px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .table-container { padding: 0 15px 15px 15px; }
    .table thead th { 
        background-color: #f8fafc;
        border: none; 
        font-size: 12px; 
        color: #888; 
        font-weight: 600; 
        padding: 12px;
    }
    /* Mengecilkan Text di Tabel */
    .table tbody td { padding: 12px; color: #444; font-size: 12.5px; border-bottom: 1px solid #f8f9fa; }
    
    .badge-jk { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
    .badge-l { background-color: #e3f2fd; color: #1976d2; }
    .badge-p { background-color: #fce4ec; color: #d81b60; }

    .btn-action-icon {
        border: none;
        background: none;
        padding: 0;
        font-size: 1.1rem;
        transition: 0.2s;
        cursor: pointer;
    }
    .icon-view { color: #4dabff; }
    .icon-edit { color: #ffb74d; }
    .icon-delete { color: #ff7070; }
    .btn-action-icon:hover { transform: scale(1.15); }
    
    .pagination-wrapper {
        display: flex !important;
        justify-content: center !important;
        padding: 20px 0;
    }
    .page-link { padding: 3px 10px; font-size: 11px; border-radius: 5px !important; }

    .import-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 10px;
        padding: 12px;
        margin-top: 12px;
    }

    /* KUSTOMISASI MODAL POPUP SUKSES (LEBIH KECIL) */
    .my-swal-popup { 
        border-radius: 18px !important; 
        padding: 1.5em !important; 
        width: 320px !important; /* Perkecil lebar modal */
    }

    .swal2-title { 
        font-size: 18px !important; /* Perkecil teks judul */
        font-weight: 700 !important; 
    }

    .swal2-html-container { 
        font-size: 13px !important; /* Perkecil teks pesan */
    }

    .swal2-icon {
        transform: scale(0.7); /* Perkecil icon centang/warning */
        margin: 10px auto 5px !important;
    }

    .swal-button-custom {
        border-radius: 8px !important; 
        padding: 6px 20px !important; 
        font-size: 12px !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">Manajemen Data Walikelas</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.walikelas.create') }}" class="btn-catat">
                <i class="bi bi-plus-lg"></i> Tambah Walikelas
            </a>
        </div>
    </div>

    <div class="main-wrapper shadow-sm">
        <div class="filter-area">
            <form action="" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #b5b5b5; font-size: 12px;"></i>
                            <input type="text" name="search" class="input-group-custom" 
                                placeholder="Cari Nama atau NIP..." 
                                value="{{ request('search') }}" 
                                style="padding-left: 35px;">
                        </div>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('admin.walikelas.cetak.semua') }}" class="btn-export-solid shadow-sm">
                            <i class="bi bi-file-earmark-pdf"></i> Export Data
                        </a>
                    </div>
                </div>
            </form>

            <div class="import-box">
                <form action="{{ route('admin.walikelas.import') }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-center">
                    @csrf
                    <div class="col-auto">
                        <span class="small fw-bold text-muted" style="font-size: 11px;"><i class="bi bi-file-earmark-excel"></i> IMPORT:</span>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="file" class="form-control form-control-sm" style="font-size: 11px;" required>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success btn-sm px-3" style="border-radius: 6px; font-size: 11px;">
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
                            <td class="fw-bold text-dark">{{ $w->NIP }}</td>
                            <td class="text-start fw-semibold">{{ $w->nama_guru }}</td>
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
                                    <form id="delete-form-{{ $w->id_walikelas }}" action="{{ route('admin.walikelas.destroy', $w->id_walikelas) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-action-icon icon-delete" onclick="confirmDelete('{{ $w->id_walikelas }}', '{{ $w->nama_guru }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-person-exclamation" style="font-size: 40px; opacity: 0.5;"></i>
                                <p class="mt-2 fw-bold" style="font-size: 13px;">Belum ada data walikelas.</p>
                            </td>
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
            timer: 2000, /* Durasi lebih cepat */
            timerProgressBar: true,
            customClass: { 
                popup: 'my-swal-popup',
                title: 'swal2-title',
                htmlContainer: 'swal2-html-container'
            }
        });
    @endif

function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus?',
        text: "Yakin ingin menghapus " + nama + "?",
        icon: 'warning',
        iconColor: '#ff7070',
        showCancelButton: true,
        confirmButtonColor: '#ff7070',
        cancelButtonColor: '#f1f1f1',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'my-swal-popup',
            confirmButton: 'swal-button-custom',
            cancelButton: 'swal-button-custom swal-btn-cancel'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>

@endsection