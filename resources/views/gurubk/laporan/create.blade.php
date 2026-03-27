@extends('gurubk.layouts.app')
@section('title', 'Buat Laporan Bulanan')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Buat Laporan Bulanan</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gurubk.laporan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan Laporan</label>
            <input type="month" class="form-control" id="bulan" name="bulan" required>
        </div>

        <button type="submit" class="btn btn-primary">Buat Laporan</button>
        <a href="{{ route('gurubk.laporan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection