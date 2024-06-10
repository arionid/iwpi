<?php

namespace App\Http\Controllers;

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
        $data = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinces.name AS provinces_name')
        ->leftjoin('provinces', 'pendaftaran_anggota.province_id', 'provinces.id')
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
        $user = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinces.name AS provinces_name', 'provinces.name AS provinces_name', 'regencies.name AS regency_name', 'districts.name AS district_name', 'villages.name AS village_name')
        ->where('pendaftaran_anggota.id', $id)
        ->leftjoin('provinces', 'pendaftaran_anggota.province_id', 'provinces.id')
        ->leftjoin('regencies', 'pendaftaran_anggota.regency_id', 'regencies.id')
        ->leftjoin('districts', 'pendaftaran_anggota.district_id', 'districts.id')
        ->leftjoin('villages', 'pendaftaran_anggota.village_id', 'villages.id')
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
        $user = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinces.name AS provinces_name', 'provinces.name AS provinces_name', 'regencies.name AS regency_name', 'districts.name AS district_name', 'villages.name AS village_name')
        ->where('pendaftaran_anggota.id', $id)
        ->leftjoin('provinces', 'pendaftaran_anggota.province_id', 'provinces.id')
        ->leftjoin('regencies', 'pendaftaran_anggota.regency_id', 'regencies.id')
        ->leftjoin('districts', 'pendaftaran_anggota.district_id', 'districts.id')
        ->leftjoin('villages', 'pendaftaran_anggota.village_id', 'villages.id')
        ->first();
        if(empty($user))
            \abort(404);

        $province =  Cache::remember('dt_province', now()->addYear(1), function () {
            return \DB::table('provinces')->orderBy('id', 'ASC')->get();
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
            'nik' => 'required|unique:pendaftaran_anggota,nik,'. $id,
            'email' => ['required', 'unique:pendaftaran_anggota,email,'. $id ],
            'fullname' => 'required|string',
            'born' => 'required|date',
            'city_born' => 'required|string',
            'province_id' => 'required|string',
            'regency_id' => 'required|string',
            'district_id' => 'required|string',
            'village_id' => 'required|string',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required|max:20',
            'perkawinan' => 'required',
            'jabatan' => 'nullable',
        ],[
            'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
            'nik.required' => 'Nomor KTP Harus diisi',
            'nik.unique' => 'Nomor NIK ini telah terdaftar di database kami',
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
            $data->nik = $validated['nik'];
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
            $data->jabatan = (empty($validated['jabatan'])) ? 'Anggota X4' : \Str::title($validated['jabatan']);
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

        try {
            $data = PendaftaranAnggota::findOrFail($id);
            $data->status = \Str::title($request->status);
            $data->date_active = Carbon::now()->addYears(5);
            $data->save();
        } catch (\Throwable $th) {
            //throw $th;
            Log::critical($th);
        }
        return redirect()->route('register-anggota.show', $id)
        ->with('success',"Konfirmasi Pendaftaran Anggota <b>".$data->fullname."</b> berhasil diperbarui.");
    }

    public function kartuAnggota($nik) {
        $data = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinces.name AS provinces_name', 'provinces.name AS provinces_name', 'regencies.name AS regency_name', 'districts.name AS district_name', 'villages.name AS village_name')
        ->where('pendaftaran_anggota.nik', $nik)
        ->leftjoin('provinces', 'pendaftaran_anggota.province_id', 'provinces.id')
        ->leftjoin('regencies', 'pendaftaran_anggota.regency_id', 'regencies.id')
        ->leftjoin('districts', 'pendaftaran_anggota.district_id', 'districts.id')
        ->leftjoin('villages', 'pendaftaran_anggota.village_id', 'villages.id')->first();
        if(empty($data))
            \abort(404);
        $link = route('anggota.kartu-anggota', $data->nik);
        $qrcode = QrCode::size(140)
                ->backgroundColor(0,0,0, 0)
                // ->color(166, 17, 7)
                ->format('png')
                ->eyeColor(1, 0, 0, 0, 166, 17, 7)
                // ->eyeColor(0, 81, 82, 139, 213, 149, 47)
                ->generate($link);

        // return $qrcode;
        return view('register-anggota.cetak-kartu')->with([
            'user' => $data,
            'qrcode' => $qrcode,
        ]);
    }
}
