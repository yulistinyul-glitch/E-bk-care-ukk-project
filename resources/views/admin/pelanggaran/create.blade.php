

@extends('admin.layouts.app')

@section('title', 'Input Data Pelanggaran')

@section('content')

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
        max-width: 600px; 
        background: white; 
        padding: 35px; 
        border-radius: 25px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
    }

    h4 { 
        font-weight: 600; 
        color: #2D3436; 
        margin-bottom: 25px; 
        font-size: 1.4rem; 
    }

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

    .button-group { 
        display: flex; 
        gap: 12px; 
        margin-top: 30px; 
    }

    .btn-kembali {
        background: #B5B5B5; 
        color: white; 
        border: none; 
        border-radius: 12px;
        padding: 12px 20px; 
        flex: 1; 
        text-decoration: none;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-weight: 500; 
        transition: 0.3s;
    }

    .btn-simpan {
        background: #5D5FEF; 
        color: white; 
        border: none; 
        border-radius: 12px;
        padding: 12px 20px; 
        flex: 1.5; 
        display: flex;
        align-items: center; 
        justify-content: center;
        font-weight: 500; 
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

<div class="center-wrapper">
    <div class="form-box">
        <h4 class="text-center">Input Data Pelanggaran</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.pelanggaran.store') }}" method="POST">
            @csrf
           <div class="mb-3">
                <label class="form-label" for="id_pelanggaran">ID Pelanggaran</label>
                <input type="text" class="form-control" id="id_pelanggaran" name="id_pelanggaran" value="{{ $nextId }}" readonly
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px; font-weight:600; color:#5D5FEF; background:#f1f3f5;">
            </div>

            <div class="mb-3 poppins">
                <label class="form-label" for="kategori_pelanggaran">Kategori</label>
                <select name="kategori_pelanggaran" id="kategori_pelanggaran" class="form-select" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px; font-size: 13px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriOptions as $kategori)
                        <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="jenis_kegiatan">Jenis Kegiatan</label>
                <input type="text" class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px;">
            </div>

            <div class="mb-3">
                <label class="form-label" for="tingkatan">Tingkatan</label>
                <select name="tingkatan" id="tingkatan" class="form-select" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px; font-size: 13px; ">
                    <option value="">-- Pilih Tingkatan --</option>
                    <option value="ringan">Ringan</option>
                    <option value="sedang">Sedang</option>
                    <option value="berat">Berat</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="poin_pelanggaran">Poin</label>
                <input type="number" class="form-control" id="poin_pelanggaran" name="poin_pelanggaran" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px;">
            </div>
            <div class="button-group">
                <a href="{{ route('admin.gurubk.index') }}" class="btn-kembali">
                    Batal
                </a>

                <button type="submit" class="btn-simpan">
                    Simpan Guru BK
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
