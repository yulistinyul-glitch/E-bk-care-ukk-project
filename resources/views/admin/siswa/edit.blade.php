<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    {{-- Font --}}
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
            max-width: 600px; 
            background: white; 
            padding: 35px; 
            border-radius: 25px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        }

        h4 { font-weight: 600; color: #2D3436; margin-bottom: 25px; font-size: 1.4rem; }

        .form-label { font-weight: 500; color: #2D3436; margin-bottom: 8px; font-size: 0.9rem; }

        .form-control, .form-select {
            border: 1.5px solid #DFE6E9;
            border-radius: 12px;
            padding: 10px 15px;
            color: #2D3436;
            font-size: 0.95rem;
        }

        .form-control[readonly] {
            background-color: #f1f3f5;
            font-weight: 600;
            color: #5D5FEF;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1);
            border-color: #5D5FEF;
            outline: none;
        }

        .button-group { display: flex; gap: 12px; margin-top: 30px; }

        .btn-kembali {
            background: #B5B5B5; color: white; border: none; border-radius: 12px;
            padding: 12px 20px; flex: 1; text-decoration: none;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            font-weight: 500; transition: 0.3s;
        }

        .btn-simpan {
            background: #5D5FEF; color: white; border: none; border-radius: 12px;
            padding: 12px 20px; flex: 1.5; display: flex;
            align-items: center; justify-content: center; gap: 8px;
            font-weight: 500; transition: 0.3s;
        }

        .btn-simpan:hover { background: #4a4cd9; box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3); }
        .btn-kembali:hover { background: #999; color: white; }
    </style>
</head>
<body>

<div class="form-box">
    <h4 class="text-center">Edit Data Siswa</h4>

    <form action="{{ route('admin.siswa.update', $siswa->id_siswa) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID Siswa</label>
            <input type="text" name="id_siswa" id="id_siswa" class="form-control" value="{{ $siswa->id_siswa }}" readonly required>
        </div>

        <div class="mb-3">
            <label class="form-label">ID Pengguna</label>
            <input type="text" name="id_pengguna" id="id_pengguna" class="form-control" value="{{ $siswa->id_pengguna }}" readonly required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIPD</label>
                <input type="text" name="NIPD" id="NIPD" class="form-control" value="{{ $siswa->NIPD }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">NISN</label>
                <input type="text" name="NISN" class="form-control" value="{{ $siswa->NISN }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-select" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ $siswa->id_kelas == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas == 10 ? 'X' : ($k->nama_kelas == 11 ? 'XI' : 'XII') }}
                            {{ $k->jurusan }}
                            {{ $k->nomor_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jk" class="form-select" required>
                    <option value="L" {{ $siswa->JK == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $siswa->JK == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $siswa->tanggal_lahir }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" class="form-control" value="{{ $siswa->no_telp }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2">{{ $siswa->alamat }}</textarea>
        </div>

        <div class="button-group">
            <a href="{{ route('admin.siswa.index') }}" class="btn-kembali">
                Batal
            </a>
            <button type="submit" class="btn-simpan">
                Update Data Siswa
            </button>
        </div>
    </form>
</div>

</body>
</html>
