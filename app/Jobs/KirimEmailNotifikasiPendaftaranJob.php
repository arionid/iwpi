<?php

namespace App\Jobs;

use App\Mail\VerifikasiPendaftaranMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

class KirimEmailNotifikasiPendaftaranJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $offerData;

    public function __construct($msg)
    {
        $this->queue = 'default';
        $this->offerData = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = new VerifikasiPendaftaranMail($this->offerData);
        Mail::to($this->offerData->email)->send($data);
    }
}
