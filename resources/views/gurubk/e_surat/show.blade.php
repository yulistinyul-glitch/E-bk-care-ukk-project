@extends('gurubk.layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-lg border-0 rounded-4 p-5">

        <div class="text-center mb-4">
            <h4 class="fw-bold">SURAT RESMI</h4>
            <hr>
        </div>

        <p><strong>Nomor Surat :</strong> {{ $surat->nomor_surat_resmi }}</p>
        <p><strong>Tanggal :</strong> {{ $surat->tanggal_terbit }}</p>

        <br>

        <p>
            Yang bertanda tangan di bawah ini, Guru BK menyatakan bahwa:
        </p>

        <p><strong>Nama Siswa :</strong> {{ $surat->siswa->nama }}</p>

        <br>

        <p>
            {{ $surat->keterangan_tambahan }}
        </p>

        <br><br>

        <div class="text-end">
            <p>Guru BK,</p>
            <br><br><br>
            <p><strong>{{ $surat->gurubk->nama }}</strong></p>
        </div>

    </div>

</div>
@endsection
