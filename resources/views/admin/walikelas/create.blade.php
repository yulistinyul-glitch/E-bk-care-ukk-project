<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Walikelas</title>

    {{-- Google Font: Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { 
            background: #F8F9FA; 
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 20px 0;
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
            font-size: 0.85rem;
            color: #2D3436;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1);
            border-color: #5D5FEF;
            outline: none;
        }

        .form-control[readonly] {
            background-color: #f1f3f5 !important;
            color: #5D5FEF;
            font-weight: 600;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-kembali {
            background: #B5B5B5;
            color: white;
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

        .btn-simpan {
            background: #5D5FEF;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 15px;
            flex: 1.5;
            font-weight: 500;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .btn-simpan:hover { 
            background: #4a4cd9; 
            box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3); 
        }

        .alert { font-size: 0.8rem; border-radius: 10px; }
    </style>
</head>

<body>

<div class="form-box">
    <h4 class="text-center">Input Data Walikelas</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{ route('admin.walikelas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">ID Walikelas (Otomatis Melanjutkan)</label>
            {{-- Menggunakan variabel dari controller seperti $nextWaliID --}}
            <input type="text" name="id_walikelas" class="form-control" value="{{ $nextWaliID }}" readonly required>
            <small class="text-muted" style="font-size: 0.75rem;">ID diatur sistem agar urut dengan data import.</small>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="NIP" class="form-control" placeholder="Masukkan NIP..." required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="JK" class="form-select" required>
                    <option value="">Pilih JK</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap Guru</label>
            <input type="text" name="nama_walikelas" class="form-control" placeholder="Nama beserta gelar..." required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-select" required>
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id_kelas }}">
                            {{ $k->nama_kelas == 10 ? 'X' : ($k->nama_kelas == 11 ? 'XI' : 'XII') }}
                            {{ $k->jurusan }}
                            {{ $k->nomor_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" placeholder="08...">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap..."></textarea>
        </div>

        <div class="button-group">
            <a href="{{ route('admin.walikelas.index') }}" class="btn-kembali">Batal</a>
            <button type="submit" class="btn-simpan">Simpan Data</button>
        </div>
    </form>
</div>

</body>
</html>