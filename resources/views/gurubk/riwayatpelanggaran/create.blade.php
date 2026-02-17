@extends('gurubk.layouts.app')

@section('title', 'Catat Pelanggaran')

@section('content')

<div class="container mt-4">
    <h4 class="fw-bold mb-4">Catat Pelanggaran Siswa</h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form action="{{ route('riwayatpelanggaran.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Kelas</label>
                    <select name="id_kelas" id="kelas" class="form-select" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}">
                                {{ $k->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Siswa</label>
                    <select name="id_siswa" id="siswa" class="form-select" required>
                        <option value="">Pilih Siswa</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori Pelanggaran</label>
                <select id="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->kategori_pelanggaran }}">
                            {{ $k->kategori_pelanggaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kegiatan</label>
                <select name="id_pelanggaran" id="jenis" class="form-select" required>
                    <option value="">Pilih Jenis</option>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Tingkatan</label>
                    <input type="text" id="tingkatan" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Poin</label>
                    <input type="text" id="poin" name="poin" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <input type="text" id="status" name="status" class="form-control" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

        </form>
    </div>
</div>


<script>
document.getElementById('kelas').addEventListener('change', function() {

    let id = this.value;

    fetch('/get-siswa/' + id)
        .then(response => response.json())
        .then(data => {

            let siswaSelect = document.getElementById('siswa');
            siswaSelect.innerHTML = '<option value="">Pilih Siswa</option>';

            data.forEach(function(s) {
                siswaSelect.innerHTML += 
                    `<option value="${s.id_siswa}">
                        ${s.nama_siswa}
                    </option>`;
            });

        });
});

document.getElementById('kategori').addEventListener('change', function() {

    let kategori = this.value;

    fetch('/get-jenis/' + kategori)
        .then(response => response.json())
        .then(data => {

            let jenisSelect = document.getElementById('jenis');
            jenisSelect.innerHTML = '<option value="">Pilih Jenis</option>';

            data.forEach(function(j) {
                jenisSelect.innerHTML += 
                    `<option value="${j.id_pelanggaran}">
                        ${j.jenis_kegiatan}
                    </option>`;
            });
            document.getElementById('tingkatan').value = '';
            document.getElementById('poin').value = '';
            document.getElementById('status').value = '';
        });
});

document.getElementById('jenis').addEventListener('change', function() {

    let id = this.value;

    fetch('/get-detail/' + id)
        .then(response => response.json())
        .then(data => {

            document.getElementById('tingkatan').value = data.tingkatan;
            document.getElementById('poin').value = data.poin_pelanggaran;
            document.getElementById('status').value = data.tingkatan;

        });
});
</script>

@endsection
