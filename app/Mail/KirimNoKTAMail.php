<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimNoKTAMail extends Mailable
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
        $this->subject = 'Pendaftaran Anggota Kehormatan IWPI';
        $this->offerData = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('admin@iwpi.info', 'Ikatan Wajib Pajak')
        ->markdown('vendor.mail.kirim-kartu-anggota-kehormatan', [
                    'data' => $this->offerData,
                ])
        ->attach(config('nnd.link-online').($this->offerData->kta_files), [
            'as' => 'KTA-KEHORMATAN-IWPI.png',
            'mime' => 'image/png'
        ]);
    }
}
