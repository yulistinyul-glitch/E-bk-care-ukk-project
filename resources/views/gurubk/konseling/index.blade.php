@extends('gurubk.layouts.app')

@section('title', 'Konseling request')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Antrean Konseling</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>SISWA</th>
                            <th>KATEGORI</th>
                            <th>METODE</th>
                            <th>ALASAN/DESKRIPSI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $item)
                        <tr>
                            <td class="align-middle">
                                <strong>{{ $item->siswa->nama_siswa ?? 'Siswa tidak Ditemukan' }}</strong>
                                <br><small class="text-muted">{{ $item->id_siswa }}</small>
                            </td>
                            <td class="align-middle"><span class="badge bg-info text-dark">{{ $item->kategori }}</span></td>
                            <td class="align-middle">{{ ucfirst($item->pilihan_metode) }}</td>
                            <td class="align-middle text-wrap" style="max-width: 250px;">{{ $item->deskripsi }}</td>
                            <td class="align-middle">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalApprove{{ $item->id }}">
                                    SETUJUI JADWAL
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($requests as $item)
<div class="modal fade" id="modalApprove{{ $item->id }}" tabindex="-1" data-bs-backdrop="false" style="background: rgba(0,0,0,0.5); z-index: 9999;">  
      <div class="modal-dialog modal-dialog-centered" style="z-index: 1060;">
        <div class="modal-content shadow-lg">
            <form action="{{ route('gurubk.counseling.approve', $item->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalLabel{{ $item->id }}">Setujui Jadwal Konseling</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="alert alert-light border">
                        Siswa: <strong>{{ $item->siswa?->nama_siswa ?? 'Tidak Diketahui' }}</strong> ({{ $item->id_siswa }})
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Konseling</label>
                        <input type="date" name="scheduled_date" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jam Konseling</label>
                        <input type="time" name="scheduled_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tempat / Link Meeting</label>
                        <input type="text" name="location_link" class="form-control" placeholder="Contoh: Ruang BK atau Link Zoom" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Konfirmasi & Kirim Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

{{-- css --}}
<style>
    .container-fluid, .card, #wrapper, #content-wrapper, .main-panel {
        filter: none !important;
        -webkit-filter: none !important;
    }

    .modal {
        filter: none !important;
        background: rgba(0, 0, 0, 0.6) !important;
    }

    .modal-dialog {
        filter: none !important;
        opacity: 1 !important;
    }
</style>

{{-- js --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            document.body.appendChild(modal);
            modal.addEventListener('show.bs.modal', function() {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(b => b.remove());
            });
        });
    });
</script>