@extends('gurubk.layouts.app')

@section('title', 'Pelanggaran Siswa')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
.header-title{font-size:24px;font-weight:700;color:#1a1a1a;margin-bottom:5px;}
.header-subtitle{font-size:13px;color:#71717a;margin-bottom:25px;}

.btn-catat{
background-color:#5d5fef;
color:white;
padding:9px 18px;
border-radius:10px;
font-weight:600;
font-size:13px;
text-decoration:none;
transition:0.3s;
box-shadow:0 4px 12px rgba(93,95,239,0.2);
display:inline-flex;
align-items:center;
gap:8px;
}
.btn-catat:hover{background:#4a4cd9;color:white;transform:translateY(-2px);}

.filter-wrapper{display:flex;gap:10px;align-items:center;margin-bottom:20px;flex-wrap:wrap;}

.search-container{position:relative;width:100%;max-width:300px;}
.search-input{
width:100%;
padding:9px 15px 9px 40px;
border-radius:10px;
border:1px solid #e2e8f0;
font-size:13px;
outline:none;
transition:0.3s;
}
.search-input:focus{border-color:#4f46e5;box-shadow:0 0 0 3px rgba(79,70,229,0.1);}

.icon-search{
position:absolute;
left:14px;
top:50%;
transform:translateY(-50%);
color:#94a3b8;
font-size:15px;
}

.select-kelas{
padding:9px 12px;
border-radius:10px;
border:1px solid #e2e8f0;
background:white;
font-size:13px;
color:#475569;
outline:none;
min-width:160px;
cursor:pointer;
}

.table-container{
background:white;
border-radius:14px;
padding:10px;
border:1px solid #f1f5f9;
box-shadow:0 4px 15px rgba(0,0,0,0.02);
overflow:visible !important;
}

.table thead th{
background:#f8fafc;
border:none;
font-size:11px;
color:#64748b;
text-transform:uppercase;
letter-spacing:0.05em;
padding:14px;
}

.table tbody td{
padding:14px 12px;
border-bottom:1px solid #f1f5f9;
font-size:13px;
color:#334155;
}

.badge-poin{
background:#fff5f5;
color:#ff4757;
font-weight:700;
padding:4px 10px;
border-radius:6px;
font-size:12px;
border:1px solid #ffe4e6;
}

.badge-status{font-size:10px;font-weight:600;padding:5px 12px;}

.btn-action{
width:32px;
height:32px;
display:inline-flex;
align-items:center;
justify-content:center;
border-radius:8px;
transition:0.2s;
border:none;
font-size:14px;
text-decoration:none;
cursor:pointer;
}

.btn-show{background:#eef2ff;color:#4f46e5;}
.btn-edit{background:#fffbeb;color:#d97706;}
.btn-delete{background:#fef2f2;color:#dc2626;}

.btn-action:hover{transform:translateY(-2px);filter:brightness(0.95);}

.modal-backdrop.show{
backdrop-filter:blur(8px);
background:rgba(0,0,0,0.4);
}

.modal.fade .modal-dialog{
transform:translateY(-50px);
transition:transform .3s ease-out;
}

.modal.show .modal-dialog{transform:translateY(0);}

.modal{z-index:2000 !important;}
.modal-backdrop{z-index:1990 !important;}

.modal-content{
border-radius:20px;
border:none;
box-shadow:0 10px 40px rgba(0,0,0,0.1);
animation:modalFade .25s ease;
}

@keyframes modalFade{
from{opacity:0;transform:scale(.95);}
to{opacity:1;transform:scale(1);}
}

.modal-detail-label{font-size:12px;color:#94a3b8;font-weight:500;margin-bottom:2px;}
.modal-detail-value{font-size:14px;color:#1e293b;font-weight:600;margin-bottom:15px;}

.empty-state{padding:60px 0;color:#94a3b8;font-size:13px;}

/* Custom Photo Preview */
.photo-container {
    background: #f8fafc;
    border-radius: 12px;
    border: 2px dashed #e2e8f0;
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.photo-container img {
    max-width: 100%;
    max-height: 300px;
    object-fit: contain;
}
</style>


<div class="d-flex justify-content-between align-items-start mb-2">
<div>
<h4 class="header-title">Pelanggaran Siswa</h4>
<p class="header-subtitle">Pantau dan kelola catatan pelanggaran siswa secara real-time.</p>
</div>

<a href="{{ route('gurubk.riwayatpelanggaran.create') }}" class="btn-catat">
<i class="bi bi-plus-lg"></i> Catat Pelanggaran
</a>
</div>


@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center" style="border-radius:12px;font-size:13px;">
<i class="bi bi-check-circle-fill me-2 fs-5"></i>
{{ session('success') }}
</div>
@endif


<form action="{{ route('gurubk.riwayatpelanggaran.index') }}" method="GET" class="filter-wrapper">

<div class="search-container">
<i class="bi bi-search icon-search"></i>
<input type="text" name="search" class="search-input"
placeholder="Cari nama atau pelanggaran..."
value="{{ request('search') }}">
</div>

<select name="id_kelas" class="select-kelas" onchange="this.form.submit()">
<option value="">-- Semua Kelas --</option>

@foreach($kelas as $k)
<option value="{{ $k->id_kelas }}" {{ request('id_kelas')==$k->id_kelas?'selected':'' }}>
{{ $k->nama_kelas }} {{ $k->jurusan }}
</option>
@endforeach

</select>

@if(request('search')||request('id_kelas'))
<a href="{{ route('gurubk.riwayatpelanggaran.index') }}" class="text-decoration-none text-muted small ms-2">
<i class="bi bi-x-circle"></i> Reset Filter
</a>
@endif

</form>


<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $index => $r)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($r->tanggal_kejadian)->format('d/m/Y') }}</td>
                    <td class="fw-bold text-dark text-start">{{ $r->siswa->nama_siswa }}</td>
                    <td>{{ $r->siswa->kelas->nama_lengkap }}</td>
                    <td class="text-start">{{ $r->pelanggaran->jenis_kegiatan }}</td>
                    <td><span class="badge-poin">{{ $r->poin }}</span></td>
                    <td>
                        <span class="badge {{ $r->status == 'Ringan' ? 'bg-info' : ($r->status == 'Sedang' ? 'bg-warning' : 'bg-danger') }} rounded-pill">
                            {{ $r->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-light rounded-pill"><i class="bi bi-three-dots"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="bi bi-folder2-open" style="font-size: 48px;"></i>
                        <p class="mt-3 mb-0 text-dark fw-bold">Belum ada data tersedia.</p>
                        <small>Data akan muncul setelah anda menginput pelanggaran baru.</small>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded',function(){
    const modal=document.getElementById('modalDetail')
    document.body.appendChild(modal)

    modal.addEventListener('show.bs.modal',function(event){
        const button=event.relatedTarget

        // Isi Data Teks
        document.getElementById('md-siswa').textContent=button.getAttribute('data-siswa')
        document.getElementById('md-kelas').textContent=button.getAttribute('data-kelas')
        document.getElementById('md-jenis').textContent=button.getAttribute('data-jenis')
        document.getElementById('md-kategori').textContent=button.getAttribute('data-kategori')
        document.getElementById('md-tanggal').textContent=button.getAttribute('data-tanggal')
        document.getElementById('md-keterangan').textContent=button.getAttribute('data-keterangan')
        document.getElementById('md-poin').textContent=button.getAttribute('data-poin')+" Poin"

        // Status Badge
        let status=button.getAttribute('data-status')
        let badge="bg-info"
        if(status==="Sedang") badge="bg-warning"
        if(status==="Berat") badge="bg-danger"
        document.getElementById('md-status').innerHTML= `<span class="badge ${badge} rounded-pill badge-status">${status}</span>`

        // Logika Tampilkan Foto
        const fotoUrl = button.getAttribute('data-foto');
        const imgEl = document.getElementById('md-foto');
        const noFotoEl = document.getElementById('md-no-foto');

        if(fotoUrl && fotoUrl.length > 5) {
            imgEl.src = fotoUrl;
            imgEl.style.display = 'block';
            noFotoEl.style.display = 'none';
        } else {
            imgEl.style.display = 'none';
            noFotoEl.style.display = 'block';
        }
    })
})
</script>

@endsection