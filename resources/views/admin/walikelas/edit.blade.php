<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Walikelas</title>

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
            max-width: 650px; 
            background: white; 
            padding: 35px; 
            border-radius: 25px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        }

        h4 { font-weight: 600; color: #2D3436; margin-bottom: 25px; }

        .form-label {
            font-weight: 500;
            color: #2D3436;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 1.5px solid #DFE6E9;
            border-radius: 12px;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1);
            border-color: #5D5FEF;
            outline: none;
        }

        .form-control[readonly] {
            background-color: #f1f3f5 !important;
            color: #495057;
            font-weight: 600;
            border-color: #e9ecef;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn-kembali {
            background: #B5B5B5;
            color: white;
            border-radius: 12px;
            padding: 12px 20px;
            flex: 1;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        .btn-simpan {
            background: #5D5FEF;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            flex: 1.5;
            font-weight: 500;
        }

        .btn-simpan:hover { 
            background: #4a4cd9; 
            box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3); 
        }
    </style>
</head>

<body>

<div class="form-box">
    <h4 class="text-center">Edit Data Walikelas</h4>
    
    <form action="{{ route('admin.walikelas.update', $walikelas->id_walikelas) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

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
        </div>

        <hr class="my-3 text-muted">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIP</label>
                <input type="text" 
                       name="NIP" 
                       class="form-control @error('NIP') is-invalid @enderror"
                       value="{{ old('NIP', $walikelas->NIP) }}" 
                       required>
                @error('NIP')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Guru</label>
                <input type="text" 
                       name="nama_guru" 
                       class="form-control"
                       value="{{ old('nama_guru', $walikelas->nama_guru) }}" 
                       required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="JK" class="form-select" required>
                    <option value="">Pilih JK</option>
                    <option value="L" {{ old('JK', $walikelas->JK) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('JK', $walikelas->JK) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" 
                       name="no_telp" 
                       class="form-control"
                       value="{{ old('no_telp', $walikelas->no_telp) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" 
                   name="email" 
                   class="form-control"
                   value="{{ old('email', $walikelas->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $walikelas->alamat) }}</textarea>
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
