@extends('gurubk.layouts.app')

@section('content')

<div class="container mt-4">

    <h3 class="fw-bold mb-4">Generate E-SP</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 rounded-4 mb-5"
         style="box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
        <div class="card-body">

            <form action="{{ route('gurubk.e_surat.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Siswa</label>
                        <select name="id_siswa" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Template</label>
                        <select name="id_template" class="form-control" required>
                            <option value="">-- Pilih Template --</option>
                            @foreach($template as $t)
                                <option value="{{ $t->id }}">
                                    {{ $t->nama_template }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Tanggal Terbit</label>
                        <input type="date"
                               name="tanggal_terbit"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="fw-semibold">Keterangan</label>
                        <textarea name="keterangan_tambahan"
                                  class="form-control"
                                  rows="2"
                                  required></textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-success rounded-pill px-4">
                    Simpan
                </button>

            </form>

        </div>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <form method="GET" class="w-50">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control rounded-start-pill"
                       placeholder="Cari Nama Siswa"
                       value="{{ request('search') }}">
                <button class="btn btn-outline-secondary rounded-end-pill">
                    🔍
                </button>
            </div>
        </form>
    </div>

    <div class="card border-0 rounded-4"
         style="box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
        <div class="card-body">

            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Jenis SP</th>
                        <th>Tanggal Terbit</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surat as $item)
                    <tr>
                        <td>
                            {{ ($surat->currentPage()-1)*$surat->perPage()+$loop->iteration }}
                        </td>

                        <td>{{ optional($item->siswa)->nama ?? '-' }}</td>

                        <td>{{ optional($item->template)->nama_template ?? '-' }}</td>

                        <td>{{ \Carbon\Carbon::parse($item->tanggal_terbit)->format('d-m-Y') }}</td>

                        <td>
                            @if($item->status == 'draft')
                                <span class="badge bg-secondary">Draft</span>
                            @elseif($item->status == 'pdf')
                                <span class="badge bg-primary">PDF</span>
                            @elseif($item->status == 'emailed')
                                <span class="badge bg-warning text-dark">Emailed</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>

                        <td>
                            @if($item->status == 'draft')
                                <a href="{{ route('gurubk.e_surat.export',$item->id) }}"
                                   class="btn btn-success btn-sm">
                                   Export PDF
                                </a>

                            @elseif($item->status == 'pdf')
                                <a href="{{ route('gurubk.e_surat.email',$item->id) }}"
                                   class="btn btn-secondary btn-sm">
                                   Kirim Email
                                </a>

                            @elseif($item->status == 'emailed')
                                <a href="{{ route('gurubk.e_surat.selesai',$item->id) }}"
                                   class="btn btn-warning btn-sm">
                                   Selesai
                                </a>

                            @elseif($item->status == 'selesai')
                                <span class="badge bg-success">
                                    ✔ Selesai
                                </span>
                            @endif
                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $surat->withQueryString()->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
