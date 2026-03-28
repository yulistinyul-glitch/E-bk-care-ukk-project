@extends('admin.layouts.app')

@section('title', 'Manajemen GuruBK')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 24px; font-weight: 800; color: #333; }
    .sub-title { font-size: 13px; color: #888; margin-top: 5px; display: block; }
    
    .btn-catat { 
        background: #5d5fef; color: white; padding: 10px 20px; border-radius: 12px; 
        font-weight: 600; font-size: 13px; text-decoration: none; transition: .3s; 
        display: inline-flex; align-items: center; gap: 8px; border: none; 
    }
    .btn-catat:hover { transform: translateY(-2px); color: white; box-shadow: 0 4px 12px rgba(93, 95, 239, 0.2); }

    .main-wrapper { 
        background: white; border-radius: 15px; overflow: hidden; 
        box-shadow: 0 10px 30px rgba(0,0,0,.03); margin-top: 20px; 
    }

    .table-container { padding: 20px; }
    .table thead th { 
        background: #f8fafc; border: none; font-size: 12px; color: #888; 
        font-weight: 600; padding: 15px; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .table tbody td { font-size: 13px; padding: 15px; border-bottom: 1px solid #f8f9fa; color: #444; }

    .badge-jk { padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; }
    .badge-l { background: #e3f2fd; color: #1976d2; }
    .badge-p { background: #fce4ec; color: #d81b60; }

    .btn-action-icon { border: none; background: none; font-size: 1.2rem; cursor: pointer; transition: 0.2s; padding: 5px; line-height: 1; }
    .icon-edit { color: #ffb74d; }
    .icon-delete { color: #ff7070; }
    .btn-action-icon:hover { transform: scale(1.2); }

    .pagination-wrapper { display: flex !important; justify-content: center !important; padding: 25px 0 10px; }

   .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
    .swal-btn-cancel { background-color: #f1f1f1 !important; color: #666 !important; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-1">Manajemen Data Guru BK</h4>
            <span class="sub-title">Kelola informasi guru bimbingan konseling secara permanen</span>
        </div>
        <a href="{{ route('admin.gurubk.create') }}" class="btn-catat">
            <i class="bi bi-plus-lg"></i> Tambah Guru Baru
        </a>
    </div>

    {{-- Alert Info Password --}}
    @if(session('default_password'))
    <div class="alert alert-info border-0 shadow-sm mb-4 d-flex align-items-center" style="border-radius: 12px; font-size: 13px; background: #e0e7ff; color: #3730a3;">
        <i class="bi bi-shield-lock-fill fs-5 me-3"></i>
        <div>Password akun baru: <strong>{{ session('default_password') }}</strong></div>
    </div>
    @endif

    <div class="main-wrapper">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>ID Guru</th>
                            <th>NIP</th>
                            <th class="text-start">Nama</th>
                            <th>JK</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurubk as $index => $g)
                        <tr>
                            <td>{{ $gurubk->firstItem() + $index }}</td>
                            <td class="fw-bold text-primary">{{ $g->id_gurubk }}</td>
                            <td class="text-secondary">{{ $g->NIP ?? '-' }}</td>
                            <td class="text-start fw-semibold" style="color: #333;">{{ $g->nama_gurubk }}</td>
                            <td>
                                <span class="badge-jk {{ $g->JK == 'L' ? 'badge-l' : 'badge-p' }}">
                                    {{ $g->JK == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td>{{ $g->no_telp }}</td>
                            <td class="text-lowercase">{{ $g->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.gurubk.edit', $g->id_gurubk) }}" 
                                       class="btn-action-icon icon-edit" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn-action-icon icon-delete" 
                                            onclick="hapusGuruBK('{{ $g->id_gurubk }}','{{ $g->nama_gurubk }}')" 
                                            title="Hapus Permanen">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form id="delete-{{ $g->id_gurubk }}" 
                                        action="{{ route('admin.gurubk.destroy', $g->id_gurubk) }}" 
                                        method="POST" 
                                        style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted py-5 text-center">
                                <i class="bi bi-folder2-open fs-1 d-block mb-3 opacity-50"></i>
                                <p class="mb-0">Data Guru BK masih kosong</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $gurubk->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

// Alert Success
@if(session('success'))
Swal.fire({
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    icon: 'success',
    iconColor: '#00C897',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    customClass: { 
        popup: 'my-swal-popup'
    }
});
@endif


function hapusGuruBK(id, nama){

    Swal.fire({
        title: 'Hapus Data?',
        text: "Guru BK " + nama + " akan dihapus permanen.",
        icon: 'warning',
        iconColor: '#ff7070',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass:{
            popup:'my-swal-popup',
            confirmButton:'swal-button-custom',
            cancelButton:'swal-button-custom'
        }

    }).then(function(result){

        if(result.value){

            document.getElementById('delete-'+id).submit();

        }

    });

}

</script>
@endsection