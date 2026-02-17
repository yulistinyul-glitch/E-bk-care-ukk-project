@extends('admin.layouts.app')

@section('title', 'Tambah Template Surat')

@section('content')
<div class="container">
    <h4 class="mb-3">Tambah Template Surat</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.template_surats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Template</label>
            <input type="text" name="nama_template" class="form-control" value="{{ old('nama_template') }}" required>
        </div>

        <div class="mb-3">
            <label>File Template (PDF / DOC / DOCX)</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
