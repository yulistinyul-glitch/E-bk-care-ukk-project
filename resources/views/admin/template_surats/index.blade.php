@extends('admin.layouts.app')

@section('title', 'Data Template Surat')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 
    .header-title { font-size: 28px; font-weight: 700; color: #333; }

    .btn-catat {
        background-color: #5d5fef;
        color: white; padding: 12px 25px;
        border-radius: 12px; font-weight: 600;
        text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.3);
    }
    .btn-catat:hover { 
        background-color: #4a4cd9; 
        color: white; 
        transform: translateY(-2px);
    }

    .table-container {
        background: white; border-radius: 20px;
        padding: 20px; margin-top: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .btn-action {
        width: 36px; height: 36px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 8px; border: none; color: white;
        font-size: 16px;
        transition: 0.2s;
    }
    .btn-action:hover { transform: translateY(-1px); }
    .btn-edit { background-color: #ffb74d; }
    .btn-delete { background-color: #ff7070; }
    .btn-download { background-color: #28a745; }
</style>

<div class="d-flex justify-content-between align-items-center mb-3 mt-3">
    <h4 class="header-title">Data Template Surat</h4>
    <a href="{{ route('admin.template_surats.create') }}" class="btn-catat">
        + Tambah Template
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Template</th>
                    <th>Nama Template</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($templates as $index => $t)
                <tr>
                    <td>{{ $templates->firstItem() + $index }}</td>
                    <td class="fw-bold">{{ $t->id_template }}</td>
                    <td class="text-start">{{ $t->nama_template }}</td>
                    <td>{{ $t->file }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.template_surats.download', $t->id_template) }}" class="btn-action btn-download">
                                <i class="bi bi-download"></i>
                            </a>

                            <a href="{{ route('admin.template_surats.edit', $t->id_template) }}" class="btn-action btn-edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.template_surats.destroy', $t->id_template) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action btn-delete" onclick="return confirm('Hapus template ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted py-5">
                        <i class="bi bi-exclamation-circle fs-1"></i>
                        <p class="mt-3">Belum ada template</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
