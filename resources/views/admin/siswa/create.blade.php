<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
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
    <h4 class="text-center">Tambah Data Siswa</h4>
    
    <form action="{{ route('admin.siswa.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">ID Siswa (Otomatis)</label>
        <input type="text" name="id_siswa" id="id_siswa" class="form-control" value="{{ $nextSiswaID }}" readonly required>
    </div>

    <div class="mb-3">
        <label class="form-label">ID Pengguna (Otomatis)</label>
        <input type="text" name="id_pengguna" id="id_pengguna" class="form-control" value="{{ $nextPenggunaID }}" readonly required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">NIPD</label>
            <input type="text" name="NIPD" id="NIPD" class="form-control" placeholder="Contoh: 232410...">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">NISN</label>
            <input type="text" name="NISN" class="form-control" placeholder="10 digit nomor">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama_siswa" class="form-control" placeholder="Masukkan nama siswa" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" id="id_kelas" class="form-select" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">
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
                <option value="">Pilih JK</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota lahir">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="no_telp" class="form-control" placeholder="08...">
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat Lengkap</label>
        <textarea name="alamat" class="form-control" rows="2" placeholder="Tulis alamat rumah..."></textarea>
    </div>

    <div class="button-group">
        <a href="{{ route('admin.siswa.index') }}" class="btn-kembali">
            Batal
        </a>

        <button type="submit" class="btn-simpan">
            Simpan Data Siswa
        </button>
    </div>
</form>

</div>

<script>
    function generateID() {
        const nipd = document.getElementById('NIPD').value;
        const idSiswa = document.getElementById('id_siswa');
        
        if (nipd.length > 0) {
            idSiswa.value = "SIS" + nipd.trim();
        } else {
            idSiswa.value = "";
        }
    }
</script>

</body>
</html>