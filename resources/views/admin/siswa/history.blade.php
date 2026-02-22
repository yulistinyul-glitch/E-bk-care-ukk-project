@extends('admin.layouts.app')

@section('title', 'History Siswa')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-3 fw-bold">History Siswa</h1>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-primary">
            <i class="bx bx-left-arrow-alt"></i> Kembali ke Data Siswa
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Preview</th>
                            <th>Dihapus Pada</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $index => $gallery)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img src="{{ asset('storage/' . $gallery->image) }}" width="120" class="rounded"></td>
                                <td>{{ $gallery->deleted_at->format('d M Y H:i') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Restore -->
                                        <form action="{{ route('admin.gallery.restore', $gallery->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success btn-sm">
                                                <i class="bx bx-undo"></i> Restore
                                            </button>
                                        </form>

                                        <!-- Force Delete -->
                                    <form action="{{ route('admin.gallery.forceDelete', $gallery->id) }}" method="POST" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="openDeleteModal(this)">
                                            <i class="bx bx-trash"></i> Permanen
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data di history</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Popup Berhasil Restore -->
@if(session('success'))
<div id="successPopup" class="custom-success-popup">
    <div class="popup-content p-4 rounded text-center">
        <p class="fw-bold text-success mb-2">Berhasil!</p>
        <p class="mb-0">{{ session('success') }}</p>
    </div>
</div>
@endif

<!-- Custom Delete Modal -->
<div id="deletePopup" class="custom-delete-popup">
    <div class="delete-popup-content p-4 rounded text-center">
        <h5 class="fw-bold mb-2">Konfirmasi Hapus</h5>
        <p>Apakah Anda yakin ingin menghapus data ini?<br>Data yang dihapus <b>tidak dapat dikembalikan!</b></p>
        <div class="delete-buttons mt-3 d-flex justify-content-center gap-2">
            <button type="button" class="btn btn-secondary" id="cancelDelete">Batal</button>
            <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
        </div>
    </div>
</div>

<style>
/* Berhasil Restore */
.custom-success-popup {
    display: none;
    position: absolute; 
    inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 20; 
    justify-content: center;
    align-items: center;
}

.popup-content {
    background: #fff;
    padding: 20px 30px;
    border-radius: 12px;
    min-width: 250px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    animation: popupIn 0.3s ease;
}

/* Delete Modal */
.custom-delete-popup {
    display: none;
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    z-index: 30;
    justify-content: center;
    align-items: center;
}

.delete-popup-content {
    background: #fff;
    padding: 20px 30px;
    border-radius: 12px;
    min-width: 300px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    text-align: center;
    animation: popupIn 0.3s ease;
}

.delete-buttons .btn {
    padding: 6px 16px;
}

/* Animasi */
@keyframes popupIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>

<script>
window.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('successPopup');
    if(popup){
        popup.style.display = 'flex';
        setTimeout(() => { popup.style.display = 'none'; }, 2500);
    }
});

let formToDelete = null;

// Buka modal saat klik tombol hapus
function openDeleteModal(button){
    formToDelete = button.closest('form');
    document.getElementById('deletePopup').style.display = 'flex';
}

// Konfirmasi hapus
document.getElementById('confirmDelete').addEventListener('click', function(){
    if(formToDelete){
        formToDelete.submit();
    }
});

// Batal hapus
document.getElementById('cancelDelete').addEventListener('click', function(){
    document.getElementById('deletePopup').style.display = 'none';
});

// Klik di luar modal
window.addEventListener('click', function(e){
    const deletePopup = document.getElementById('deletePopup');
    if(e.target === deletePopup){
        deletePopup.style.display = 'none';
    }
});
</script>

