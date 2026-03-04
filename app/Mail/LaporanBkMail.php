<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class LaporanBKMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rincian;

    public function __construct($rincian)
    {
        $this->rincian = $rincian;
    }

    public function build()
    {
        $email = $this->subject($this->rincian['subjek'])
                      ->view('emails.surat_walikelas') // File blade di resources/views/emails/
                      ->with('surat', $this->rincian['surat']);

        // Cek apakah file PDF ada sebelum dilampirkan
        if (File::exists($this->rincian['pdf_path'])) {
            $email->attach($this->rincian['pdf_path'], [
                'as' => $this->rincian['nama_file'],
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}