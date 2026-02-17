<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru BK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="form-box">
    <h4>Edit Data Guru BK</h4>
    <form action="{{ route('admin.gurubk.update', $gurubk->id_guru) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID Guru BK</label>
            <input type="text" id="id_guru" class="form-control" readonly value="{{ $gurubk->id_guru }}">
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" id="nip" name="NIP" class="form-control" value="{{ $gurubk->NIP }}" required oninput="generateID()">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_gurubk" class="form-control" value="{{ $gurubk->nama_gurubk }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="JK" class="form-select" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L" {{ $gurubk->JK == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $gurubk->JK == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" class="form-control" value="{{ $gurubk->no_telp }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $gurubk->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2">{{ $gurubk->alamat }}</textarea>
        </div>

        <div class="button-group">
            <a href="{{ route('admin.gurubk.index') }}" class="btn-kembali">Batal</a>
            <button type="submit" class="btn-simpan">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
function generateID() {
    const nip = document.getElementById('nip').value.trim();
    const idGuru = document.getElementById('id_guru');
    idGuru.value = nip ? "GBK" + nip : "";
}
</script>

</body>
</html>
