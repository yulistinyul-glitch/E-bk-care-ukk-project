@extends('admin.layouts.app')
@section('title','Laporan Bulanan Guru BK')

@section('content')
<div class="container mt-4">

    <form action="" method="GET" class="mb-3 d-flex gap-2">
        <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
        <a href="{{ route('admin.laporan.export_pdf', ['bulan'=>request('bulan')]) }}" class="btn btn-danger">Export PDF</a>
        <a href="{{ route('admin.laporan.export_excel', ['bulan'=>request('bulan')]) }}" class="btn btn-success">Export Excel</a>
        <button type="submit" class="btn btn-primary">Filter Bulan</button>
    </form>

    <div class="card shadow rounded">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Guru BK</th>
                        <th>Bulan</th>
                        <th>Konseling</th>
                        <th>Self Report</th>
                        <th>Pelanggaran</th>
                        <th>Kotak Saran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporan as $lap)
                    <tr>
                        <td>{{ $lap->guruBK->nama_gurubk }}</td>
                        <td>{{ $lap->bulan }}</td>
                        <td>{{ $lap->konseling }}</td>
                        <td>{{ $lap->self_report }}</td>
                        <td>{{ $lap->pelanggaran }}</td>
                        <td>{{ $lap->kotak_saran }}</td>
                        <td>
                            <span class="badge 
                                @if($lap->status=='terkirim') bg-info 
                                @elseif($lap->status=='diterima') bg-success 
                                @else bg-secondary @endif">
                                {{ ucfirst($lap->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.laporan.update_status', $lap->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-select mb-1">
                                    <option value="pending" @if($lap->status=='pending') selected @endif>Pending</option>
                                    <option value="terkirim" @if($lap->status=='terkirim') selected @endif>Terkirim</option>
                                    <option value="diterima" @if($lap->status=='diterima') selected @endif>Diterima</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection