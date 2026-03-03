<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Guru BK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body { background: #F8F9FA; font-family: 'Poppins', sans-serif; }
    .center-wrapper { display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px 0; }
    .form-box { width: 100%; max-width: 550px; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    h4 { font-weight: 600; color: #2D3436; margin-bottom: 20px; font-size: 1.25rem; }
    .form-label { font-weight: 500; color: #2D3436; margin-bottom: 6px; font-size: 0.85rem; }
    .form-control, .form-select { border: 1.5px solid #DFE6E9; border-radius: 10px; padding: 8px 12px; color: #2D3436; font-size: 0.85rem; }
    .form-control[readonly] { background-color: #f1f3f5; font-weight: 600; color: #5D5FEF; }
    .form-control:focus, .form-select:focus { box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1); border-color: #5D5FEF; outline: none; }
    .is-invalid { border-color: #dc3545 !important; }
    .button-group { display: flex; gap: 10px; margin-top: 25px; }
    .btn-kembali { background: #B5B5B5; color: white; border: none; border-radius: 10px; padding: 10px 15px; flex: 1; text-decoration: none; display: flex; align-items: center; justify-content: center; font-weight: 500; font-size: 0.85rem; transition: 0.3s; }
    .btn-simpan { background: #5D5FEF; color: white; border: none; border-radius: 10px; padding: 10px 15px; flex: 1.5; display: flex; align-items: center; justify-content: center; font-weight: 500; font-size: 0.85rem; transition: 0.3s; }
    .btn-simpan:hover { background: #4a4cd9; box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3); }
    .alert { font-size: 0.8rem; padding: 10px; border-radius: 10px; }
</style>
</head>

<body>
<div class="center-wrapper">
    <div class="form-box">
        <h4 class="text-center">Input Data Guru BK</h4>

        {{-- Menampilkan Pesan Error Validasi --}}
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
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
                {{-- Menggunakan variabel $nextID dari Controller --}}
                <input type="text" name="id_gurubk" class="form-control" value="{{ $nextID }}" readonly>
                <small class="text-muted" style="font-size: 0.75rem;">Sistem memberikan ID urutan otomatis.</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP (Maks 18 Digit)</label>
                    <input type="text" name="NIP" id="nip" class="form-control @error('NIP') is-invalid @enderror"
                           placeholder="Masukkan NIP..." value="{{ old('NIP') }}"
                           maxlength="18" required 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="JK" class="form-select @error('JK') is-invalid @enderror" required>
                        <option value="">Pilih JK</option>
                        <option value="L" {{ old('JK') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('JK') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_gurubk" class="form-control @error('nama_gurubk') is-invalid @enderror"
                       placeholder="Masukkan nama lengkap guru" value="{{ old('nama_gurubk') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="email@example.com" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                           placeholder="08..." value="{{ old('no_telp') }}" required
                           oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                          rows="2" placeholder="Masukkan alamat lengkap..." required>{{ old('alamat') }}</textarea>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.gurubk.index') }}" class="btn-kembali">Batal</a>
                <button type="submit" class="btn-simpan">Simpan Guru BK</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>