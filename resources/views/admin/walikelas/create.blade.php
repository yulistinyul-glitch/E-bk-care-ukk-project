<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Walikelas</title>
    
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

        .error-msg {
            color: #d63031;
            font-size: 0.75rem;
            margin-top: 4px;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h4 class="text-center">Input Data Walikelas</h4>
    
    <form action="{{ route('admin.walikelas.store') }}" method="POST">
        @csrf

        {{-- ID Walikelas --}}
        <div class="mb-3">
            <label class="form-label">ID Walikelas (Otomatis)</label>
            <input type="text" name="id_walikelas" class="form-control" value="{{ $nextWaliID }}" readonly>
            <small class="text-muted" style="font-size: 0.7rem;">ID diatur sistem agar tetap berurutan.</small>
        </div>

        <div class="row">
            {{-- NIP --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">NIP (18 Digit)</label>
                <input type="text" 
                       name="NIP" 
                       id="nip_input"
                       class="form-control @error('NIP') is-invalid @enderror" 
                       placeholder="Masukkan NIP..." 
                       value="{{ old('NIP') }}" 
                       maxlength="18"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                <div class="d-flex justify-content-between">
                    <small id="nip_counter" class="text-muted" style="font-size: 0.7rem;">0/18 digit</small>
                    @error('NIP') <div class="error-msg text-end">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="JK" class="form-select @error('JK') is-invalid @enderror">
                    <option value="">Pilih JK</option>
                    <option value="L" {{ old('JK') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('JK') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('JK') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Nama Guru --}}
        <div class="mb-3">
            <label class="form-label">Nama Lengkap Guru</label>
            <input type="text" name="nama_guru" class="form-control @error('nama_guru') is-invalid @enderror" 
                   placeholder="Nama beserta gelar..." value="{{ old('nama_guru') }}">
            @error('nama_guru') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            {{-- Kelas --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas == 10 ? 'X' : ($k->nama_kelas == 11 ? 'XI' : 'XII') }}
                            {{ $k->jurusan }}
                            {{ $k->nomor_ruang }}
                        </option>
                    @endforeach
                </select>
                @error('id_kelas') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- No Telepon --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" 
                       placeholder="08..." value="{{ old('no_telp') }}"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('no_telp') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                      rows="2" placeholder="Alamat lengkap...">{{ old('alamat') }}</textarea>
            @error('alamat') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <div class="button-group">
            <a href="{{ route('admin.walikelas.index') }}" class="btn-kembali">Batal</a>
            <button type="submit" class="btn-simpan">Simpan Data</button>
        </div>
    </form>
</div>

<script>
    // Logic untuk counter digit NIP
    const nipInput = document.getElementById('nip_input');
    const nipCounter = document.getElementById('nip_counter');

    function updateCounter() {
        const length = nipInput.value.length;
        nipCounter.innerText = `${length}/18 digit`;
        if(length === 18) {
            nipCounter.style.color = '#5D5FEF';
            nipCounter.style.fontWeight = 'bold';
        } else {
            nipCounter.style.color = '#6c757d';
            nipCounter.style.fontWeight = 'normal';
        }
    }

    nipInput.addEventListener('input', updateCounter);
    window.addEventListener('load', updateCounter); // Update saat halaman load (jika ada old value)
</script>

</body>
</html>