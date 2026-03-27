@extends('gurubk.layouts.app')
@section('title', 'Laporan Bulanan')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Daftar Laporan Bulanan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('gurubk.laporan.create') }}" class="btn btn-primary mb-3">Buat Laporan Baru</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Total Pelanggaran</th>
                <th>Total Saran</th>
                <th>Total Self Report</th>
                <th>Total Konseling</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $l)
            <tr>
                <td>{{ \Carbon\Carbon::parse($l->bulan)->format('F Y') }}</td>
                <td>{{ $l->total_pelanggaran }}</td>
                <td>{{ $l->total_saran }}</td>
                <td>{{ $l->total_selfreport }}</td>
                <td>{{ $l->total_konseling }}</td>
                <td>
                    @if($l->status == 'terkirim')
                        <span class="badge bg-success">Terkirim</span>
                    @elseif($l->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @else
                        <span class="badge bg-primary">Diterima</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada laporan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection