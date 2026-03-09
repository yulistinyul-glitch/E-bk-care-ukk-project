<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Daftar Pelanggaran</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 9pt; color: #666; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #4a5568; color: white; padding: 10px 5px; text-align: center; text-transform: uppercase; font-size: 9pt; }
        td { border: 1px solid #ccc; padding: 8px; vertical-align: middle; }
        
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        
        /* Pewarnaan Tingkatan */
        .ringan { color: #2d6a4f; }
        .sedang { color: #d97706; }
        .berat { color: #dc2626; font-weight: bold; }

        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 8pt; color: #999; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Daftar Kriteria Pelanggaran & Poin</h2>
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>

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

    <div class="footer">
        Halaman 1 dari 1 - Sistem Informasi Point Pelanggaran
    </div>

</body>
</html>