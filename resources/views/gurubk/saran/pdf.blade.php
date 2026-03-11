<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kotak Saran</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        
        /* Gaya Kop Surat */
        .kop-surat { position: relative; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-sekolah { position: absolute; left: 0; top: 0; width: 80px; }
        .judul-kop { text-align: center; margin-left: 50px; }
        .judul-kop h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .judul-kop h1 { margin: 0; font-size: 22px; color: #1a4a8e; }
        .judul-kop p { margin: 2px 0; font-size: 10px; font-style: italic; }

        /* Gaya Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #1a4a8e; color: white; padding: 10px; text-transform: uppercase; font-size: 10px; }
        td { border: 1px solid #ccc; padding: 8px; vertical-align: top; }
        tr:nth-child(even) { background-color: #f9f9f9; }

        .footer-ttd { margin-top: 40px; float: right; width: 200px; text-align: center; }
        .space-ttd { height: 70px; }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{asset('img/logo_ebk-careGold.png')}}" class="logo-sekolah">
        <div class="judul-kop">
            <h2>PEMERINTAH PROVINSI JAWA BARAT</h2>
            <h1>SMK NEGERI VENUS VAULT</h1>
            <p>Jl. Venus Raya No. 123, Venus City | Telp: (021) 123456 | Website: www.venusvault.sch.id</p>
            <p>Email: info@venusvault.sch.id | Kode Pos: 40123</p>
        </div>
        <img src="{{asset('img/logo-ebkCare.png')}}" alt="" class="logo-sekolah">
    </div>

    <h3 style="text-align: center; text-decoration: underline;">LAPORAN REKAPITULASI SARAN & KRITIK SISWA</h3>
    <p style="text-align: center; margin-top: -10px;">Periode: {{ request('tanggal') ?? 'Semua Waktu' }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Nama Siswa</th>
                <th width="15%">Target</th>
                <th width="45%">Pesan/Saran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($saran as $key => $item)
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
                <td>{{ $item->is_anonymous ? 'Anonim' : ($item->siswa->nama_siswa ?? 'Siswa Tidak Ditemukan') }}</td>
                <td>{{ $item->target }}</td>
                <td>{{ $item->message }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" align="center">Tidak ada data saran ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-ttd">
        <p>Bandung, {{ date('d F Y') }}</p>
        <p>Guru Bimbingan Konseling,</p>
        <div class="space-ttd"></div>
        <p><strong>( ____________________ )</strong></p>
        <p>NIP. ...........................</p>
    </div>
</body>
</html>