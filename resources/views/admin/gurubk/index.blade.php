@extends('admin.layouts.app')

@section('title', 'Manajemen GuruBK')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 24px; font-weight: 700; color: #333; }
    .sub-title { font-size: 13px; color: #888; margin-top: 5px; display: block; }
    
    /* Tombol Style */
    .btn-catat { background:#5d5fef;color:white;padding:8px 18px;border-radius:10px;font-weight:600;font-size:13px;text-decoration:none;transition:.3s; display: inline-flex; align-items: center; gap: 8px; }
    .btn-catat:hover { transform:translateY(-2px); color: white; box-shadow: 0 4px 12px rgba(93, 95, 239, 0.2); }
    
    /* Container Style */
    .main-wrapper { background:white;border-radius:10px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.03); margin-top: 20px; }
    
    /* Table Style */
    .table-container { padding:20px; }
    .table thead th { background:#f8fafc;border:none;font-size:12px;color:#888;font-weight:600;padding:12px; text-transform: uppercase; }
    .table tbody td { font-size:12.5px;padding:12px;border-bottom:1px solid #f1f1f1; }
    
    /* Badge JK */
    .badge-jk { padding:4px 10px;border-radius:6px;font-size:11px;font-weight:600; }
    .badge-l { background:#e3f2fd;color:#1976d2; }
    .badge-p { background:#fce4ec;color:#d81b60; }
    
    /* Action Buttons */
    .btn-action-icon { border:none;background:none;font-size:1.1rem;cursor:pointer; transition: 0.2s; padding: 0; }
    .icon-edit { color:#ffb74d; }
    .icon-delete { color:#ff7070; }
    .btn-action-icon:hover { transform:scale(1.15); }

    .pagination-wrapper { display: flex !important; justify-content: center !important; padding: 20px 0; }

    /* SweetAlert Customization */
    .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
</style>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-start mb-4 px-2">
        <div>
            <h4 class="header-title mb-1">Manajemen Data Guru BK</h4>
            <span class="sub-title">Daftar Seluruh Guru Bimbingan Konseling</span>
        </div>
        <a href="{{ route('admin.gurubk.create') }}" class="btn-catat">
            <i class="bi bi-plus-lg"></i> Tambah Guru
        </a>
    </div>

    @if(session('default_password'))
    <div class="alert alert-info border-0 shadow-sm mb-4" style="border-radius: 10px; font-size: 13px;">
        <i class="bi bi-info-circle-fill me-2"></i>
        Password default Guru BK baru: <strong>{{ session('default_password') }}</strong>
    </div>
    @endif

    <div class="main-wrapper shadow">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Guru</th>
                            <th>NIP</th>
                            <th class="text-start">Nama Lengkap</th>
                            <th>JK</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurubk as $index => $g)
                        <tr>
                            <td>{{ $gurubk->firstItem() + $index }}</td>
                            <td class="fw-bold text-primary">{{ $g->id_gurubk }}</td>
                            <td>{{ $g->NIP ?? '-' }}</td>
                            <td class="text-start fw-medium">{{ $g->nama_gurubk }}</td>
                            <td>
                                <span class="badge-jk {{ $g->JK == 'L' ? 'badge-l' : 'badge-p' }}">
                                    {{ $g->JK }}
                                </span>
                            </td>
                            <td>{{ $g->no_telp }}</td>
                            <td>{{ $g->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('admin.gurubk.edit', $g->id_gurubk) }}" 
                                       class="btn-action-icon icon-edit" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button type="button" 
                                            class="btn-action-icon icon-delete" 
                                            onclick="confirmDelete('{{ $g->id_gurubk }}')" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form id="delete-form-{{ $g->id_gurubk }}" 
                                          action="{{ route('admin.gurubk.destroy', $g->id_gurubk) }}" 
                                          method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted py-5">
                                <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                                Belum ada data Guru BK
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
                popup: 'my-swal-popup',
                title: 'swal2-title',
                htmlContainer: 'swal2-html-container'
            }
        });
    @endif

    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data Guru BK akan dihapus permanen dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff7070',
            cancelButtonColor: '#b5b5b5',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'my-swal-popup',
                confirmButton: 'swal-button-custom',
                cancelButton: 'swal-button-custom'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection