@extends('admin.layouts.app')

@section('title', 'Data Kelas')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 28px; font-weight: 700; color: #333; text-transform: none; }
    
    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 12px 25px;
        border-radius: 12px; font-weight: 600;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.3);
        border: none; display: inline-flex; align-items: center;
    }
    .btn-catat:hover { background-color: #4a4cd9; color: white; transform: translateY(-2px); }

    .search-wrapper { position: relative; max-width: 350px; width: 100%; }
    .search-input {
        background-color: white; border: none; border-radius: 12px;
        padding: 12px 20px 12px 45px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        font-size: 14px; transition: 0.3s;
    }
    .search-input:focus { box-shadow: 0 4px 20px rgba(93, 95, 239, 0.15); outline: none; }
    .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #adb5bd; }

    .table-container {
        background: white; border-radius: 20px;
        padding: 20px; margin-top: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .table thead th { border: none; font-size: 13px; color: #888; font-weight: 600; padding: 15px; text-transform: uppercase; }
    .table tbody td { padding: 15px; color: #444; font-size: 14px; border-bottom: 1px solid #f8f9fa; }

    .badge-jurusan { padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; display: inline-block; }
    .badge-pplg { background-color: #fff9db; color: #f59f00; } 
    .badge-brp { background-color: #e7f5ff; color: #228be6; }  
    .badge-dkv { background-color: #fff5f5; color: #fa5252; }  

    .btn-action { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; transition: 0.2s; color: white; text-decoration: none; }
    .btn-edit { background-color: #ffb74d; }
    .btn-delete { background-color: #ff7070; }

    .offcanvas { border: none; width: 400px !important; box-shadow: -10px 0 40px rgba(0,0,0,0.1); }
    .form-control-custom { border-radius: 12px; padding: 12px 15px; background-color: #f8f9fa; border: 2px solid transparent; transition: 0.3s; }
    .form-control-custom:focus { background-color: white; border-color: #5d5fef; outline: none; box-shadow: none; }
    .form-label { font-size: 11px; font-weight: 700; color: #aaa; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block; }
    .btn-batal { background-color: #eeeeee; color: #666; padding: 12px; border-radius: 12px; font-weight: 600; border: none; }
    
    .form-control-custom[readonly] { background-color: #eceef1; cursor: not-allowed; color: #666; font-weight: 600; }
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" style="border-radius: 15px;">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="mb-4 mt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="header-title mb-0">Data Kelas</h4>
        <button class="btn-catat shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTambah">
            <i class="bi bi-plus-lg me-2"></i> Tambah Kelas
        </button>
    </div>

    <div class="d-flex justify-content-start">
        <form action="{{ route('admin.kelas.index') }}" method="GET" class="search-wrapper">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="search-input w-100" placeholder="Cari nama kelas atau jurusan..." value="{{ request('search') }}">
        </form>
    </div>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Kelas</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $index => $k)
                <tr>
                    <td>{{ $kelas->firstItem() + $index }}</td>
                    <td class="fw-bold">{{ $k->id_kelas }}</td>
                    <td>
                        <span class="fw-bold text-dark">
                            @php
                                $romawi = [10 => 'X', 11 => 'XI', 12 => 'XII'];
                                $tingkat = $romawi[$k->nama_kelas] ?? $k->nama_kelas;
                                $jurusanSaja = explode(' ', trim($k->jurusan))[0];
                            @endphp
                            {{ $tingkat }} {{ $jurusanSaja }} {{ $k->nomor_ruang }}
                        </span>
                    </td>
                    <td>
                        @php
                            $colorClass = ($jurusanSaja == 'BRP') ? 'badge-brp' : ((str_contains($jurusanSaja, 'DKV')) ? 'badge-dkv' : 'badge-pplg');
                        @endphp
                        <span class="badge-jurusan {{ $colorClass }}">{{ $jurusanSaja }}</span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn-action btn-edit shadow-sm border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEdit{{ $k->id_kelas }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.kelas.destroy', $k->id_kelas) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete shadow-sm" onclick="return confirm('Hapus kelas ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- EDIT DATA --}}
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit{{ $k->id_kelas }}">
                    <div class="offcanvas-header border-bottom">
                        <h4 class="fw-bold mb-0">Edit Kelas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form action="{{ route('admin.kelas.update', $k->id_kelas) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-4">
                                <label class="form-label">Tingkat Kelas</label>
                                <select name="nama_kelas" class="form-control form-control-custom" required>
                                    <option value="10" {{ $k->nama_kelas == 10 ? 'selected' : '' }}>X</option>
                                    <option value="11" {{ $k->nama_kelas == 11 ? 'selected' : '' }}>XI</option>
                                    <option value="12" {{ $k->nama_kelas == 12 ? 'selected' : '' }}>XII</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">ID Wali Kelas</label>
                                <input type="text" name="id_walikelas" class="form-control form-control-custom" value="{{ $k->id_walikelas }}" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Jurusan</label>
                                <select name="jurusan" class="form-control form-control-custom" required>
                                    <option value="PPLG" {{ $k->jurusan == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                                    <option value="BRP" {{ $k->jurusan == 'BRP' ? 'selected' : '' }}>BRP</option>
                                    <option value="DKV" {{ $k->jurusan == 'DKV' ? 'selected' : '' }}>DKV</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Nomor Ruang / Urutan</label>
                                <input type="number" name="nomor_ruang" class="form-control form-control-custom" value="{{ $k->nomor_ruang }}" required>
                            </div>
                            <div class="mt-5 d-flex flex-column gap-2">
                                <button type="submit" class="btn-catat w-100 py-3 border-0 justify-content-center">Update Perubahan</button>
                                <button type="button" class="btn-batal w-100 py-3" data-bs-dismiss="offcanvas">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr><td colspan="5" class="py-5 text-muted">Data tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $kelas->appends(request()->input())->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- TAMBAH DATA --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasTambah">
    <div class="offcanvas-header border-bottom">
        <h4 class="fw-bold mb-0">Tambah Kelas</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('admin.kelas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">ID Kelas</label>
                <input type="text" id="id_kelas_tambah" name="id_kelas" class="form-control form-control-custom" placeholder="Contoh: KLS001" required autocomplete="off">
            </div>
            <div class="mb-4">
                <label class="form-label">ID Wali Kelas (Otomatis)</label>
                <input type="text" id="id_walikelas_tambah" name="id_walikelas" class="form-control form-control-custom" placeholder="GR..." readonly required>
            </div>
            <div class="mb-4">
                <label class="form-label">Tingkat Kelas</label>
                <select name="nama_kelas" class="form-control form-control-custom" required>
                    <option value="" hidden>Pilih Tingkat</option>
                    <option value="10">X</option>
                    <option value="11">XI</option>
                    <option value="12">XII</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Jurusan</label>
                <select name="jurusan" class="form-control form-control-custom" required>
                    <option value="" hidden>Pilih Jurusan</option>
                    <option value="PPLG">PPLG</option>
                    <option value="BRP">BRP</option>
                    <option value="DKV">DKV</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Nomor Ruang / Urutan</label>
                <input type="number" name="nomor_ruang" class="form-control form-control-custom" placeholder="1" required>
            </div>
            <div class="mt-5 d-flex flex-column gap-2">
                <button type="submit" class="btn-catat w-100 py-3 border-0 justify-content-center">Simpan Kelas</button>
                <button type="button" class="btn-batal w-100 py-3" data-bs-dismiss="offcanvas">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputIDKelas = document.getElementById('id_kelas_tambah');
        const inputIDWali = document.getElementById('id_walikelas_tambah');

        inputIDKelas.addEventListener('input', function() {
            let val = this.value.toUpperCase();
            let angka = val.replace(/[^0-9]/g, '');            
            if (angka !== "") {
                inputIDWali.value = "GR" + angka;
            } else {
                inputIDWali.value = "";
            }
        });
    });
</script>

@endsection