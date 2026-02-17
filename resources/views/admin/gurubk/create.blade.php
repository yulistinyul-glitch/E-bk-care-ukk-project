@extends('admin.layouts.app')

@section('title', 'Tambah Guru BK')

@section('content')
<div class="container py-4 d-flex justify-content-center">
    <div class="form-box" style="width: 100%; max-width: 600px; background: white; padding: 35px; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
        <h4 class="text-center mb-4">Tambah Data Guru BK</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.gurubk.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">ID Guru BK (Otomatis)</label>
                <input type="text" id="id_guru" class="form-control" readonly placeholder="GBK + NIP">
                <small class="text-muted">ID akan terbentuk otomatis dari NIP.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="NIP" id="nip" class="form-control" placeholder="Masukkan NIP..." required oninput="generateID()">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_gurubk" class="form-control" placeholder="Masukkan nama guru..." required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="JK" class="form-select" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" placeholder="08..." required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap..." required></textarea>
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.gurubk.index') }}" class="btn btn-secondary flex-1">Batal</a>
                <button type="submit" class="btn btn-primary flex-1">Simpan Guru BK</button>
            </div>

        </form>
    </div>
</div>

<script>
function generateID() {
    const nip = document.getElementById('nip').value.trim();
    const idGuru = document.getElementById('id_guru');

    idGuru.value = nip ? "GBK" + nip : "";
}
</script>
@endsection
