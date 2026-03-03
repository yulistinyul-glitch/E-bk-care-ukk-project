@extends('gurubk.layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="bg-success text-white rounded-3 p-2 me-3">
                <i class="bi bi-file-earmark-plus fs-3"></i>
            </div>
            <h3 class="fw-bold m-0">Buat E-Surat Baru</h3>
        </div>
        <a href="{{ route('gurubk.e_surat.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('gurubk.e_surat.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nomor Surat Resmi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-hash"></i></span>
                            <input type="text" name="nomor_surat_resmi" 
                                   class="form-control bg-light border-start-0 @error('nomor_surat_resmi') is-invalid @enderror" 
                                   placeholder="Contoh: 421.3/123/SMK-BK/2026" 
                                   value="{{ old('nomor_surat_resmi') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Terbit</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar3"></i></span>
                            <input type="date" name="tanggal_terbit" 
                                   class="form-control bg-light border-start-0 @error('tanggal_terbit') is-invalid @enderror" 
                                   value="{{ old('tanggal_terbit', date('Y-m-d')) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Pilih Siswa</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                            <select name="id_siswa" class="form-select bg-light border-start-0 select2" required>
                                <option value="">-- Cari Nama/NIPD/Kelas --</option>
                                @foreach($siswa as $s)
                                    <option value="{{ $s->id_siswa }}" {{ old('id_siswa') == $s->id_siswa ? 'selected' : '' }}>
                                        {{ $s->nama }} | {{ $s->kelas }} | {{ $s->nipd }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Jenis Template Surat</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-file-earmark-text"></i></span>
                            <select name="id_template" class="form-select bg-light border-start-0" required>
                                <option value="">-- Pilih Template --</option>
                                @foreach($template as $t)
                                    <option value="{{ $t->id_template }}" {{ old('id_template') == $t->id_template ? 'selected' : '' }}>
                                        {{ $t->nama_template }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Guru BK Penanggung Jawab</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-badge"></i></span>
                            <select name="id_gurubk" class="form-select bg-light border-start-0" required>
                                <option value="">-- Pilih Guru BK --</option>
                                @foreach($gurubk as $g)
                                    <option value="{{ $g->id_gurubk }}" {{ old('id_gurubk') == $g->id_gurubk ? 'selected' : '' }}>
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Keterangan / Alasan</label>
                    <textarea name="keterangan_tambahan" 
                              class="form-control bg-light" 
                              rows="4" 
                              placeholder="Contoh: Siswa sering terlambat masuk jam pertama lebih dari 3 kali dalam seminggu."
                              required>{{ old('keterangan_tambahan') }}</textarea>
                </div>

                <hr class="text-muted opacity-25">

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light px-4 rounded-pill">Reset</button>
                    <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm">
                        <i class="bi bi-file-earmark-word me-1"></i> Simpan & Generate Surat
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection