<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru BK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    body { background: #F8F9FA; font-family: 'Poppins', sans-serif; }
    .center-wrapper { display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px 0; }
    .form-box { width: 100%; max-width: 550px; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    h4 { font-weight: 800; color: #2D3436; margin-bottom: 20px; font-size: 1.25rem; }
    .form-label { font-weight: 500; color: #2D3436; margin-bottom: 6px; font-size: 0.85rem; }
    .form-control, .form-select { border: 1.5px solid #DFE6E9; border-radius: 10px; padding: 8px 12px; color: #2D3436; font-size: 0.85rem; }
    .form-control[readonly] { background-color: #f1f3f5; font-weight: 600; color: #5D5FEF; }
    .form-control:focus, .form-select:focus { box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1); border-color: #5D5FEF; outline: none; }
    .is-invalid { border-color: #dc3545 !important; }

    .button-group { display: flex; gap: 10px; margin-top: 25px; }
    .btn-custom { 
        flex: 1; 
        padding: 10px 15px; 
        border-radius: 10px; 
        font-size: 0.85rem; 
        font-weight: 600; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 8px; 
        transition: 0.3s; 
        border: none;
        text-decoration: none;
    }
    .btn-custom i {
        font-size: 1rem;
        line-height: 0;
    }
    .btn-kembali { background: #B5B5B5; color: white; }
    .btn-kembali:hover { background: #999; color: white; transform: translateX(-3px); }
    .btn-simpan { background: #5D5FEF; color: white; }
    .btn-simpan:hover { background: #4a4cd9; box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3); transform: translateY(-2px); }
    .alert { font-size: 0.8rem; padding: 10px; border-radius: 10px; }
</style>
</head>

<body>
<div class="center-wrapper">
    <div class="form-box">
        <h4 class="text-center">Edit Data Guru</h4>

        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.gurubk.update', $gurubk->id_gurubk) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">ID Guru BK</label>
                <input type="text" class="form-control" value="{{ $gurubk->id_gurubk }}" readonly>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP (Maks 18 Digit)</label>
                    <input type="text" name="NIP" class="form-control @error('NIP') is-invalid @enderror"
                           placeholder="Masukkan NIP..." value="{{ old('NIP', $gurubk->NIP) }}"
                           maxlength="18" required 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="JK" class="form-select @error('JK') is-invalid @enderror" required>
                        <option value="">Pilih JK</option>
                        <option value="L" {{ old('JK', $gurubk->JK) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('JK', $gurubk->JK) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_gurubk" class="form-control @error('nama_gurubk') is-invalid @enderror"
                       placeholder="Masukkan nama lengkap guru" value="{{ old('nama_gurubk', $gurubk->nama_gurubk) }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="email@example.com" value="{{ old('email', $gurubk->email) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                           placeholder="08..." value="{{ old('no_telp', $gurubk->no_telp) }}" required
                           oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                          rows="2" placeholder="Masukkan alamat lengkap..." required>{{ old('alamat', $gurubk->alamat) }}</textarea>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.gurubk.index') }}" class="btn-custom btn-kembali">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn-custom btn-simpan">
                    <i class="bi bi-save"></i>  Update
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>