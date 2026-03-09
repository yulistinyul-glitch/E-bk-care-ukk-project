@extends('admin.layouts.app')

@section('content')
<style>
    .poppins-font { font-family: 'Poppins', sans-serif !important; }
    .panel-wrapper { background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .table-as-form { border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; width: 100%; }
    .table-as-form th { background: #f8f9fa; color: #495057; font-weight: 600; padding: 12px; }
    .table-as-form td { padding: 12px; vertical-align: middle; } 
    .desc-cell { max-width: 400px; word-wrap: break-word; white-space: normal; }
    .header-row { display: flex; align-items: center; justify-content: center; padding: 5px 0; }
    .btn-sm-edit {padding: 4px 18px; line-height: 1.5;border-radius: 6px;}
    .btn-container { display: flex; justify-content: flex-end; margin-top: 15px; }
    .custom-pop-up { display: flex; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: all 0.3s ease-in-out; }
    .custom-pop-up.active { opacity: 1; visibility: visible; }
    .custom-pop-up .modal-dialog { width: 90%; max-width: 500px; }
    .custom-pop-up .modal-content { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
</style>

<div class="container-fluid poppins-font">
    <div class="panel-wrapper shadow">
        <table class="table table-bordered table-as-form">
            <thead>
                <tr>
                    <th colspan="4">
                        <div class="header-row mb-4">
                            <span class="h4 m-0" style="font-weight: 600;">Daftar Fitur Layanan</span>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Judul</th> <th>Icon</th> <th>Deskripsi</th> <th style="width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($semua_layanan as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td><i class="bi {{ $item->icon }}"></i></td>
                    <td class="desc-cell">{{ $item->description }}</td>
                    <td>
                        <button class="btn btn-outline-warning btn-sm-edit" onclick="bukaModal('editModal{{$item->id}}')">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach($semua_layanan as $item)
<div class="custom-pop-up" id="editModal{{$item->id}}">
    <div class="modal-dialog">
        <form action="{{ route('admin.layanan.update', $item->id) }}" method="POST" class="modal-content">
            @csrf @method('PUT')
            <h5>Edit Layanan</h5>
            <input type="text" name="title" value="{{ $item->title }}" class="form-control mb-2" required>
            <input type="text" name="icon" value="{{ $item->icon }}" class="form-control mb-2" required>
            <textarea name="description" class="form-control mb-2" rows="3" required>{{ $item->description }}</textarea>
            <div class="btn-container">
                <button type="button" class="btn btn-sm btn-secondary me-2" onclick="tutupModal('editModal{{$item->id}}')">Batal</button>
                <button type="submit" class="btn btn-sm btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
    function bukaModal(id) { document.getElementById(id).classList.add('active'); }
    function tutupModal(id) { document.getElementById(id).classList.remove('active'); }
    window.onclick = function(event) { if (event.target.classList.contains('custom-pop-up')) tutupModal(event.target.id); }
</script>
@endsection