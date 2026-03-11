@extends('gurubk.layouts.app')

@section('content')
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0" style="color: white;"><i class="bi bi-chat-left-text me-2"></i>Daftar Saran Masuk</h5>
        <p>Total {{ $totalSaran }} saran masuk</p>
    </div>
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('gurubk.saran.index')}}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="form-label small fw-bold text-muted">Filter tanggal</label>
                    <input type="date" name="tanggal" id="" class="form-control" value="{{ request('tanggal')}}">
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('gurubk.saran.export', request()->query()) }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i>Download PDF
                    </a>
                </div>

                <div class="col-md-3">
                    <label for="" class="form-label small fw-bold text-muted">Target Saran</label>
                    <select name="target" id="" class="form-select">
                        <option value="">Semua Target</option>
                        <option value="Wali Kelas">{{ request('target') == 'Wali Kelas' ? 'selected' : ''}}Wali kelas</option>
                        <option value="Guru/staf">{{ request('target') == 'Guru/staf' ? 'selected' : ''}}Guru/staf pengajar</option>
                        <option value="Kepala sekolah">{{ request('target') == 'Kepala sekolah' ? 'selected' : ''}}Kepala sekolah</option>
                        <option value="Organisasi">{{ request('target') == 'Organisasi' ? 'selected' : ''}}Organisasi (OSIS/MPK)</option>
                        <option value="Fasilitas">{{ request('target') == 'Fasilitas' ? 'selected' : ''}}Fasilitas</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="" class="form-label small fw-bold text-muted">Status</label>
                    <select name="status" id="" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="unread">{{ request('status') == 'unread' ? 'selected' : ''}}Belum dibaca</option>
                        <option value="read">{{ request('status') == 'read' ? 'selected' : ''}}Sudah dibaca</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <a href="{{route('gurubk.saran.index')}}" class="btn btrn-light w-100">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Target</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($saran as $item)
                    <tr>
                        <td class="small">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($item->is_anonymous)
                                <span class="text-muted fw-light italic">Anonim</span>
                            @else
                                <span class="fw-bold">{{ $item->siswa->nama_siswa ?? 'Siswa' }}</span>
                            @endif
                        </td>
                        <td><span class="badge bg-info text-dark">{{ $item->target }}</span></td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $item->message }}</td>
                        <td>
                            @if($item->status == 'unread')
                                <span class="badge bg-danger">Belum Dibaca</span>
                            @else
                                <span class="badge bg-success">Dibaca</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-info text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDetailSaran"
                            data-pesan="{{ $item->message}}"
                            data-pengirim="{{ $item->is_anonymous ? 'Anonim' : ($item->siswa->nama_siswa ?? 'Siswa')}}"
                            data-target="{{ $item->target }}">
                            <i class="bi bi-eye"></i> Detail
                            </button>
                            @if($item->status == 'unread')
                                <form action="{{ route('gurubk.saran.read', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-check2-all"></i> Tandai Dibaca
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-light" disabled>Selesai</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada saran masuk.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- modal popup --}}
{{-- <div class="modal fade" id="modalDetailSaran" tabindex="-1" aria-labelledby="exampleModalTable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel font-bold">Detail Saran Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label for="" class="fw-bold text-muted small uppecase">Ditujukan untuk:</label>
                    <p id="detailTarget" class="fw-bold text-muted small uppercase"></p>
                </div>
                <div class="mb-3">
                    <label for="" class="fw-bold text-muted small uppercase">Pengirim:</label>
                    <p id="detailPengirim" class="text-dark"></p>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="" class="fw-bold text-muted small uppercase">Isi pesan/saran:</label>
                    <div class="p-3 bg-light rounded-3 border">
                        <p id="detailPesan" class="mb-0 italic text-secondary" style="white-space: pre-wrap;"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> --}}
@endsection

