<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggaran Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #F8F9FA; font-family: 'Poppins', sans-serif; }
        .center-wrapper { display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px 0; }
        .form-box { width: 100%; max-width: 550px; background: white; padding: 25px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        
        /* Mengecilkan ukuran Header */
        h4 { font-weight: 600; color: #2D3436; margin-bottom: 20px; font-size: 1.1rem; }
        
        /* Mengecilkan ukuran Label */
        .form-label { font-weight: 500; color: #2D3436; margin-bottom: 4px; font-size: 0.75rem; }
        
        /* Mengecilkan ukuran Input & Select */
        .form-control, .form-select { 
            border: 1.5px solid #DFE6E9; 
            border-radius: 8px; 
            padding: 8px 10px; 
            font-size: 0.8rem; 
            height: auto;
        }
        
        .form-control:focus, .form-select:focus { border-color: #27ae60; box-shadow: none; }
        .form-control[readonly] { background-color: #f8f9fa; font-weight: 600; color: #5D5FEF; font-size: 0.75rem; }
        
        .text-danger-custom { color: #d63031 !important; font-weight: 700; }
        
        /* Tombol lebih kecil */
        .button-group { display: flex; gap: 10px; margin-top: 25px; }
        .btn-kembali { 
            background: #B5B5B5; color: white; border-radius: 8px; padding: 10px; flex: 1; 
            text-decoration: none; display: flex; align-items: center; justify-content: center; 
            font-size: 0.8rem; font-weight: 500; 
        }
        .btn-simpan { 
            background: #27ae60; color: white; border: none; border-radius: 8px; padding: 10px; 
            flex: 1.5; font-weight: 500; font-size: 0.8rem; 
        }
        .btn-simpan:hover { background: #219150; }

        /* Preview area */
        .preview-container { margin-top: 8px; padding: 8px; background: #f8f9fa; border-radius: 8px; border: 1px dashed #DFE6E9; }
        .img-preview { width: 80px; height: 50px; object-fit: cover; border-radius: 4px; }
        .file-hint { font-size: 0.7rem; color: #636e72; }
        hr { margin: 20px 0; opacity: 0.1; }
    </style>
</head>

<body>
<div class="center-wrapper">
    <div class="form-box">
        <h4 class="text-center">Edit Riwayat Pelanggaran</h4>

        @if ($errors->any())
            <div class="alert alert-danger py-2" style="border-radius: 8px; font-size: 0.75rem;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Filter --}}
        <form action="{{ route('gurubk.riwayatpelanggaran.edit', $riwayat->id_riwayat) }}" method="GET">
            <div class="row">
                <div class="col-6 mb-2">
                    <label class="form-label">Pilih Kelas</label>
                    <select name="id_kelas" class="form-select" onchange="this.form.submit()">
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" {{ (request('id_kelas') ?? $riwayat->siswa->id_kelas) == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label class="form-label">Nama Siswa</label>
                    <select name="id_siswa" class="form-select" onchange="this.form.submit()">
                        @foreach($siswa_in_kelas as $s)
                            <option value="{{ $s->id_siswa }}" {{ (request('id_siswa') ?? $riwayat->id_siswa) == $s->id_siswa ? 'selected' : '' }}>
                                {{ $s->nama_siswa }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label">Kategori</label>
                <select name="kategori_pilih" class="form-select" onchange="this.form.submit()">
                    @foreach($kategori_list as $kat)
                        <option value="{{ $kat->kategori_pelanggaran }}" {{ (request('kategori_pilih') ?? $riwayat->pelanggaran->kategori_pelanggaran) == $kat->kategori_pelanggaran ? 'selected' : '' }}>
                            {{ $kat->kategori_pelanggaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label">Jenis Kegiatan</label>
                <select name="id_pelanggaran" class="form-select" onchange="this.form.submit()">
                    @foreach($pelanggaran_in_kategori as $j)
                        <option value="{{ $j->id_pelanggaran }}" {{ (request('id_pelanggaran') ?? $riwayat->id_pelanggaran) == $j->id_pelanggaran ? 'selected' : '' }}>
                            {{ $j->jenis_kegiatan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <hr>

        {{-- Form Update --}}
        <form action="{{ route('gurubk.riwayatpelanggaran.update', $riwayat->id_riwayat) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id_siswa" value="{{ request('id_siswa') ?? $riwayat->id_siswa }}">
            <input type="hidden" name="id_pelanggaran" value="{{ request('id_pelanggaran') ?? $riwayat->id_pelanggaran }}">

            <div class="row">
                <div class="col-6 mb-2">
                    <label class="form-label">Status</label>
                    @php $current_p = $pelanggaran_in_kategori->where('id_pelanggaran', request('id_pelanggaran') ?? $riwayat->id_pelanggaran)->first(); @endphp
                    <input type="text" class="form-control" readonly value="{{ $current_p ? strtoupper($current_p->tingkatan ?? 'RINGAN') : 'RINGAN' }}">
                </div>
                <div class="col-6 mb-2">
                    <label class="form-label">Poin</label>
                    <input type="text" class="form-control text-danger-custom" readonly value="{{ $current_p ? $current_p->poin_pelanggaran : '0' }}">
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label">Tanggal Kejadian</label>
                <input type="date" name="tanggal" class="form-control" 
                       value="{{ old('tanggal', date('Y-m-d', strtotime($riwayat->tanggal_kejadian))) }}" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Bukti (Opsional)</label>
                <input type="file" name="file_bukti" class="form-control" accept="image/*,video/*">
                
                @if($riwayat->file && $riwayat->file != '-')
                <div class="preview-container d-flex align-items-center gap-2">
                    @php $ext = pathinfo($riwayat->file, PATHINFO_EXTENSION); @endphp
                    @if(in_array(strtolower($ext), ['jpg','jpeg','png','webp']))
                        <img src="{{ asset('uploads/pelanggaran/'.$riwayat->file) }}" class="img-preview">
                    @else
                        <div class="bg-light p-1 rounded border small" style="font-size: 0.65rem;">Video File</div>
                    @endif
                    <div class="file-hint">
                        <a href="{{ asset('uploads/pelanggaran/'.$riwayat->file) }}" target="_blank" class="text-decoration-none">Lihat Dokumen</a>
                    </div>
                </div>
                @endif
            </div>

            <div class="mb-2">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2" placeholder="Detail kejadian...">{{ old('keterangan', $riwayat->keterangan) }}</textarea>
            </div>

            <div class="button-group">
                <a href="{{ route('gurubk.riwayatpelanggaran.index') }}" class="btn-kembali">Batal</a>
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>