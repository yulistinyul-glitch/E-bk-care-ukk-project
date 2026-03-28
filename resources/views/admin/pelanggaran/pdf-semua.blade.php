<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Daftar Pelanggaran</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 10mm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            margin: 0;
            color: #333;
        }

        .header-sekolah {
            text-align: center;
            margin-bottom: 5px;
        }

        .header-sekolah h3 {
            margin: 0;
            text-transform: uppercase;
            font-size: 14px;
        }

        hr {
            border: 1px solid black;
            margin: 5px 0 15px 0;
        }

        h4 {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #f0f0f0;
            color: black;
            padding: 8px 4px;
            text-align: center;
            text-transform: uppercase;
            font-size: 9px;
            border: 1px solid black;
        }

        td {
            border: 1px solid black;
            padding: 7px;
            vertical-align: middle;
            font-size: 9px;
        }

        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        
        /* Warna untuk Tingkatan */
        .ringan { color: #2d6a4f; }
        .sedang { color: #d97706; }
        .berat { color: #dc2626; font-weight: bold; }

        .no-border td {
            border: none;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 8pt;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="header-sekolah">
        <h3>SEKOLAH MENENGAH KEJURUAN BUDI BAKTI CIWIDEY</h3>
        <div style="font-size: 10px;">
            Jl. Contoh Alamat No. 123 Ciwidey<br>
            Telp: (022) 1234567
        </div>
    </div>

    <hr>

    <h4>DAFTAR KRITERIA PELANGGARAN & POIN SISWA</h4>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">ID</th>
                <th width="20%">Kategori</th>
                <th>Jenis Kegiatan / Pelanggaran</th>
                <th width="8%">Poin</th>
                <th width="12%">Tingkatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelanggaran as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center font-bold">{{ $item->id_pelanggaran }}</td>
                <td>{{ $item->kategori_pelanggaran }}</td>
                <td>{{ $item->jenis_kegiatan }}</td>
                <td class="text-center font-bold">{{ $item->poin_pelanggaran }}</td>
                <td class="text-center">
                    <span class="{{ $item->tingkatan }}">{{ ucfirst($item->tingkatan) }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <table class="no-border">
        <tr>
            <td style="width:60%;">
                <div class="footer-note">
                    * Dokumen ini dicetak otomatis melalui Sistem Informasi Poin Pelanggaran<br>
                    Waktu Cetak: {{ date('d-m-Y H:i') }}
                </div>
            </td>
            <td style="text-align:center;">
                Ciwidey, {{ date('d-m-Y') }}<br>
                Kesiswaan,<br><br><br><br><br>
                <strong>( __________________________ )</strong>
            </td>
        </tr>
    </table>

</body>
</html>