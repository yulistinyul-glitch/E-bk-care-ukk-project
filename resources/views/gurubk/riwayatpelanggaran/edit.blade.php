<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggaran</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">

    <style>
        body { 
            background: #F5F5F5; 
            font-family: 'Poppins', sans-serif;
            display: flex; align-items: center; justify-content: center;
            min-height: 100vh; margin: 0;
        }
        .form-box { 
            width: 100%; max-width: 500px; 
            background: white; padding: 40px; 
            border-radius: 30px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); 
        }
        .form-label { font-weight: 500; color: #333; margin-bottom: 8px; }
        .form-control, .form-select {
            border: 1px solid #D1D1D1; border-radius: 10px;
            padding: 12px 15px; background-color: #fff;
        }
        .datepicker { background-color: #fff !important; cursor: pointer; }
        .button-group { display: flex; gap: 15px; margin-top: 30px; }
        .btn-kembali {
            background: #B5B5B5; color: white; border: none;
            border-radius: 10px; padding: 12px 20px; flex: 1;
            text-decoration: none; text-align: center;
        }
        .btn-simpan {
            background: #32C142; color: white; border: none;
            border-radius: 10px; padding: 12px 20px; flex: 1.5;
            font-weight: 500;
        }
        .current-file { font-size: 12px; color: #666; margin-top: 5px; }
    </style>
</head>
<body>

<div class="form-box">
    <h4 class="text-center fw-bold mb-4">Edit Pelanggaran</h4>
    <form action="{{ route('pelanggaran.update', $pelanggaran->id_riwayat) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="mb-3">
            <label class="form-label">Nama Siswa</label>
            <select name="id_siswa" class="form-select" required>
                @foreach($siswa as $s)
                    <option value="{{ $s->id_siswa }}" {{ $s->id_siswa == $pelanggaran->id_siswa ? 'selected' : '' }}>
                        {{ $s->nama_siswa }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Kejadian</label>
            <input type="text" name="tanggal_kejadian" id="pilih_tanggal" 
                   class="form-control datepicker" 
                   value="{{ $pelanggaran->tanggal_kejadian }}" 
                   placeholder="Pilih Tanggal.." readonly required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2" placeholder="Tulis detail...">{{ $pelanggaran->keterangan }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">Ganti Bukti Foto</label>
            <input type="file" name="bukti_foto" class="form-control">
            @if($pelanggaran->bukti_foto)
                <div class="current-file">
                    File saat ini: <a href="{{ asset('storage/'.$pelanggaran->bukti_foto) }}" target="_blank">Lihat Foto</a>
                </div>
            @endif
        </div>

        <div class="button-group">
            <a href="{{ route('pelanggaran.index') }}" class="btn-kembali">← Kembali</a>
            <button type="submit" class="btn-simpan">💾 Update Data</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    flatpickr("#pilih_tanggal", {
        locale: "id",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        defaultDate: "{{ $pelanggaran->tanggal_kejadian }}",
        allowInput: true,
        disableMobile: "true"
    });
</script>
</body>
</html>