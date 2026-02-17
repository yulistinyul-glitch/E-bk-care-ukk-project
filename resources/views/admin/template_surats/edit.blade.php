@extends('admin.layouts.app')

@section('title', 'Edit Template Surat')

@section('content')
<div class="container">
    <h4 class="mb-3">Edit Template Surat</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.template_surats.update', $template->id_template) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Template</label>
            <input type="text" name="nama_template" class="form-control" value="{{ $template->nama_template }}" required>
        </div>

        <div class="mb-3">
            <label>Ganti File (PDF/DOC/DOCX)</label>
            <input type="file" name="file" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
