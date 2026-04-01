@extends('gurubk.layouts.app')

@section('content')

<div class="container mt-4">

    <h4 class="mb-4">Detail Laporan</h4>

    <div class="card shadow rounded-4">
        <div class="card-body">

            <p><strong>ID:</strong> {{ $report->id_report }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($report->tanggal_lapor)->format('d F Y') }}</p>
            <p><strong>Kategori:</strong> {{ $report->kategori_masalah }}</p>
            <p><strong>Deskripsi:</strong></p>
            <p>{{ $report->isi_laporan }}</p>
            <p><strong>Bukti Pendukung:</strong></p>
            @if ($report->file)
             @php
                 $extension = pathinfo($report->file, PATHINFO_EXTENSION)
             @endphp

             @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $report->file)}}" alt="Bukti kejadian"
                        class="img-fluid rounded-3 border" style="max-width: 300px">
                    </div>
             @endif
            
             @else
                <p class="text-muted italic">Tidak ada bukti pendukung yang diunggah.</p>               
            @endif
            <hr>

            @if($report->status_verifikasi == 'menunggu')

                <form action="{{ route('gurubk.selfreport.verifikasi', $report->id) }}"
                      method="POST"
                      class="d-flex gap-2">
                    @csrf

                    <button type="submit"
                            name="status"
                            value="disetujui"
                            class="btn btn-success">
                        Setujui
                    </button>

                    <button type="submit"
                            name="status"
                            value="ditolak"
                            class="btn btn-danger">
                        Tolak
                    </button>
                </form>

            @else

                <div class="mt-3">
                    @if($report->status_verifikasi == 'disetujui')
                        <span class="badge bg-success">Sudah Disetujui</span>
                    @else
                        <span class="badge bg-danger">Sudah Ditolak</span>
                    @endif
                </div>

            @endif

            <a href="{{ url()->previous() }}"
               class="btn btn-secondary mt-4">
                Kembali
            </a>

        </div>
    </div>

</div>

@endsection
