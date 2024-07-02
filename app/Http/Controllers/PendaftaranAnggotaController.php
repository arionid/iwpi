<?php

namespace App\Http\Controllers;

use App\Models\AnggotaIWPI;
use App\Models\PendaftaranAnggota;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PendaftaranAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PendaftaranAnggota::with('detail')->select('pendaftaran_anggota.*', 'provinsi.nama AS provinces_name')
        ->leftjoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
        ->orderBy('id', 'desc')->get();
        return view('register-anggota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name', 'kecamatan.nama AS district_name', 'kelurahan.nama AS village_name')
        ->where('pendaftaran_anggota.id', $id)
        ->leftjoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota.regency_id', 'kabupaten.kode')
        ->leftjoin('kecamatan', 'pendaftaran_anggota.district_id', 'kecamatan.kode')
        ->leftjoin('kelurahan', 'pendaftaran_anggota.village_id', 'kelurahan.kode')
        ->first();
        if(empty($user))
            \abort(404);
        return view('register-anggota.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name', 'kecamatan.nama AS district_name', 'kelurahan.nama AS village_name')
        ->where('pendaftaran_anggota.id', $id)
        ->leftjoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota.regency_id', 'kabupaten.kode')
        ->leftjoin('kecamatan', 'pendaftaran_anggota.district_id', 'kecamatan.kode')
        ->leftjoin('kelurahan', 'pendaftaran_anggota.village_id', 'kelurahan.kode')
        ->first();
        if(empty($user))
            \abort(404);

        $province =  Cache::remember('dt_province', now()->addYear(1), function () {
            return \DB::table('provinsi')->orderBy('kode', 'ASC')->get();
            });

        return view('register-anggota.edit', compact('user'))->with([
            'province' => $province
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate( [
            'npwp' => 'required|unique:pendaftaran_anggota,npwp,'. $id,
            'nik' => 'required|unique:pendaftaran_anggota,nik,'. $id,
            'email' => ['required', 'unique:pendaftaran_anggota,email,'. $id ],
            'layanan_keanggotaan' => 'required|string',
            'fullname' => 'required|string',
            'born' => 'required|date',
            'city_born' => 'required|string',
            'province_id' => 'required|string',
            'regency_id' => 'required|string',
            'district_id' => 'required|string',
            'village_id' => 'required|string',
            'address' => 'required',
            'phone' => 'required|max:20',
            'gender' => 'required',
            'perkawinan' => 'required',
        ],[
            'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
            'throttle' => 'Terlalu banyak mengirimkan form pendaftaran. Coba lagi dalam waktu :seconds detik.',
            'npwp.required' => 'Nomor NPWP Harus diisi',
            'nik.required' => 'Nomor KTP Harus diisi',
            'nik.unique' => 'Nomor NIK ini telah terdaftar di database kami',
            'npwp.unique' => 'Nomor NPWP ini telah terdaftar di database kami',

            'email.required' => 'Nomor Email Harus diisi',
            'email.unique' => 'Nomor Email ini telah terdaftar di database kami',

            'province_id.required' => 'Data Provinsi tidak Di Ijinkan Kosong',
            'regency_id.required' => 'Data Kabupaten/KOta tidak Di Ijinkan Kosong',
            'district_id.required' => 'Data Kecamatan tidak Di Ijinkan Kosong',
            'village_id.required' => 'Data Kelurahan tidak Di Ijinkan Kosong',
            'address.required' => 'Data Alamat tidak Di Ijinkan Kosong',
            'phone.required' => 'Data Telepon tidak Di Ijinkan Kosong',
            'gender.required' => 'Data Jenis Kelamin tidak Di Ijinkan Kosong',
            'perkawinan.required' => 'Data Status Pernikahan tidak Di Ijinkan Kosong',
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        try {
            $data = PendaftaranAnggota::findOrFail($id);
            $data->email = $validated['email'];
            $data->npwp = $validated['npwp'];
            $data->nik = $validated['nik'];
            $data->perusahaan = $request->perusahaan ?? "Perseorangan";
            $data->fullname = $validated['fullname'];
            $data->city_born = $validated['city_born'];
            $data->born = Carbon::parse($validated['born'])->format('Y-m-d');
            $data->province_id = $validated['province_id'];
            $data->regency_id = $validated['regency_id'];
            $data->district_id = $validated['district_id'];
            $data->village_id = $validated['village_id'];
            $data->address = $validated['address'];
            $data->phone = $validated['phone'];
            $data->gender = $validated['gender'];
            $data->perkawinan = $validated['perkawinan'];
            $data->save();
        } catch (\Throwable $th) {
            // throw $th;
            Log::emergency("Query Pendaftaran Error :".$th->getMessage());
        }

        return redirect()->route('register-anggota.index')
        ->with('success',"Perubahan data Anggota ".$validated['fullname']." berhasil diperbarui.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \abort(404);
    }

    public function updateStatusAggota(Request $request, $id) {
        $validated  =   $request->validate([
            "user_id"        => "required|exists:pendaftaran_anggota,id",
            "status"      => ["required", Rule::in(['Approve', 'Decline', 'Blacklist', 'Overdue'])],
        ], [
            'status.required' => 'Status Anggota harus di pilih terlebih dahulu',
            'status.in' => 'Data Status Anggota tidak sesuai dengan database.',
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }


        $data = PendaftaranAnggota::findOrFail($id);

        if($request->status == "Approve"){
            if($data->detail->status == 'Menunggu Validasi'){
                // update masa aktif status
                $AnggotaIwpi = AnggotaIWPI::where('pendaftaran_id', $data->id)->update([
                    'nomor_anggota' =>  $data->village_id.".".sprintf( '%04d', $data->id ),
                    'status'    => 'Pembayaran Valid',
                    'tgl_mulai' => Carbon::now(),
                    'tgl_akhir' => Carbon::now()->addYear(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }elseif($request->status == "Decline"){
            $AnggotaIwpi = AnggotaIWPI::where('pendaftaran_id', $data->id)->update([
                'status'    => 'Pembayaran Tidak Valid',
                'updated_at' => Carbon::now(),
            ]);
        }

        try {
            $data->status = \Str::title($request->status);
            $data->date_active = Carbon::now()->addYear();
            $data->save();

        } catch (\Throwable $th) {
            //throw $th;
            Log::critical($th);
        }
        return redirect()->route('register-anggota.show', $id)
        ->with('success',"Konfirmasi Pendaftaran Anggota <b>".$data->fullname."</b> berhasil diperbarui.");
    }

    public function kartuAnggota($no_anggota) {
        $data = PendaftaranAnggota::select('pendaftaran_anggota.*', 'anggota_iwpi.nomor_anggota', 'anggota_iwpi.tgl_mulai', 'anggota_iwpi.tgl_akhir', 'provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name', 'kecamatan.nama AS district_name', 'kelurahan.nama AS village_name')
        ->where('anggota_iwpi.nomor_anggota', $no_anggota)
        ->leftjoin('anggota_iwpi', 'pendaftaran_anggota.id', 'anggota_iwpi.pendaftaran_id')
        ->leftjoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota.regency_id', 'kabupaten.kode')
        ->leftjoin('kecamatan', 'pendaftaran_anggota.district_id', 'kecamatan.kode')
        ->leftjoin('kelurahan', 'pendaftaran_anggota.village_id', 'kelurahan.kode')->first();
        if(empty($data))
            \abort(404);
        $link = route('anggota.kartu-anggota', ["id" => $data->nomor_anggota]);
        $qrcode = QrCode::size(130)
                ->backgroundColor(255, 255, 255)
                ->margin(2)
                // ->backgroundColor(0,0,0, 0)
                // ->color(166, 17, 7)
                ->format('png')
                ->eyeColor(1, 0, 0, 0, 26, 138, 255)
                // ->eyeColor(0, 81, 82, 139, 213, 149, 47)
                ->generate($link);

        // return $qrcode;
        return view('register-anggota.cetak-kartu')->with([
            'user' => $data,
            'qrcode' => $qrcode,
        ]);
    }
}
