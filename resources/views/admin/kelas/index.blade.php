@extends('admin.layouts.app')

@section('title', 'Data Kelas')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 
    .header-title { font-size: 24px; font-weight: 800; color: #333; } 

    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 8px 18px;
        border-radius: 10px; font-weight: 600;
        font-size: 13px;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.2);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-catat:hover { color: white; opacity: 0.9; transform: translateY(-2px); }

    .main-wrapper {
        background: white; border-radius: 20px;
        padding: 0; overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .filter-area { padding: 20px; }
    
    .input-group-custom {
        background: #fff; border: 1px solid #e2e8f0;
        border-radius: 10px; height: 32px;
        padding: 0 12px; font-size: 12px;
        width: 100%; outline: none;
    }
    
    .table-container { padding: 0 15px 15px 15px; }
    .table thead th { 
        background-color: #f8fafc; border: none; 
        font-size: 12px; color: #888; 
        font-weight: 600; padding: 12px;
    }
    .table tbody td { padding: 12px; color: #444; font-size: 12.5px; border-bottom: 1px solid #f8f9fa; }
    
    .badge-jurusan { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; display: inline-block; }
    .badge-pplg { background-color: #fff9db; color: #f59f00; } 
    .badge-brp { background-color: #e3f2fd; color: #1976d2; }
    .badge-dkv { background-color: #fce4ec; color: #d81b60; }

    .btn-action-icon { border: none; background: none; padding: 0; font-size: 1.1rem; transition: 0.2s; cursor: pointer; }
    .icon-edit { color: #ffb74d; }
    .icon-delete { color: #ff7070; }
    .btn-action-icon:hover { transform: scale(1.15); }
    
    /* PAGINATION STYLING (IDENTIK WALIKELAS) */
    .pagination-wrapper {
        display: flex !important;
        justify-content: center !important;
        padding: 20px 0;
    }
    .page-link { padding: 3px 10px !important; font-size: 11px !important; border-radius: 5px !important; }

    /* OFFCANVAS STYLING */
    .offcanvas { border: none; width: 380px !important; box-shadow: -10px 0 40px rgba(0,0,0,0.1); border-radius: 20px 0 0 20px; }
    .form-control-custom { border-radius: 10px; padding: 10px; background-color: #f8fafc; border: 1px solid #eceef1; font-size: 13px; }
    .form-label { font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; margin-bottom: 5px; display: block; }

    /* KUSTOMISASI MODAL POPUP */
    .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
    .swal-btn-cancel { background-color: #f1f1f1 !important; color: #666 !important; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-start mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">Manajemen Data Kelas</h4>
            <p style="font-size: 13px; color: #888; margin-top: 4px; margin-bottom: 0;">Kelola data tingkat kelas, jurusan, dan pembagian ruang kelas secara efisien.</p>
        </div>
        <button class="btn-catat" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTambah">
            <i class="bi bi-plus-lg"></i> Tambah Kelas
        </button>
    </div>

    <div class="main-wrapper shadow-sm">
        <div class="filter-area">
            <form action="{{ route('admin.kelas.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #b5b5b5; font-size: 12px;"></i>
                            <input type="text" name="search" class="input-group-custom" 
                                placeholder="Cari Nama Kelas atau Jurusan..." 
                                value="{{ request('search') }}" 
                                style="padding-left: 35px;">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $index => $k)
                        <tr>
                            <td>{{ $kelas->firstItem() + $index }}</td>
                            <td class="fw-bold text-dark">{{ $k->id_kelas }}</td>
                            <td class="fw-semibold text-dark">
                                @php
                                    $romawi = [10 => 'X', 11 => 'XI', 12 => 'XII'];
                                    $tingkat = $romawi[$k->nama_kelas] ?? $k->nama_kelas;
                                    $jurusanSaja = explode(' ', trim($k->jurusan))[0];
                                @endphp
                                {{ $tingkat }} {{ $jurusanSaja }} {{ $k->nomor_ruang }}
                            </td>
                            <td>
                                @php
                                    $colorClass = ($jurusanSaja == 'BRP') ? 'badge-brp' : ((str_contains($jurusanSaja, 'DKV')) ? 'badge-dkv' : 'badge-pplg');
                                @endphp
                                <span class="badge-jurusan {{ $colorClass }}">{{ $jurusanSaja }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <button class="btn-action-icon icon-edit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEdit{{ $k->id_kelas }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form id="delete-form-{{ $k->id_kelas }}" action="{{ route('admin.kelas.destroy', $k->id_kelas) }}" method="POST" class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button" class="btn-action-icon icon-delete" onclick="confirmDelete('{{ $k->id_kelas }}', '{{ $tingkat }} {{ $jurusanSaja }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- OFFCANVAS EDIT --}}
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit{{ $k->id_kelas }}">
                            <div class="offcanvas-header border-bottom py-3">
                                <h5 class="fw-bold mb-0" style="font-size: 1rem;">Edit Data Kelas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form action="{{ route('admin.kelas.update', $k->id_kelas) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">Tingkat Kelas</label>
                                        <select name="nama_kelas" class="form-select form-control-custom" required>
                                            <option value="10" {{ $k->nama_kelas == 10 ? 'selected' : '' }}>X</option>
                                            <option value="11" {{ $k->nama_kelas == 11 ? 'selected' : '' }}>XI</option>
                                            <option value="12" {{ $k->nama_kelas == 12 ? 'selected' : '' }}>XII</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">ID Wali Kelas</label>
                                        <input type="text" class="form-control form-control-custom" value="{{ $k->id_walikelas }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jurusan</label>
                                        <select name="jurusan" class="form-select form-control-custom" required>
                                            <option value="PPLG" {{ $k->jurusan == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                                            <option value="BRP" {{ $k->jurusan == 'BRP' ? 'selected' : '' }}>BRP</option>
                                            <option value="DKV" {{ $k->jurusan == 'DKV' ? 'selected' : '' }}>DKV</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Ruang</label>
                                        <input type="number" name="nomor_ruang" class="form-control form-control-custom" value="{{ $k->nomor_ruang }}" required>
                                    </div>
                                    <button type="submit" class="btn-catat w-100 justify-content-center py-2 border-0 mt-3">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <p class="mt-2 fw-bold" style="font-size: 13px;">Belum ada data kelas.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="pagination-wrapper">
                {{ $kelas->appends(request()->input())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- OFFCANVAS TAMBAH --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasTambah">
    <div class="offcanvas-header border-bottom py-3">
        <h5 class="fw-bold mb-0" style="font-size: 1rem;">Tambah Kelas Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('admin.kelas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">ID Kelas</label>
                <input type="text" id="id_kelas_tambah" name="id_kelas" class="form-control form-control-custom" placeholder="KLS001" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">ID Wali Kelas (Otomatis)</label>
                <input type="text" id="id_walikelas_tambah" name="id_walikelas" class="form-control form-control-custom" placeholder="GR..." readonly required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tingkat Kelas</label>
                <select name="nama_kelas" class="form-select form-control-custom" required>
                    <option value="" hidden>Pilih Tingkat</option>
                    <option value="10">X</option>
                    <option value="11">XI</option>
                    <option value="12">XII</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jurusan</label>
                <select name="jurusan" class="form-select form-control-custom" required>
                    <option value="" hidden>Pilih Jurusan</option>
                    <option value="PPLG">PPLG</option>
                    <option value="BRP">BRP</option>
                    <option value="DKV">DKV</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor Ruang</label>
                <input type="number" name="nomor_ruang" class="form-control form-control-custom" placeholder="1" required>
            </div>
            <button type="submit" class="btn-catat w-100 justify-content-center py-2 border-0 mt-3">Simpan Kelas</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            iconColor: '#00C897',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            customClass: { 
                popup: 'my-swal-popup',
                title: 'swal2-title',
                htmlContainer: 'swal2-html-container'
            }
        });
    @endif

    function confirmDelete(id, nama) {
        Swal.fire({
            title: 'Hapus?',
            text: "Yakin ingin menghapus " + nama + "?",
            icon: 'warning',
            iconColor: '#ff7070',
            showCancelButton: true,
            confirmButtonColor: '#ff7070',
            cancelButtonColor: '#f1f1f1',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'my-swal-popup',
                confirmButton: 'swal-button-custom',
                cancelButton: 'swal-button-custom swal-btn-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    document.addEventListener('DOMContentLoaded', function() {
        const inputIDKelas = document.getElementById('id_kelas_tambah');
        const inputIDWali = document.getElementById('id_walikelas_tambah');

        inputIDKelas.addEventListener('input', function() {
            let val = this.value.toUpperCase();
            let angka = val.replace(/[^0-9]/g, '');            
            inputIDWali.value = angka !== "" ? "GR" + angka : "GR...";
        });
    });
</script>

@endsection