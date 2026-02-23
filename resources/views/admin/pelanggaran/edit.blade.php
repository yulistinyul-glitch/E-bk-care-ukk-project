<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body { 
        background: #F8F9FA; 
        font-family: 'Poppins', sans-serif;
    }

    .center-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px 0;
    }

    .form-box { 
        width: 100%;
        max-width: 550px; 
        background: white; 
        padding: 30px; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
    }

    h4 { 
        font-weight: 600; 
        color: #2D3436; 
        margin-bottom: 20px; 
        font-size: 1.25rem; 
    }

    .form-label { 
        font-weight: 500; 
        color: #2D3436; 
        margin-bottom: 6px; 
        font-size: 0.85rem; 
    }

    .form-control, .form-select {
        border: 1.5px solid #DFE6E9;
        border-radius: 10px;
        padding: 8px 12px; 
        color: #2D3436;
        font-size: 0.85rem; 
    }

    .form-control[readonly] {
        background-color: #f1f3f5;
        font-weight: 600;
        color: #5D5FEF;
        font-size: 0.85rem;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1);
        border-color: #5D5FEF;
        outline: none;
    }

    .button-group { 
        display: flex; 
        gap: 10px; 
        margin-top: 25px; 
    }

    .btn-kembali {
        background: #B5B5B5; 
        color: white; 
        border: none; 
        border-radius: 10px;
        padding: 10px 15px; 
        flex: 1; 
        text-decoration: none;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-weight: 500; 
        font-size: 0.85rem; 
        transition: 0.3s;
    }

    .btn-update {
        background: #5D5FEF; 
        color: white; 
        border: none; 
        border-radius: 10px;
        padding: 10px 15px; 
        flex: 1.5; 
        display: flex;
        align-items: center; 
        justify-content: center;
        font-weight: 500; 
        font-size: 0.85rem; 
        transition: 0.3s;
    }

    .btn-update:hover { 
        background: #4a4cd9; 
        box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3); 
    }

    .btn-kembali:hover { 
        background: #999; 
        color: white; 
    }

    .alert {
        font-size: 0.8rem;
        padding: 10px;
        border-radius: 10px;
    }
</style>
</head>

<body>
<div class="center-wrapper">
    <div class="form-box">
        <h4 class="text-center">Edit Data Pelanggaran</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.pelanggaran.update', $pelanggaran->id_pelanggaran) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">ID Pelanggaran</label>
                <input type="text" class="form-control" value="{{ $pelanggaran->id_pelanggaran }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori Pelanggaran</label>
                <select name="kategori_pelanggaran" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriOptions as $kategori)
                        <option value="{{ $kategori }}" {{ (old('kategori_pelanggaran', $pelanggaran->kategori_pelanggaran) == $kategori) ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kegiatan / Pelanggaran</label>
                <input type="text" name="jenis_kegiatan" class="form-control" value="{{ old('jenis_kegiatan', $pelanggaran->jenis_kegiatan) }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tingkatan</label>
                    <select name="tingkatan" class="form-select" required>
                        <option value="">Pilih Tingkatan</option>
                        <option value="ringan" {{ old('tingkatan', $pelanggaran->tingkatan) == 'ringan' ? 'selected' : '' }}>Ringan</option>
                        <option value="sedang" {{ old('tingkatan', $pelanggaran->tingkatan) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="berat" {{ old('tingkatan', $pelanggaran->tingkatan) == 'berat' ? 'selected' : '' }}>Berat</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Poin Pelanggaran</label>
                    <input type="number" name="poin_pelanggaran" class="form-control" value="{{ old('poin_pelanggaran', $pelanggaran->poin_pelanggaran) }}" required>
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.pelanggaran.index') }}" class="btn-kembali">
                    Batal
                </a>

                <button type="submit" class="btn-update">
                    Update Pelanggaran
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>