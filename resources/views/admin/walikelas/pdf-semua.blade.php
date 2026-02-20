<!DOCTYPE html>
<html>
<head>
    <title>Daftar Walikelas</title>
    <style>
        @page { size: A4; margin: 15mm 10mm; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; margin: 0; }
        h3, h4 { text-align: center; margin: 0; }
        .header-sekolah { text-align: center; margin-bottom: 5px; }
        hr { border: 1px solid black; margin: 5px 0 10px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        th, td { border: 1px solid black; padding: 5px; font-size: 9px; text-align: center; }
        th { background: #f0f0f0; }
        td.text-left { text-align: left; }
    </style>
</head>
<body>

<div class="header-sekolah">
    <h3>SEKOLAH MENENGAH KEJURUAN BUDI BAKTI CIWIDEY</h3>
    <div>Jl. Contoh Alamat No. 123 Ciwidey<br>Telp: (022) 1234567</div>
</div>

<hr>

<h4>DAFTAR WALIKELAS</h4>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID Walikelas</th>
            <th>Kelas</th>
            <th>NIP</th>
            <th>Nama Lengkap</th>
            <th>JK</th>
            <th>No.Telp</th>
            <th>Email</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($walikelas as $index => $wk)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $wk->id_walikelas }}</td>
            <td>{{ $wk->kelas?->nama_lengkap ?? '-' }}</td>
            <td>{{ $wk->NIP }}</td>
            <td class="text-left">{{ $wk->nama_guru }}</td>
            <td>{{ $wk->JK }}</td>
            <td>{{ $wk->no_telp }}</td>
            <td>{{ $wk->email ?? '-' }}</td>
            <td class="text-left">{{ $wk->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br><br>

<table style="width:100%; border:none;">
    <tr>
        <td style="width:60%; border:none;"></td>
        <td style="text-align:center; border:none;">
            Ciwidey, {{ date('d-m-Y') }}<br>
            Kepala Sekolah<br><br><br><br>
            <u>________________________</u>
        </td>
    </tr>
</table>

</body>
</html>
