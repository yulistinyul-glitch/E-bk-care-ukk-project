<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Input Siswa</title>
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
        max-width: 550px; /* Diperkecil sedikit lebarnya */
        background: white; 
        padding: 30px; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
    }

    h4 { 
        font-weight: 600; 
        color: #2D3436; 
        margin-bottom: 20px; 
        font-size: 1.25rem; /* Ukuran judul diperkecil */
    }

    .form-label { 
        font-weight: 500; 
        color: #2D3436; 
        margin-bottom: 6px; 
        font-size: 0.85rem; /* Label lebih kecil */
    }

    .form-control, .form-select {
        border: 1.5px solid #DFE6E9;
        border-radius: 10px;
        padding: 8px 12px; /* Padding input diperkecil */
        color: #2D3436;
        font-size: 0.85rem; /* Text input lebih kecil */
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
        font-size: 0.85rem; /* Text tombol lebih kecil */
        transition: 0.3s;
    }

    .btn-simpan {
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
        font-size: 0.85rem; /* Text tombol lebih kecil */
        transition: 0.3s;
    }

    .btn-simpan:hover { 
        background: #4a4cd9; 
        box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3); 
    }

    .btn-kembali:hover { 
        background: #999; 
        color: white; 
    }

    /* Penyesuaian Alert */
    .alert {
        font-size: 0.8rem;
        padding: 10px;
        border-radius: 10px;
    }
</style>

<div class="center-wrapper">
    <div class="form-box">
        <h4 class="text-center">Input Data Siswa</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.siswa.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">ID Siswa (Otomatis)</label>
                    <input type="text" name="id_siswa" id="id_siswa" class="form-control" value="{{ $nextSiswaID }}" readonly required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">ID Pengguna (Otomatis)</label>
                    <input type="text" name="id_pengguna" id="id_pengguna" class="form-control" value="{{ $nextPenggunaID }}" readonly required>
                </div>
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
                <textarea name="alamat" class="form-control" rows="2" placeholder="Tulis alamat rumah..." style="font-size: 0.85rem;"></textarea>
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
</div>

<script>
    // Fungsi tetap sama, hanya memastikan ID sesuai
    function generateID() {
        const nipd = document.getElementById('NIPD').value;
        const idSiswa = document.getElementById('id_siswa');
        
        if (nipd.length > 0) {
            idSiswa.value = "SIS" + nipd.trim();
        }
    }
</script>
</head>
</html>