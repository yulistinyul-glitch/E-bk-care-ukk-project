{{-- @extends('gurubk.layouts.app')

@section('content')

<style>
    @page {
        size: A4;
        margin: 15mm 10mm;
    }

    body {
        font-size: 10px;
    }

    h3, h4 {
        text-align: center;
        margin: 0;
    }

    .header-sekolah {
        text-align: center;
        margin-bottom: 5px;
    }

    hr {
        border: 1px solid black;
        margin: 5px 0 10px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    th, td {
        border: 1px solid black;
        padding: 4px;
        font-size: 9px;
        text-align: center;
    }

    th {
        background: #f0f0f0;
    }

    td.text-left {
        text-align: left;
    }

    .no-border td {
        border: none !important;
    }

    .page-break {
        page-break-after: always;
    }

    @media print {
        .sidebar,
        .main-sidebar,
        .navbar,
        .topbar,
        .no-print {
            display: none !important;
        }

        body {
            margin: 0;
        }

        .content-wrapper,
        .main-content,
        .container,
        .container-fluid {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
    }
</style>

<div id="area-cetak">

@foreach($kelasList->sortBy('id_kelas') as $kelas)
    <div class="header-sekolah">
        <h3>SEKOLAH MENENGAH KEJURUAN BUDI BAKTI CIWIDEY</h3>
        <div>
            Jl. Contoh Alamat No. 123 Ciwidey<br>
            Telp: (022) 1234567
        </div>
    </div>

    <hr>

    <h4>DAFTAR SISWA KELAS {{ strtoupper($kelas->nama_lengkap) }}</h4>
    <table>
        <thead>
            <tr>
                <th style="width:25px;">No</th>
                <th style="width:70px;">NIPD</th>
                <th style="width:70px;">NISN</th>
                <th style="width:110px;">Nama</th>
                <th style="width:30px;">JK</th>
                <th style="width:110px;">TTL</th>
                <th style="width:80px;">No HP</th>
                <th style="width:120px;">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas->siswa as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->NIPD }}</td>
                <td>{{ $s->NISN }}</td>
                <td class="text-left">{{ $s->nama_siswa }}</td>
                <td>{{ $s->JK }}</td>
                <td class="text-left">
                    {{ $s->tempat_lahir }}, {{ $s->tanggal_lahir }}
                </td>
                <td>{{ $s->no_telp }}</td>
                <td class="text-left">{{ $s->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <table class="no-border">
        <tr>
            <td style="width:60%;"></td>
            <td style="text-align:center;">
                Ciwidey, {{ date('d-m-Y') }}<br>
                Wali Kelas<br><br><br><br>
                <u>{{ $kelas->walikelas?->nama_guru ?? '-' }}</u>
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

@endforeach

</div>

<script>
    window.onload = function() {
        window.print();
    }
</script>

@endsection --}}
