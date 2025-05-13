<?php

namespace App\Console\Commands;

use App\Models\AnggotaIWPI;
use App\Models\PaymentDetail;
use App\Models\PendaftaranAnggota;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MemberUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:update {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $memberId = $this->option('id') ?? false;
        if(!$memberId){
            fLogs('member id empty','i');
            return false;
        }

        try {
            $pendaftaran = PendaftaranAnggota::where([['id',$memberId],['status','!=', 'Approve']])
            ->orderBy('id', 'desc')->first();
            if(!$pendaftaran) {
                return fLogs("member tersebut sudah aktif", 'e');
            }
            AnggotaIWPI::where('pendaftaran_id', $memberId)->update([
                'nomor_anggota' =>  $pendaftaran->village_id.".".sprintf( '%04d', $pendaftaran->id ),
                'status'    => 'Pembayaran Valid',
                'tgl_mulai' => Carbon::now(),
                'tgl_akhir' => Carbon::now()->addYear(),
                'keterangan'    => "Manual Update",
                'updated_at' => Carbon::now(),
            ]);

            PendaftaranAnggota::where('id', $memberId)->update([
                'status' => 'Approve',
                'date_active' => Carbon::now()->addYear(),
                'updated_at' => Carbon::now(),
            ]);
            return fLogs("success update member : ".$pendaftaran->fullname, 's');
        } catch (\Throwable $th) {
            throw $th;
        }

        return 0;
    }
}
