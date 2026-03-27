<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Walikelas</title>
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
            max-width: 550px; /* Ukuran disamakan dengan form siswa */
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
            padding: 8px 12px; /* Padding lebih ramping */
            font-size: 0.85rem; /* Font isi lebih kecil */
            color: #2D3436;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1);
            border-color: #5D5FEF;
            outline: none;
        }

        .form-control[readonly] {
            background-color: #f1f3f5 !important;
            color: #5D5FEF; /* Warna ditekankan agar sama dengan form siswa */
            font-weight: 600;
            border-color: #e9ecef;
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
        .btn-kembali:hover {
            background: #999;
            color: white;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h4 class="text-center">Edit Data Walikelas</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
    <form action="{{ route('admin.walikelas.update', $walikelas->id_walikelas) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- ID Walikelas --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">ID Walikelas</label>
                <input type="text" 
                       name="id_walikelas" 
                       id="id_walikelas" 
                       class="form-control"
                       value="{{ $walikelas->id_walikelas }}"
                       readonly required>
            </div>

            {{-- KELAS --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-select" required onchange="syncID()">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}"
                            {{ old('id_kelas', $walikelas->id_kelas) == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas == 10 ? 'X' : ($k->nama_kelas == 11 ? 'XI' : 'XII') }}
                            {{ $k->jurusan }}
                            {{ $k->nomor_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIP</label>
                <input type="text" 
                       name="NIP" 
                       class="form-control @error('NIP') is-invalid @enderror"
                       value="{{ old('NIP', $walikelas->NIP) }}" 
                       required>
                @error('NIP')
                    <div class="invalid-feedback" style="font-size: 0.75rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="JK" class="form-select" required>
                    <option value="">Pilih JK</option>
                    <option value="L" {{ old('JK', $walikelas->JK) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('JK', $walikelas->JK) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap Guru</label>
            <input type="text" 
                   name="nama_guru" 
                   class="form-control"
                   value="{{ old('nama_guru', $walikelas->nama_guru) }}" 
                   required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" 
                       name="no_telp" 
                       class="form-control"
                       value="{{ old('no_telp', $walikelas->no_telp) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" 
                       name="email" 
                       class="form-control"
                       value="{{ old('email', $walikelas->email) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2" style="font-size: 0.85rem;">{{ old('alamat', $walikelas->alamat) }}</textarea>
        </div>

        <div class="button-group">
            <a href="{{ route('admin.walikelas.index') }}" class="btn-kembali">Batal</a>
            <button type="submit" class="btn-simpan">Update Data Walikelas</button>
        </div>
    </form>
</div>

<script>
function syncID() {
    const selectKelas = document.getElementById('id_kelas');
    const inputWali = document.getElementById('id_walikelas');

    let val = selectKelas.value;

    if (val !== "") {
        let angka = val.replace(/[^0-9]/g, '');
        inputWali.value = "GR" + angka;
    }
}
</script>

</body>
</html>