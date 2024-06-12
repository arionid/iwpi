<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifikasiPendaftaranMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $offerData;
    public $subject;

    public function __construct($msg)
    {
        $this->subject = 'Verifikasi Pendaftaran Anggota Baru';
        $this->offerData = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $body = [
            'nama'  => $this->offerData->fullname,
            'npwp'  => $this->offerData->npwp,
            'tagihan'  => "Rp.".\number_format($this->offerData->detail->layanan_nominal),
        ];

        return $this->from('admin@iwpi.info', 'Ikatan Wajib Pajak')
        ->markdown('vendor.mail.verifikasianggota', [
                    'data' => $body,
                ]);
    }
}
