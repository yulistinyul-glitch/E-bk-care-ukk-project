@extends('admin.layouts.app')

@section('content')
<div class="nxl-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajemen Artikel</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Artikel</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;" class="ps-4">No</th>
                                        <th style="width: 150px;">Foto</th>
                                        <th>Judul & Deskripsi</th>
                                        <th style="width: 100px;" class="text-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($articles as $item)
                                    <tr>
                                        <td class="ps-4">{{ $loop->iteration }}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" 
                                                     class="img-fluid rounded" 
                                                     style="width: 100px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                                                    <i class="feather-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="mb-1">
                                                <span class="fw-bold text-dark d-block">{{ $item->title }}</span>
                                            </div>
                                            <small class="text-muted">
                                                {{ Str::limit(strip_tags($item->content ?? ''), 100) }}
                                            </small>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('admin.artikel.edit', $item->id) }}" 
                                               class="btn btn-sm btn-soft-warning">
                                                <i class="feather-edit-3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="feather-alert-circle d-block mb-2" style="font-size: 2rem;"></i>
                                            Belum ada data artikel.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection