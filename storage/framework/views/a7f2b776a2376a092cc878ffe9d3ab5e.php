<!DOCTYPE html>
<html>
<head>
    <title>Pemberitahuan Surat Peringatan</title>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #f8f9fa; padding: 10px; text-align: center; border-bottom: 3px solid #10b981; }
        .content { margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pemberitahuan Surat Peringatan</h2>
        </div>
        <div class="content">
            <p>Halo Bapak/Ibu <strong><?php echo e($surat->siswa->kelas->walikelas->nama_guru ?? 'Wali Kelas'); ?></strong>,</p>
            
            <p>Melalui email ini, kami menginformasikan bahwa telah diterbitkan <strong>Surat Peringatan (SP)</strong> untuk siswa berikut:</p>
            
            <table style="width: 100%;">
                <tr>
                    <td style="width: 150px;">Nama Siswa</td>
                    <td>: <strong><?php echo e($surat->siswa->nama_siswa); ?></strong></td>
                </tr>
                <tr>
                    <td>NIPD</td>
                    <td>: <?php echo e($surat->siswa->NIPD); ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: <?php echo e($surat->siswa->kelas->nama_lengkap); ?></td>
                </tr>
                <tr>
                    <td>Nomor Surat</td>
                    <td>: <?php echo e($surat->nomor_surat_resmi); ?></td>
                </tr>
                <tr>
                    <td>Alasan</td>
                    <td>: <?php echo e($surat->keterangan_tambahan); ?></td>
                </tr>
            </table>

            <p>Detail surat resmi telah dilampirkan dalam format PDF pada email ini. Mohon untuk ditindaklanjuti sesuai dengan prosedur yang berlaku.</p>
            
            <p>Terima kasih,<br><strong>Guru BK - Sistem E-Surat</strong></p>
        </div>
        <div class="footer">
            <p>Ini adalah email otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/emails/surat_walikelas.blade.php ENDPATH**/ ?>