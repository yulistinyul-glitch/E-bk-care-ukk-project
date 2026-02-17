@extends('gurubk.layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="fw-bold mb-4">Tambah E-Surat</h3>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">

            <form action="{{ route('gurubk.e_surat.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}">
                                {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Template</label>
                    <select name="id_template" class="form-control" required>
                        <option value="">-- Pilih Template --</option>
                        @foreach($template as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->nama_template }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Guru BK</label>
                    <select name="id_gurubk" class="form-control" required>
                        <option value="">-- Pilih Guru BK --</option>
                        @foreach($gurubk as $g)
                            <option value="{{ $g->id }}">
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Terbit</label>
                    <input type="date"
                           name="tanggal_terbit"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Keterangan Tambahan</label>
                    <textarea name="keterangan_tambahan"
                              class="form-control"
                              rows="4"
                              required></textarea>
                </div>

                <button class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('gurubk.e_surat.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection
