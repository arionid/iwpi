<?php

namespace App\Console\Commands;

use App\Jobs\KirimNotifPerpanjangan;
use App\Models\AnggotaIWPI;
use App\Models\HistoryMembership;
use App\Models\PaymentDetail;
use App\Models\PendaftaranAnggota;
use App\Traits\MidtransTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnggotaMembership extends Command
{

    use MidtransTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:update {--resend=} {--id=} {--force=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Data Membership and blasting Notifikasi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->option('force')){
            fLogs('Force resend whatsapp to member', 'i');
            $this->forceResend();
            return;
        }

        if($this->option('resend')){
            fLogs('Resend whatsapp to member', 'i');
            $this->resendWA($this->option('id'));
            return;
        }

        $today = Carbon::now()->format('Y-m-d');
        $anggotaIwpi =AnggotaIWPI::whereDate('tgl_akhir','<=', $today)
        ->where([['status','!=','Menunggu Pembayaran'], ['keterangan', '!=','Menunggu Pembayaran Perpanjangan Biaya Membership']])
        ->get();

        foreach ($anggotaIwpi as $item) {

            // MOVE DATA TO HISTORY DATA
            $checking = HistoryMembership::where([
                ['anggota_id', $item->pendaftaran_id],
                ['tgl_mulai', $item->tgl_mulai],
                ['tgl_akhir', $item->tgl_akhir],
                ['bukti_bayar', $item->bukti_bayar]
            ])->first();

            if(!$checking){
                fLogs('Layanan '.$item->layanan.' Member '.$item->nomor_anggota, 'e');
                $data = new HistoryMembership();
                $data->anggota_id = $item->pendaftaran_id;
                $data->tgl_mulai = $item->tgl_mulai;
                $data->tgl_akhir = $item->tgl_akhir;
                $data->bukti_bayar = $item->bukti_bayar;
                $data->status = 'expired';
                $data->save();
            }
            DB::beginTransaction();
            try {
                // SET DATABASE TO WAITING NEW PAYMENT PAYMENT & DEACTIVE ACCOUNT
                PendaftaranAnggota::where('id', $item->pendaftaran_id)->update([
                    'status' => 'Overdue',
                    'updated_at' => Carbon::now()
                ]);

                // Update data Anggota IWPI
                AnggotaIWPI::where('pendaftaran_id', $item->pendaftaran_id)->update([
                    'bukti_bayar' => null,
                    'nama_pengirim' => null,
                    'tgl_bayar' => null,
                    'keterangan' => 'Menunggu Pembayaran Perpanjangan Biaya Membership',
                    'status' => 'Menunggu Pembayaran',
                    'updated_at' => Carbon::now()
                ]);


                // hapus data payment_detail yang lama
                PaymentDetail::where('pendaftaran_id', $item->pendaftaran_id)->delete();

                // Add New Link Payement
                $anggota = AnggotaIWPI::where('pendaftaran_id', $item->pendaftaran_id)->first();
                $midtrans = $this->createPaymentLinkApi($anggota);
                $paymentDetail =  new PaymentDetail();
                $paymentDetail->pendaftaran_id = $item->pendaftaran_id;
                $paymentDetail->order_id = $midtrans->order_id;
                $paymentDetail->payment_link_id = $midtrans->payment_url;
                $paymentDetail->expired_at = Carbon::now()->addDay(3);
                $paymentDetail->save();

                // SEND NOTIF EMAIL /WHATSAPP
                $user = PendaftaranAnggota::with(['detail','payment_detail'])->where('id', $item->pendaftaran_id)->first();
                KirimNotifPerpanjangan::dispatch($user, $midtrans->payment_url)->delay(now()->addSeconds(5));
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                // throw $th;
                Log::error($th->getMessage());
            }
        }

        fLogs('Layanan membership up-todate', 's');
        return 0;
    }

    public function resendWA($user_id = false)
    {
        if($user_id) {
            $paymentDetail = PaymentDetail::where([['pendaftaran_id', $user_id], ['status', 'pending']])->orderBy('id', 'DESC')->first();
        }else{
            $paymentDetail = PaymentDetail::whereDate('created_at', '>', Carbon::today()->subDays(2))->where('status', 'pending')->get();
        }

        foreach ($paymentDetail as $item) {

            fLogs('Resend order-id: '.$item->order_id, 'i');
            try {
            $user = PendaftaranAnggota::with(['detail','payment_detail'])->where('id', $item->pendaftaran_id)->first();

            KirimNotifPerpanjangan::dispatch($user, $item->payment_link_id)->onQueue('default')->delay(now()->addSeconds(5));
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function forceResend(){
        $paymentDetail = PaymentDetail::whereDate('expired_at', '>', '2025-10-01')->whereDate('expired_at', '<', Carbon::today())->where('status', 'pending')->get();
        foreach ($paymentDetail as $key => $item) {
            fLogs('Force resend order-id: '.$item->order_id, 'i');
            try {
                if($key % 10 == 0){
                    sleep(5);
                }

                $user = PendaftaranAnggota::with(['detail'])->where('id', $item->pendaftaran_id)->first();
                $midtrans = $this->createPaymentLinkApi($user);
                PaymentDetail::where('id', $item->id)->update([
                    'order_id' => $midtrans->order_id,
                    'payment_link_id' => $midtrans->payment_url,
                    'expired_at' => Carbon::now()->addDay(3),
                    'updated_at' => Carbon::now()
                ]);

                KirimNotifPerpanjangan::dispatch($user, $midtrans->payment_url)->onQueue('default')->delay(now()->addSeconds(5));

            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }


}
