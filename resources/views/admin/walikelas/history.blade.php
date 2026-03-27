@extends('admin.layouts.app')

@section('title', 'History Walikelas')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 24px; font-weight: 700; color: #333; }
    .header-subtitle { font-size: 12px; color: #888; margin-top: -5px; margin-bottom: 25px; }
    .btn-back { background-color: #5d5fef; color: white; padding: 8px 18px; border-radius: 10px; font-weight: 600; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-back:hover { color: white; opacity: 0.9; transform: translateX(-5px); }
    .main-wrapper { background: white; border-radius: 10px; padding: 0; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .table-container { padding: 20px 15px 15px 15px; }
    .table thead th { background-color: #f8fafc; border: none; font-size: 12px; color: #888; font-weight: 600; padding: 12px; }
    .table tbody td { padding: 12px; color: #444; font-size: 12.5px; border-bottom: 1px solid #f8f9fa; }
    .btn-action-icon { border: none; background: none; padding: 0; font-size: 1.2rem; cursor: pointer; transition: 0.2s; }
    .icon-restore { color: #5bcb65; }
    .icon-delete-permanent { color: #ff7070; }
    .btn-action-icon:hover { transform: scale(1.2); }
    .pagination-wrapper { display: flex; justify-content: center; padding: 20px 0; }
    .page-link { padding: 3px 10px; font-size: 11px; border-radius: 5px; }

    /* KUSTOMISASI MODAL POPUP */
    .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">History Hapus Walikelas</h4>
            <p class="header-subtitle text-muted mt-2">Data walikelas yang dihapus dapat dipulihkan kembali.</p>
        </div>
        <div>
            <a href="{{ route('admin.walikelas.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Data
            </a>
        </div>
    </div>

    <div class="main-wrapper shadow">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th class="text-start">Nama Walikelas</th>
                            <th>Eks Kelas</th>
                            <th>Tgl Dihapus</th>
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
                                <span class="badge bg-light text-secondary border px-2 py-1" style="border-radius: 6px; font-size: 11px;">
                                    {{ $w->kelas->nama_lengkap ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $w->deleted_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    {{-- Restore --}}
                                    <form action="{{ route('admin.walikelas.restore', $w->id_walikelas) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-action-icon icon-restore" title="Kembalikan Data">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </form>

                                    {{-- Hapus Permanen --}}
                                    <button type="button" class="btn-action-icon icon-delete-permanent" 
                                            title="Hapus Permanen" 
                                            onclick="confirmForceDelete('{{ $w->id_walikelas }}', '{{ $w->nama_guru }}')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>

                                    <form id="force-delete-{{ $w->id_walikelas }}" 
                                          action="{{ route('admin.walikelas.forceDelete', $w->id_walikelas) }}" 
                                          method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Tidak ada history penghapusan walikelas.
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
    // Alert Sukses (Restore/Delete)
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            iconColor: '#5d5fef',
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

    // Konfirmasi Hapus Permanen
    function confirmForceDelete(id, name) {
        Swal.fire({
            title: 'Hapus Permanen?',
            text: "Data " + name + " akan dihapus selamanya dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff7070',
            cancelButtonColor: '#888',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: { 
                popup: 'my-swal-popup',
                confirmButton: 'swal-button-custom',
                cancelButton: 'swal-button-custom'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('force-delete-' + id).submit();
            }
        });
    }
</script>
@endsection