@extends('admin.layouts.app')

@section('title', 'Edit Pelanggaran')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="form-box w-100" style="max-width:600px; background:white; padding:35px; border-radius:25px; box-shadow:0 10px 30px rgba(0,0,0,0.08);">
        
        <h4 class="text-center" style="font-weight:600; color:#2D3436; margin-bottom:25px; font-size:1.4rem;">
            Edit Data Pelanggaran
        </h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pelanggaran.update', $pelanggaran->id_pelanggaran) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="id_pelanggaran">ID Pelanggaran</label>
                <input type="text" class="form-control"
                    value="{{ $pelanggaran->id_pelanggaran }}"
                    readonly
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px; font-weight:600; color:#5D5FEF; background:#f1f3f5;">
            </div>

            <div class="mb-3 poppins">
                <label class="form-label" for="kategori_pelanggaran">Kategori</label>
                <select name="kategori_pelanggaran" class="form-select" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px; font-size:13px;">
                    
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriOptions as $kategori)
                        <option value="{{ $kategori }}"
                            {{ old('kategori_pelanggaran', $pelanggaran->kategori_pelanggaran) == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kegiatan</label>
                <input type="text" name="jenis_kegiatan" class="form-control"
                    value="{{ old('jenis_kegiatan', $pelanggaran->jenis_kegiatan) }}" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px;">
            </div>

            <div class="mb-3">
                <label class="form-label">Tingkatan</label>
                <select name="tingkatan" class="form-select" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px; font-size:13px;">
                    
                    <option value="">-- Pilih Tingkatan --</option>
                    <option value="ringan" {{ old('tingkatan', $pelanggaran->tingkatan) == 'ringan' ? 'selected' : '' }}>Ringan</option>
                    <option value="sedang" {{ old('tingkatan', $pelanggaran->tingkatan) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="berat" {{ old('tingkatan', $pelanggaran->tingkatan) == 'berat' ? 'selected' : '' }}>Berat</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Poin</label>
                <input type="number" name="poin_pelanggaran" class="form-control"
                    value="{{ old('poin_pelanggaran', $pelanggaran->poin_pelanggaran) }}" required
                    style="border:1.5px solid #DFE6E9; border-radius:12px; padding:10px 15px;">
            </div>

            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('admin.pelanggaran.index') }}" 
                   class="btn btn-secondary flex-fill"
                   style="border-radius:12px; padding:12px; font-weight:500;">
                    Batal
                </a>

                <button type="submit" 
                    class="btn btn-primary flex-fill"
                    style="border-radius:12px; padding:12px; font-weight:500; background:#5D5FEF; border:none;">
                    Update Data Pelanggaran
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.1);
        border-color: #5D5FEF;
        outline: none;
    }
</style>
@endsection
