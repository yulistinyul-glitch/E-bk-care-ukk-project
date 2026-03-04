<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Pelanggaran Siswa</title>
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
        padding: 40px 0;
    }

    .form-box { 
        width: 100%;
        max-width: 600px; 
        background: white; 
        padding: 35px; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
    }

    h4 { 
        font-weight: 600; 
        color: #2D3436; 
        margin-bottom: 25px; 
        font-size: 1.3rem; 
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
        padding: 10px 12px; 
        color: #2D3436;
        font-size: 0.85rem; 
        transition: 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #27ae60;
        box-shadow: none;
    }

    .form-control[readonly] {
        background-color: #f1f3f5;
        font-weight: 600;
        color: #5D5FEF;
    }

    .text-danger-custom {
        color: #d63031 !important;
        font-weight: 700;
    }

    .button-group { 
        display: flex; 
        gap: 12px; 
        margin-top: 30px; 
    }

    .btn-kembali {
        background: #B5B5B5; 
        color: white; 
        border: none; 
        border-radius: 10px;
        padding: 12px; 
        flex: 1; 
        text-decoration: none;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-weight: 500; 
        font-size: 0.9rem; 
        transition: 0.3s;
    }

    .btn-simpan {
        background: #27ae60; 
        color: white; 
        border: none; 
        border-radius: 10px;
        padding: 12px; 
        flex: 1.5; 
        display: flex;
        align-items: center; 
        justify-content: center;
        font-weight: 500; 
        font-size: 0.9rem; 
        transition: 0.3s;
    }

    .btn-simpan:hover { 
        background: #219150; 
        box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3); 
    }

    .btn-simpan:disabled {
        background: #a5d6a7;
        cursor: not-allowed;
    }

    .btn-kembali:hover { 
        background: #999; 
        color: white; 
    }

    hr {
        border-top: 1.5px solid #DFE6E9;
        opacity: 1;
        margin: 30px 0;
    }

    .file-hint {
        font-size: 0.75rem;
        color: #636e72;
        margin-top: 4px;
    }
</style>
</head>

<body>
<div class="center-wrapper">
    <div class="form-box">
        <h4 class="text-center">Catat Pelanggaran Siswa</h4>

        {{-- Form Filter (Hanya untuk ambil data dropdown) --}}
        <form action="{{ route('gurubk.riwayatpelanggaran.create') }}" method="GET">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pilih Kelas</label>
                    <select name="id_kelas" class="form-select" onchange="this.form.submit()">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <select name="id_siswa" class="form-select" onchange="this.form.submit()">
                        <option value="">Pilih Siswa</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id_siswa }}" {{ request('id_siswa') == $s->id_siswa ? 'selected' : '' }}>
                                {{ $s->nama_siswa }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori Pelanggaran</label>
                <select name="kategori_pilih" class="form-select" onchange="this.form.submit()">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->kategori_pelanggaran }}" {{ request('kategori_pilih') == $kat->kategori_pelanggaran ? 'selected' : '' }}>
                            {{ $kat->kategori_pelanggaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kegiatan</label>
                <select name="id_pelanggaran" class="form-select" onchange="this.form.submit()">
                    <option value="">Pilih Jenis Pelanggaran</option>
                    @foreach($jenis_pelanggaran as $j)
                        <option value="{{ $j->id_pelanggaran }}" {{ request('id_pelanggaran') == $j->id_pelanggaran ? 'selected' : '' }}>
                            {{ $j->jenis_kegiatan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <hr>

        {{-- Form Simpan (Utama) --}}
        <form action="{{ route('gurubk.riwayatpelanggaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Input Hidden untuk melempar data filter ke Store --}}
            <input type="hidden" name="id_siswa" value="{{ request('id_siswa') }}">
            <input type="hidden" name="id_pelanggaran" value="{{ request('id_pelanggaran') }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tingkatan</label>
                    <input type="text" class="form-control" readonly value="{{ $detail ? strtoupper($detail->tingkatan) : '-' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Poin</label>
                    <input type="text" class="form-control text-danger-custom" readonly value="{{ $detail ? $detail->poin_pelanggaran : '0' }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Kejadian</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Bukti</label>
                    <select name="bukti" class="form-select" required>
                        <option value="foto">Foto</option>
                        <option value="video">Video</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload File Bukti</label>
                <input type="file" name="file_bukti" class="form-control" accept="image/*,video/*" required>
                <div class="file-hint">Format: JPG, PNG, atau MP4 (Maks. 10MB)</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan (Opsional)</label>
                <textarea name="keterangan" class="form-control" rows="2" placeholder="Tulis rincian kejadian jika perlu..."></textarea>
            </div>

            <div class="button-group">
                <a href="{{ route('gurubk.riwayatpelanggaran.index') }}" class="btn-kembali">Batal</a>
                <button type="submit" class="btn-simpan" {{ !request('id_siswa') || !request('id_pelanggaran') ? 'disabled' : '' }}>
                    Simpan Pelanggaran
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>