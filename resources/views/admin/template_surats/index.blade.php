@extends('admin.layouts.app')

@section('title', 'Data Template Surat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 24px; font-weight: 700; color: #333; }
    .header-subtitle { font-size: 13px; color: #888; margin-top: -5px; }
    
    .btn-catat { background:#5d5fef;color:white;padding:8px 18px;border-radius:10px;font-weight:600;font-size:13px;text-decoration:none;transition:.3s; border:none; cursor:pointer; }
    .btn-catat:hover { transform:translateY(-2px); color:white; opacity:0.9; }
    
    .btn-history { background:#b5b5b5;color:white;padding:8px 20px;border-radius:10px;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;gap:8px; }
    .btn-history:hover { background:#999;color:white; }
    
    .main-wrapper { background:white;border-radius:10px;overflow:hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); margin-top: 20px; }
    
    .table-container { padding:20px; }
    .table thead th { background:#f8fafc;border:none;font-size:12px;color:#888;font-weight:600;padding:12px; text-transform: uppercase; }
    .table tbody td { font-size:12.5px;padding:12px;border-bottom:1px solid #f1f1f1; vertical-align: middle; }
    
    .badge-jk { padding:4px 10px;border-radius:6px;font-size:11px;font-weight:600; text-transform: uppercase; }
    .badge-sp { background:#fce4ec;color:#d81b60; }
    .badge-umum { background:#e3f2fd;color:#1976d2; }
    
    .btn-action-icon { border:none;background:none;font-size:1.1rem;cursor:pointer; transition: .2s; display: inline-flex; }
    .icon-edit { color:#ffb74d; }
    .icon-delete { color:#ff7070; }
    .btn-action-icon:hover { transform:scale(1.15); }

    .modal-content { border-radius: 20px; border: none; }
    .input-modal { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; height: 40px; padding: 0 12px; font-size: 13px; width: 100%; outline: none; }

    .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-start mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">Data Template Surat</h4>
            <p class="header-subtitle">Kelola master dokumen template surat peringatan dan umum.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.template_surats.history') }}" class="btn-history">
                <i class="bi bi-clock-history"></i> History
            </a>
            <button class="btn-catat" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="bi bi-plus-lg"></i> Tambah Template
            </button>
        </div>
    </div>

    <div class="main-wrapper shadow">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Template</th>
                            <th class="text-start">Nama Template</th>
                            <th>Jenis</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($templates as $index => $t)
                        <tr>
                            <td>{{ $templates->firstItem() + $index }}</td>
                            <td class="fw-bold">{{ $t->id_template }}</td>
                            <td class="text-start">{{ $t->nama_template }}</td>
                            <td>
                                <span class="badge-jk {{ $t->jenis_template == 'SP' ? 'badge-sp' : 'badge-umum' }}">
                                    {{ $t->jenis_template }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                <i class="bi bi-file-earmark-text"></i> {{ Str::limit($t->file, 15) }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn-action-icon icon-edit" 
                                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $t->id_template }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <button type="button" class="btn-action-icon icon-delete" 
                                            onclick="hapusData('{{ $t->id_template }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form id="delete-{{ $t->id_template }}" 
                                          action="{{ route('admin.template_surats.destroy', $t->id_template) }}" 
                                          method="POST" style="display:none;">
                                        @csrf @method('DELETE')
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

            <div class="d-flex justify-content-center mt-3">
                {{ $templates->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold" style="font-size:16px;">Tambah Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.template_surats.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Nama Template</label>
                        <input type="text" name="nama_template" class="input-modal" required placeholder="Masukkan nama template">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Jenis Template</label>
                        <select name="jenis_template" class="input-modal" required>
                            <option value="SP">SP</option>
                            <option value="UMUM">UMUM</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">File Dokumen</label>
                        <input type="file" name="file" class="form-control" style="border-radius:10px; font-size:12px;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn-catat w-100">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($templates as $t)
<div class="modal fade" id="modalEdit{{ $t->id_template }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold" style="font-size:16px;">Edit Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.template_surats.update', $t->id_template) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Nama Template</label>
                        <input type="text" name="nama_template" class="input-modal" value="{{ $t->nama_template }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Jenis Template</label>
                        <select name="jenis_template" class="input-modal" required>
                            <option value="SP" {{ $t->jenis_template == 'SP' ? 'selected' : '' }}>SP</option>
                            <option value="UMUM" {{ $t->jenis_template == 'UMUM' ? 'selected' : '' }}>UMUM</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Ganti File (Opsional)</label>
                        <input type="file" name="file" class="form-control" style="border-radius:10px; font-size:12px;">
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn-catat w-100">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

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

    function hapusData(id) {
        Swal.fire({
            title: 'Pindahkan ke History?',
            text: "Data akan dipindahkan ke history.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Pindahkan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'my-swal-popup',
                confirmButton: 'swal-button-custom',
                cancelButton: 'swal-button-custom'
            }
        }).then(function(result) {
            if (result.value) {
                document.getElementById('delete-' + id).submit();
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.modal').forEach(m => document.body.appendChild(m));
    });
</script>

@endsection