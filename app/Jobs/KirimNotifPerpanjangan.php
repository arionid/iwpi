<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KirimNotifPerpanjangan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $auth;
    public $url;
    public $target;
    public $user;

    public function __construct($user, $payment_link)
    {
        $this->auth = env('FONNTE_TOKEN', 'nndproject');
        $this->url = env('FONNTE_URL', 'https://api.fonnte.com');


        $this->user = $user;
        $this->target = $user->phone.'|'.$user->fullname.'|'.Carbon::parse($user->date_active)->format('d/m/Y').'|'.$payment_link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $message = "Halo {name}\nPemberitahuan, Layanan Membership di IWPI.info *Ikatan Wajib Pajak Indonesia* telah berakhir pada *{var1}*,Berikut kami sertakan link pembayaran untuk perpanjangan Membership selama 1 tahun ke depan.\n\nLink Pembayaran: *{var2}*\nlink diatas berlaku hingga 24jam dimulai saat pesan ini dikirim. \nJika pembayaran tidak dilakukan, anda akan dikeluarkan dari GRUP serta DIHAPUS dari keanggotaan Ikatan Wajib Pajak Indonesia dalam 2x24jam, \n\nSalam Hormat.\nIkatan Wajib Pajak Indonesia";
        $response = Http::withHeaders([
            'Authorization' => $this->auth,
        ])
        ->asForm()->post($this->url.'/send', [
                'target' => $this->target,
                'message' => $message,
                'delay' => '5'
        ]);

        if( $response->failed() ){
            Log::error('fonnte error');
        }

        return;
    }
}
