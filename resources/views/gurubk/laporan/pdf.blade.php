<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan {{ env('APP_NAME') }}</title>
    <style>
        @page { margin: 1.2cm; }
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 11px; 
            color: #111; 
            line-height: 1.5; 
            margin: 0;
        }
        
        .header-box {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header-box .title { 
            font-size: 20px; 
            font-weight: bold; 
            text-transform: uppercase;
            margin: 0;
            color: #000;
        }
        .header-box .school-name { 
            font-size: 17px; 
            font-weight: bold; 
            margin: 2px 0;
            text-transform: uppercase;
        }
        .header-box .address { 
            font-size: 10px; 
            margin-bottom: 5px;
        }
        .header-box .periode { 
            margin-top: 10px;
            font-size: 12px;
            font-weight: bold;
            display: block;
            text-decoration: underline;
        }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; table-layout: fixed; }
        th { 
            background-color: #f2f2f2; 
            color: #000; 
            font-weight: bold; 
            text-transform: uppercase; 
            font-size: 10px; 
            border: 1px solid #000; 
            padding: 8px; 
        }
        td { border: 1px solid #000; padding: 7px; vertical-align: top; word-wrap: break-word; }
        
        .section-title { 
            font-weight: bold; 
            font-size: 12px; 
            margin-bottom: 10px; 
            color: #000; 
            background: #e9ecef; 
            padding: 6px 10px; 
            border: 1px solid #000;
        }
        .text-center { text-align: center; }
        
        .poin-penting { color: #dc2626; font-weight: bold; font-size: 12px; }
        .poin-biasa { color: #000; }

        .status-berat { color: #dc2626; font-weight: bold; text-decoration: underline; }
        .status-sedang { color: #d97706; font-weight: bold; }
        .status-ringan { color: #0891b2; font-weight: bold; }
        
        .status-menunggu { background-color: #fef3c7; color: #92400e; padding: 2px 4px; border: 1px solid #f59e0b; font-weight: bold; }
        .status-disetujui { color: #059669; font-weight: bold; }

        .sp-text { color: #dc2626; font-weight: bold; font-style: italic; display: block; margin-top: 4px; font-size: 9px; border: 1px dashed #dc2626; padding: 2px; text-align: center; }
        .italic-muted { font-style: italic; color: #444; }

        .ttd-container { margin-top: 40px; width: 100%; }
        .ttd-table { border: none !important; }
        .ttd-table td { border: none !important; padding: 0; vertical-align: bottom; }
    </style>
</head>
<body>

    <div class="header-box">
        <div class="title">LAPORAN BULANAN {{ env('APP_NAME') }}</div>
        <div class="school-name">{{ env('APP_FOOTER') }}</div>
        <div class="address">
            Jl. Pasirjambu No.KB 10, Pasirjambu, Kec. Pasirjambu, Kab. Bandung, Jawa Barat<br>
            Email: smkbudibakticiwidey@gmail.com | Telp: (022) 5928122
        </div>
        <div class="periode">Periode: {{ \Carbon\Carbon::parse($laporan->bulan)->translatedFormat('F Y') }}</div>
    </div>

    <div class="section-title">1. Rincian Pelanggaran Siswa & Status E-SP</div>
    <table>
        <thead>
            <tr>
                <th style="width: 25px;">No</th>
                <th style="width: 75px;">Tanggal</th>
                <th style="width: 120px;">Nama Siswa (Kelas)</th>
                <th>Jenis Pelanggaran & Kategori</th>
                <th style="width: 40px;">Poin</th>
                <th style="width: 65px;">Status</th>
                <th>Keterangan / SP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detail_pelanggaran as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d/m/Y') }}</td>
                <td>
                    <b>{{ $item->siswa->nama_siswa ?? 'N/A' }}</b><br>
                    <small>{{ $item->siswa->kelas->nama_lengkap ?? '' }}</small>
                </td>
                <td>
                    {{ $item->pelanggaran->nama_pelanggaran ?? 'Pelanggaran Umum' }}<br>
                    <small class="italic-muted">Kategori: {{ $item->pelanggaran->kategori_pelanggaran ?? '-' }}</small>
                </td>
                <td class="text-center">
                    <span class="{{ $item->poin >= 50 ? 'poin-penting' : 'poin-biasa' }}">
                        {{ $item->poin }}
                    </span>
                </td>
                <td class="text-center">
                    @if($item->poin >= 50)
                        <span class="status-berat">BERAT</span>
                    @elseif($item->poin >= 25)
                        <span class="status-sedang">SEDANG</span>
                    @else
                        <span class="status-ringan">RINGAN</span>
                    @endif
                </td>
                <td>
                    {{ $item->keterangan ?? '-' }}
                    @if($item->poin >= 50)
                        <span class="sp-text">REKOMENDASI TERBIT E-SP</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center italic-muted">Tidak ada data pelanggaran bulan ini</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">2. Masukan & Kotak Saran Siswa</div>
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 80px;">Tanggal</th>
                <th style="width: 110px;">Pengirim</th>
                <th style="width: 100px;">Target</th>
                <th>Isi Pesan / Saran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detail_saran as $key => $saran)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ $saran->created_at->format('d/m/Y') }}</td>
                <td>{{ $saran->is_anonymous ? 'Anonim' : ($saran->siswa->nama_siswa ?? 'Siswa') }}</td>
                <td class="text-center"><b>{{ strtoupper($saran->target) }}</b></td>
                <td><em>"{{ $saran->message }}"</em></td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center italic-muted">Tidak ada saran masuk bulan ini</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">3. Ringkasan Laporan Mandiri Siswa (Self Report)</div>
    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 100px;">ID Laporan</th>
                <th style="width: 120px;">Tanggal Lapor</th>
                <th>Kategori Masalah</th>
                <th style="width: 100px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detail_selfreport as $key => $report)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center"><b>#{{ $report->id_report }}</b></td>
                <td class="text-center">{{ \Carbon\Carbon::parse($report->tanggal_lapor)->format('d/m/Y') }}</td>
                <td><b>{{ $report->kategori_masalah }}</b></td>
                <td class="text-center">
                    @if(strtolower($report->status) == 'menunggu' || !$report->status)
                        <span class="status-menunggu">MENUNGGU</span>
                    @else
                        <span class="status-disetujui">{{ strtoupper($report->status) }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center italic-muted">Tidak ada laporan mandiri bulan ini</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">4. Ringkasan Statistik Akhir Bulanan</div>
    <table style="width: 50%;">
        <tr>
            <td style="background: #f2f2f2; font-weight: bold;">Total Siswa Melanggar</td>
            <td class="text-center"><b>{{ $laporan->total_pelanggaran }}</b></td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; font-weight: bold;">Total Kotak Saran</td>
            <td class="text-center"><b>{{ $laporan->total_saran }}</b></td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; font-weight: bold;">Total Self Report</td>
            <td class="text-center"><b>{{ $laporan->total_selfreport }}</b></td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; font-weight: bold;">Total Konseling Terlaksana</td>
            <td class="text-center"><b>{{ $laporan->total_konseling }}</b></td>
        </tr>
    </table>

    <div class="ttd-container">
        <table class="ttd-table">
            <tr>
                <td style="width: 40%;">
                    <small class="italic-muted">
                        Dicetak otomatis oleh Sistem {{ env('APP_NAME') }}<br>
                        Tanggal cetak: {{ date('d/m/Y H:i') }}
                    </small>
                </td>
                <td style="width: 20%;"></td>
                <td style="width: 40%;" class="text-center">
                    Ciwidey, {{ date('d F Y') }}<br>
                    Guru Bimbingan Konseling,<br><br><br><br><br>
                    <strong><u>( ............................................ )</u></strong><br>
                    {{ env('APP_FOOTER') }}
                </td>
            </tr>
        </table>
    </div>

</body>
</html>