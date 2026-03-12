@extends('admin.layouts.app')

@section('content')
<style>
    .poppins-wrapper, .poppins-wrapper * { font-family: 'Poppins', sans-serif !important; }
    .card-header { display: flex !important; justify-content: space-between; align-items: center; padding: 20px; background: #fff; border-bottom: 1px solid #edf2f7; }
    .btn-tambah { background-color: #2563eb; color: white; padding: 8px 15px; border-radius: 10px; font-weight: 600; font-size: 13px; border: none; transition: 0.3s; }
    .custom-pop-up { display: flex; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.3s; }
    .custom-pop-up.active { opacity: 1; visibility: visible; }
    .modal-content { background: #fff; padding: 25px; border-radius: 15px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; }
    .preview-img { width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; display: none; }
</style>

<div class="container-fluid py-4 poppins-wrapper">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="fw-bold mb-0">Manajemen Kotak Saran</h4>
            <div>
                <button class="btn-tambah" onclick="bukaModal('modalTambahTeaser')" id="btnTeaser">+ Tambah Teaser</button>
                <button class="btn-tambah" onclick="bukaModal('modalTambahHow')" id="btnHow" style="display:none;">+ Tambah How It Works</button>
            </div>
        </div>

        <div class="p-4">
            <ul class="nav nav-pills mb-3" id="saranTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link" id="link-teaser" onclick="switchTab('tab-teaser', 'btnTeaser', this)">Teaser</button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link" id="link-how" onclick="switchTab('tab-how-it-works', 'btnHow', this)">How It Works</button>
                </li>
            </ul>

            <div class="tab-content">
                <div id="tab-teaser" class="tab-pane">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>No</th><th>Image</th><th>Judul</th><th>Icon</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @php
                            $teaserItems = $items->where('section', 'teaser');
                        @endphp

                        @foreach($teaserItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td> 
                            
                            <td><img src="{{ asset('storage/'.$item->image) }}" style="width: 100px; border-radius: 5px;"></td>
                            <td>{{ $item->title }}</td>
                            <td><i class="bi {{ $item->icon }}"></i></td>
                            <td>
                                <div style="max-width: 200px; word-wrap: break-word;">
                                    {{ Str::limit($item->description, 255) }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-warning" onclick="bukaModal('editModal{{$item->id}}')">Edit</button>
                                    <form action="{{ route('admin.data.kotaksaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

                <div id="tab-how-it-works" class="tab-pane" style="display:none;">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>No</th><th>Image</th><th>Judul</th><th>Deskripsi</th><th>Video</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @foreach($items->where('section', 'how_it_works')->sortBy('order') as $item)
                            <tr>
                                <td>{{ $item->order }}</td>
                                <td><img src="{{ asset('storage/'.$item->image) }}" style="width: 80px; border-radius: 5px;"></td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <div style="max-width: 200px; word-wrap: break-word;">
                                        {{ Str::limit($item->description, 255) }}
                                    </div>
                                </td>
                                <td>{!! $item->video ? '<span class="badge bg-primary">Ada</span>' : '-' !!}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-outline-warning" onclick="bukaModal('editModal{{$item->id}}')">Edit</button>
                                        <form action="{{ route('admin.data.kotaksaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-pop-up" id="modalTambahTeaser">
    <form action="{{ route('admin.data.kotaksaran.store') }}" method="POST" class="modal-content" enctype="multipart/form-data">
        @csrf <input type="hidden" name="section" value="teaser">
        <h6 class="fw-bold mb-3">Tambah Teaser</h6>
        <input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>
        <input type="text" name="icon" class="form-control mb-2" placeholder="Icon (Contoh: bi-star)">
        <img id="prevImgTeaser" class="preview-img">
        <input type="file" name="image" class="form-control mb-2" onchange="previewFile(this, 'prevImgTeaser')" required>
        <textarea name="description" class="form-control mb-2" placeholder="Deskripsi"></textarea>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary w-50" onclick="tutupModal('modalTambahTeaser')">Batal</button>
            <button type="submit" class="btn btn-success w-50">Simpan</button>
        </div>
    </form>
</div>

<div class="custom-pop-up" id="modalTambahHow">
    <form action="{{ route('admin.data.kotaksaran.store') }}" method="POST" class="modal-content" enctype="multipart/form-data">
        @csrf <input type="hidden" name="section" value="how_it_works">
        <h6 class="fw-bold mb-3">Tambah How It Works</h6>
        <input type="number" name="order" class="form-control mb-2" placeholder="No Urut" required>
        <input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>
        <img id="prevImgHow" class="preview-img">
        <input type="file" name="image" class="form-control mb-2" onchange="previewFile(this, 'prevImgHow')" required>
        <label class="small text-muted">Video (Opsional)</label>
        <input type="file" name="video" class="form-control mb-2" accept="video/*">
        <textarea name="description" class="form-control mb-2" placeholder="Deskripsi"></textarea>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary w-50" onclick="tutupModal('modalTambahHow')">Batal</button>
            <button type="submit" class="btn btn-success w-50">Simpan</button>
        </div>
    </form>
</div>

@foreach($items as $item)
<div class="custom-pop-up" id="editModal{{$item->id}}">
    <form action="{{ route('admin.data.kotaksaran.update', $item->id) }}" method="POST" class="modal-content" enctype="multipart/form-data">
        @csrf @method('PUT')
        <h6 class="fw-bold mb-3">Edit: {{ $item->title }}</h6>
        <input type="text" name="title" value="{{ $item->title }}" class="form-control mb-2">
        <img id="prevEdit{{$item->id}}" class="preview-img" style="display:block;" src="{{ asset('storage/'.$item->image) }}">
        <input type="file" name="image" class="form-control mb-2" onchange="previewFile(this, 'prevEdit{{$item->id}}')">
        @if($item->section == 'how_it_works')
            <input type="number" name="order" value="{{ $item->order }}" class="form-control mb-2">
            <input type="file" name="video" class="form-control mb-2" accept="video/*">
        @else
            <input type="text" name="icon" value="{{ $item->icon }}" class="form-control mb-2">
        @endif
        <textarea name="description" class="form-control mb-2">{{ $item->description }}</textarea>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary w-25" onclick="tutupModal('editModal{{$item->id}}')">Batal</button>
            <button type="submit" class="btn btn-success w-50">Update</button>
            <a href="#" class="btn btn-danger w-25" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('deleteForm{{$item->id}}').submit(); }">Hapus</a>
        </div>
    </form>
    <form id="deleteForm{{$item->id}}" action="{{ route('admin.data.kotaksaran.destroy', $item->id) }}" method="POST" style="display:none;">
        @csrf @method('DELETE')
    </form>
</div>
@endforeach

<script>
    function switchTab(tabId, btnId, el) {
        localStorage.setItem('activeTab', tabId);
        localStorage.setItem('activeBtn', btnId);

        document.querySelectorAll('.tab-pane').forEach(t => t.style.display = 'none');
        document.querySelectorAll('.btn-tambah').forEach(b => b.style.display = 'none');
        document.querySelectorAll('.nav-link').forEach(n => n.classList.remove('active'));

        document.getElementById(tabId).style.display = 'block';
        document.getElementById(btnId).style.display = 'inline-block';
        el.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const savedTab = localStorage.getItem('activeTab');
        const savedBtn = localStorage.getItem('activeBtn');

        if (savedTab && savedBtn) {
            const targetBtn = document.getElementById(savedTab === 'tab-teaser' ? 'link-teaser' : 'link-how');
            if (targetBtn) targetBtn.click();
        } else {
            document.getElementById('link-teaser').click();
        }
    });

    function previewFile(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => { 
                const el = document.getElementById(id);
                el.src = e.target.result; 
                el.style.display = 'block'; 
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function bukaModal(id) { document.getElementById(id).classList.add('active'); }
    function tutupModal(id) { document.getElementById(id).classList.remove('active'); }
</script>
@endsection