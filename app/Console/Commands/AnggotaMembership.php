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
    protected $signature = 'membership:update';

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
        $today = Carbon::now()->format('Y-m-d');
        $anggotaIwpi =AnggotaIWPI::where('status', '!=', 'Menunggu Pembayaran')->whereDate('tgl_akhir', '<=', $today)->get();
        //  $anggotaIwpi =AnggotaIWPI::where('pendaftaran_id','27')->get();

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
                $paymentDetail->expired_at = Carbon::now()->addHours(24);
                $paymentDetail->save();

                // SEND NOTIF EMAIL /WHATSAPP
                $user = PendaftaranAnggota::with(['detail','payment_detail'])->where('id', $item->pendaftaran_id)->first();
                KirimNotifPerpanjangan::dispatch($user, $midtrans->payment_url)->delay(now()->addSeconds(5));
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                Log::error($th->getMessage());
            }
        }

        fLogs('Layanan membership up-todate', 's');
        return 0;
    }
}
