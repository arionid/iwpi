<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class nndproject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:bps {--type=prov}';

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
    public $client;
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client(['verify' => false, 'timeout' => 8.0]);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /* $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=provinsi');
            $res = $this->client->sendAsync($request)->wait();
            \fLogs("Ambil data kabupaten/kota di provinsi",'s');
            foreach (\json_decode($res->getBody()) as $valu) {
                fLogs("\tInsert Kabupaten/Kota ".$valu->nama_dagri, 'i');
                DB::connection('db_bps')->table('bridging_provinsi')->insert([
                    'kode_bps' => $valu->kode_bps,
                    'nama_bps'  => $valu->nama_bps,
                    'kode_dagri'  => $valu->kode_dagri,
                    'nama_dagri'  => $valu->nama_dagri
                ]);
            }
            return true;
            switch ($this->option('type')) {
            case 'kota':
                $db = DB::connection('db_bps')->table('bridging_provinsi')->orderBy('kode_bps', 'ASC')->get();
                $this->fDagriKabupaten($db);
                break;
            case 'kecamatan':
                $db = DB::connection('db_bps')->table('bridging_kabupaten')->orderBy('kode_bps', 'ASC')->get();
                $this->fDagriKecamatan($db);
                break;
            case 'kelurahan':
                $db = DB::connection('db_bps')->table('bridging_kecamatan')->orderBy('kode_bps', 'ASC')->get();
                $this->fDagriKelurahan($db);
                break;

            default:
                    $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=provinsi');
                    $res = $this->client->sendAsync($request)->wait();
                    \fLogs("Ambil data kabupaten/kota di provinsi",'s');
                    foreach (\json_decode($res->getBody()) as $valu) {
                        fLogs("\tInsert Kabupaten/Kota ".$valu->nama_dagri, 'i');
                        DB::connection('db_bps')->table('bridging_provinsi')->insert([
                            'kode_bps' => $valu->kode_bps,
                            'nama_bps'  => $valu->nama_bps,
                            'kode_dagri'  => $valu->kode_dagri,
                            'nama_dagri'  => $valu->nama_dagri
                        ]);
                    }

                break;
        }
                */

    }

    function fDagriKabupaten($provinsi) {
        foreach ($provinsi as $item) {
            $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=kabupaten&parent='.$item->kode_bps);
            $res = $this->client->sendAsync($request)->wait();
            \fLogs("Ambil data KEMENDAGRI kabupaten/kota di provinsi ".$item->nama_bps, 's');
            foreach (\json_decode($res->getBody()) as $key => $value) {
                fLogs("\tInsert Kabupaten/Kota ".$value->nama_bps, 'i');
                // $newId = \explode('.', $value->kode_dagri);
                DB::connection('db_bps')->table('bridging_kabupaten')->insert([
                    'kode_provinsi_bps' => $item->kode_bps,
                    'kode_bps' => $value->kode_bps,
                    'nama_bps'  => $value->nama_bps,
                    'kode_dagri'  => $value->kode_dagri,
                    'nama_dagri'  => $value->nama_dagri
                ]);
            }
        }
    }

    function fDagriKecamatan($kabupaten) {
        foreach ($kabupaten as $item) {
            $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=kecamatan&parent='.$item->kode_bps);
            try {
                $res = $this->client->sendAsync($request)->wait();
                \fLogs("Ambil data KEMENDAGRI Kecamatan di ".$item->nama_bps, 's');
                foreach (\json_decode($res->getBody()) as $key => $value) {
                    fLogs("\tInsert Kecamatan ".$value->nama_bps, 'i');
                    DB::connection('db_bps')->table('bridging_kecamatan')->insert([
                    'kode_kabupaten_bps' => $item->kode_bps,
                    'kode_bps' => $value->kode_bps,
                    'nama_bps'  => $value->nama_bps,
                    'kode_dagri'  => $value->kode_dagri,
                    'nama_dagri'  => $value->nama_dagri
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    function fDagriKelurahan($kecamatan) {
        foreach ($kecamatan as $item) {
            $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=desa&parent='.$item->kode_bps);
            try {
                $res = $this->client->sendAsync($request)->wait();
                \fLogs("Ambil data KEMENDAGRI Kelurahan di ".$item->nama_bps, 's');
                foreach (\json_decode($res->getBody()) as $key => $value) {
                    fLogs("\tInsert Kelurahan ".$value->nama_bps, 'i');
                    DB::connection('db_bps')->table('bridging_kelurahan')->insert([
                        'kode_kecamatan_bps' => $item->kode_bps,
                        'kode_bps' => $value->kode_bps,
                        'nama_bps'  => $value->nama_bps,
                        'kode_dagri'  => $value->kode_dagri,
                        'nama_dagri'  => $value->nama_dagri
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
    /* function fDagriKabupaten($provinsi) {
        foreach ($provinsi as $item) {
            $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=kabupaten&parent='.$item->kode_bps);
            $res = $this->client->sendAsync($request)->wait();
            \fLogs("Ambil data KEMENDAGRI kabupaten/kota di provinsi ".$item->nama_bps, 's');
            foreach (\json_decode($res->getBody()) as $key => $value) {
                fLogs("\tInsert Kabupaten/Kota ".$value->nama_bps, 'i');
                // $newId = \explode('.', $value->kode_dagri);
                DB::connection('db_bps')->table('bridging_kabupaten')->insert([
                    'kode_provinsi_bps' => $item->kode_bps,
                    'kode_bps' => $value->kode_bps,
                    'nama_bps'  => $value->nama_bps,
                    'kode_dagri'  => $value->kode_dagri,
                    'nama_dagri'  => $value->nama_dagri
                ]);
            }
        }
    }

    function fDagriKecamatan($kabupaten) {
        foreach ($kabupaten as $item) {
            $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=kecamatan&parent='.$item->kode_bps);
            try {
                $res = $this->client->sendAsync($request)->wait();
                \fLogs("Ambil data KEMENDAGRI Kecamatan di ".$item->nama_bps, 's');
                foreach (\json_decode($res->getBody()) as $key => $value) {
                    fLogs("\tInsert Kecamatan ".$value->nama_bps, 'i');
                    DB::connection('db_bps')->table('bridging_kecamatan')->insert([
                    'kode_kabupaten_bps' => $item->kode_bps,
                    'kode_bps' => $value->kode_bps,
                    'nama_bps'  => $value->nama_bps,
                    'kode_dagri'  => $value->kode_dagri,
                    'nama_dagri'  => $value->nama_dagri
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    function fDagriKelurahan($kecamatan) {
        foreach ($kecamatan as $item) {
            $request = new Request('GET', 'https://sig.bps.go.id/rest-bridging/getwilayah?level=desa&parent='.$item->kode_bps);
            try {
                $res = $this->client->sendAsync($request)->wait();
                \fLogs("Ambil data KEMENDAGRI Kelurahan di ".$item->nama_bps, 's');
                foreach (\json_decode($res->getBody()) as $key => $value) {
                    fLogs("\tInsert Kelurahan ".$value->nama_bps, 'i');
                    DB::connection('db_bps')->table('bridging_kelurahan')->insert([
                        'kode_kecamatan_bps' => $item->kode_bps,
                        'kode_bps' => $value->kode_bps,
                        'nama_bps'  => $value->nama_bps,
                        'kode_dagri'  => $value->kode_dagri,
                        'nama_dagri'  => $value->nama_dagri
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    } */


        /* switch ($this->option('type')) {
            case 'kota':
                $db = DB::connection('db_bps')->table('provinsi')->orderBy('id', 'ASC')->get();
                $this->fKabkot($db);
                break;
            case 'kecamatan':
                $db = DB::connection('db_bps')->table('regencies')->orderBy('id', 'ASC')->get();
                $this->fKec($db);
                break;
            case 'kelurahan':
                $db = DB::connection('db_bps')->table('districts')->orderBy('id', 'ASC')->get();
                $this->fKel($db);
                break;

            default:
                \fLogs('done');
                break;
        } */

    /*
    public function handle()
    {
        switch ($this->option('type')) {
            case 'kota':
                $db = DB::connection('db_bps')->table('provinces')->orderBy('id', 'ASC')->get();
                $this->fKabkot($db);
                break;
            case 'kecamatan':
                $db = DB::connection('db_bps')->table('regencies')->orderBy('id', 'ASC')->get();
                $this->fKec($db);
                break;
            case 'kelurahan':
                $db = DB::connection('db_bps')->table('districts')->orderBy('id', 'ASC')->get();
                $this->fKel($db);
                break;

            default:
                \fLogs('done');
                break;
        }
    }

    function fKabkot($provinsi) {
        foreach ($provinsi as $prov) {
            $request = new Request('GET', 'https://sipedas.pertanian.go.id/api/wilayah/list_kab?thn=2024&lvl=11&pro='.$prov->id);
            $res = $this->client->sendAsync($request)->wait();
            \fLogs("Ambil data kabupaten/kota di provinsi ".$prov->name, 's');
            foreach (\json_decode($res->getBody()) as $key => $value) {
                fLogs("\tInsert Kabupaten/Kota ".$value, 'i');
                DB::connection('db_bps')->table('regencies')->insert([
                    'id'    => $prov->id.$key,
                    'province_id' => $prov->id,
                    'name'  => $value
                ]);
            }
        }
    }

    function fKec($kabkot) {
        foreach ($kabkot as $item) {
            $idKota = \str_replace($item->province_id, '', $item->id);
            $request = new Request('GET', 'https://sipedas.pertanian.go.id/api/wilayah/list_kec?thn=2024&lvl=12&pro='.$item->province_id.'&kab='.$idKota);
            $res = $this->client->sendAsync($request)->wait();
            \fLogs("Ambil data Kecamatan di Kota ".$item->name, 's');
            foreach (\json_decode($res->getBody()) as $key => $value) {
                fLogs("\tInsert Kecamatan ".$value, 'i');
                DB::connection('db_bps')->table('districts')->insert([
                    'id'    => $item->id.$key,
                    'regency_id' => $item->id,
                    'name'  => $value
                ]);
            }
        }
    }

    function fKel($kabkot) {
        foreach ($kabkot as $item) {
            $prov_regency = \str_split($item->regency_id, 2);
            $idKec = \str_replace($item->regency_id, '', $item->id);
            $request = new Request('GET', 'https://sipedas.pertanian.go.id/api/wilayah/list_des?thn=2024&lvl=13&pro='.$prov_regency[0].'&kab='.$prov_regency[1].'&kec='.$idKec);
            $res = $this->client->sendAsync($request)->wait();
            \fLogs("Ambil data Kelurahan di Kecamatan ".$item->name, 's');
            foreach (\json_decode($res->getBody()) as $key => $value) {
                fLogs("\tInsert Kelurahan ".$value, 'i');
                DB::connection('db_bps')->table('villages')->insert([
                    'id'    => $item->id.$key,
                    'district_id' => $item->id,
                    'name'  => $value
                ]);
            }
        }
    }
    */
}
