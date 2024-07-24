<?php

namespace App\Http\Controllers;


use App\Jobs\KirimEmailNotifikasiPendaftaranJob;
use App\Models\PendaftaranAnggotaKehormatan;
use App\Notifications\AnggotaRegisterNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\validated;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PendaftaranAnggotaKehormatanController extends Controller
{
    public function registerMember()
    {
        $province = Cache::remember('dt_province', now()->addDay(), function () {
            return \DB::table('provinsi')->orderBy('kode', 'ASC')->get();
        });
        return view('frontend.anggota-kehormatan.register', compact('province'));
    }

    public function submitRegisterMember(Request $request)
    {
        $validated = $request->validate( [
            'npwp' => ['required','unique:pendaftaran_anggota_kehormatan', 'min:15'],
            'nik' => ['required','unique:pendaftaran_anggota_kehormatan', 'min:15'],
            'email' => ['required', 'unique:pendaftaran_anggota_kehormatan'],
            'bidang_pekerjaan' => 'required|string',
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
            'file_ktp' => 'required|mimes:jpg,jpeg,png',
            'file_npwp' => 'required|mimes:jpg,jpeg,png',
            'file_bukti_pekerjaan' => 'required|mimes:jpg,jpeg,png',
            'agreement_1' => 'required',
        ],[
            'throttle' => 'Terlalu banyak mengirimkan form pendaftaran. Coba lagi dalam waktu :seconds detik.',
            'npwp.required' => 'Nomor NPWP Harus diisi',
            'nik.required' => 'Nomor KTP Harus diisi',
            'bidang_pekerjaan.required' => 'Bidang Pekerjaan Harus dipilih',
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
            'file_ktp.required' => 'Data Foto KTP tidak Di Ijinkan Kosong',
            'file_npwp.required' => 'Data Foto NPWP tidak Di Ijinkan Kosong',
            'file_bukti_pekerjaan.required' => 'Data Bukti Dukung tidak Di Ijinkan Kosong',
            'agreement_1.required' => 'Data Persyaratan 1 harus di setujui terlebih dahulu.',
            'agreement_2.required' => 'Data Persyaratan 2 harus di setujui terlebih dahulu.'
        ]);

        if( !$validated )
        {
            dd($request);
            return back()->withErrors( $validated );
        }


        if( isset($validated['file_ktp']) )
        $img_ktp          =   saveAndResizeImage(
                                        $validated['file_ktp'], 'pendaftaran', 'ktp', 850, 450
                                    );
        if( isset($validated['file_npwp']) )
        $img_npwp          =   saveAndResizeImage(
                                        $validated['file_npwp'], 'pendaftaran', 'npwp', 850, 450
                                    );
        $img_file_bukti_pekerjaan   =   saveAndResizeImage(
                                        $validated['file_bukti_pekerjaan'], 'pendaftaran', 'bukti', 850, 450
                                    );


        try {

            $data = new PendaftaranAnggotaKehormatan();
            $data->bidang_pekerjaan = $validated['bidang_pekerjaan'];
            $data->email = $validated['email'];
            $data->npwp = $validated['npwp'];
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
            $data->file_ktp = (isset($img_ktp)) ? $img_ktp : null;
            $data->file_npwp = (isset($img_npwp)) ? $img_npwp : null;
            $data->file_bukti_pekerjaan = (isset($img_file_bukti_pekerjaan)) ? $img_file_bukti_pekerjaan : null;
            $data->no_kta_kehormatan = fNoKTA($validated['village_id']);
            $data->tgl_mulai = Carbon::now();
            $data->tgl_akhir= Carbon::now()->addDays(365);
            $data->user_agent = $request->userAgent();
            $data->ip_client_register = \fGetClientIp();
            $data->save();

            /* $notifyParam=[
                'title'     =>'Registrasi Anggota IWPI',
                'message'   =>"*".$validated['fullname']."* Berhasil Melakukan Pendaftaran Calon Anggota  *IWPI.INFO*\n".
                "NPWP : ".$validated['npwp']."\n".
                "Perusahaan : ".$perusahaan."\n".
                "Layanan : ".$validated['layanan_keanggotaan']."\n".
                "E-MAIL : ".$validated['email']."\n".
                "No.Tlp : ".$validated['phone']."\n",
            ];
            Notification::route('telegram', \config('nnd.telegram_id_chat_admin'))
                        ->notify(new AnggotaRegisterNotification($notifyParam)); */

            // notif pendaftar
            /* $user = PendaftaranAnggota::with(['detail','payment_detail'])->where('email',$validated['email'])->first();
            KirimEmailNotifikasiPendaftaranJob::dispatch($user)
                ->delay(now()->addSeconds(5)); */
        } catch (\Throwable $th) {
            throw $th;
            \Log::error("Notifikasi Telegram Error");
        }
        dd($request);
        return redirect()->route('register.anggota-kehormatan')
        ->with('success',"Form Pendaftaran Anggota Atas Nama <strong>".$data->fullname."</strong> Telah di Kirimkan,
        Buka Kotak Masuk email ".$validated['email']." dan Ikuti Instruksi yang diberikan.
        Perkembangan proses pendaftaran akan di tindak lanjuti melalui <b>Nomor Telepon & Email</b> Terdaftar");

    }

    public function index() {

        $data = PendaftaranAnggotaKehormatan::select('pendaftaran_anggota_kehormatan.*', 'provinsi.nama AS provinces_name')
        ->leftjoin('provinsi', 'pendaftaran_anggota_kehormatan.province_id', 'provinsi.kode')
        ->orderBy('id', 'desc')->get();
        return view('anggota-kehormatan.index', compact('data'));
    }

    public function show($id)
    {
        $user = PendaftaranAnggotaKehormatan::select('pendaftaran_anggota_kehormatan.*', 'provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name', 'kecamatan.nama AS district_name', 'kelurahan.nama AS village_name')
        ->where('pendaftaran_anggota_kehormatan.id', $id)
        ->leftjoin('provinsi', 'pendaftaran_anggota_kehormatan.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota_kehormatan.regency_id', 'kabupaten.kode')
        ->leftjoin('kecamatan', 'pendaftaran_anggota_kehormatan.district_id', 'kecamatan.kode')
        ->leftjoin('kelurahan', 'pendaftaran_anggota_kehormatan.village_id', 'kelurahan.kode')
        ->first();
        if(empty($user))
            \abort(404);
        return view('anggota-kehormatan.detail', compact('user'));
    }

    public function destroy($id)
    {
        $data = PendaftaranAnggotaKehormatan::findOrFail($id);
        $data->delete();
        return redirect()->route('anggota-kehormatan.index')
        ->with('success',"Berhasil Menghapus Anggota Kehormatan a/n <strong>".$data->fullname."</strong>");
        // \abort(404);
    }

    public function kartuAnggota($no_anggota) {
        $data = PendaftaranAnggotaKehormatan::select('pendaftaran_anggota_kehormatan.*','provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name', 'kecamatan.nama AS district_name', 'kelurahan.nama AS village_name')
        ->where('pendaftaran_anggota_kehormatan.no_kta_kehormatan', $no_anggota)
        ->leftjoin('provinsi', 'pendaftaran_anggota_kehormatan.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota_kehormatan.regency_id', 'kabupaten.kode')
        ->leftjoin('kecamatan', 'pendaftaran_anggota_kehormatan.district_id', 'kecamatan.kode')
        ->leftjoin('kelurahan', 'pendaftaran_anggota_kehormatan.village_id', 'kelurahan.kode')->first();
        if(empty($data))
            \abort(404);
        $link = route('anggota.kartu-anggota', ["id" => $data->no_kta_kehormatan]);
        $qrcode = QrCode::size(130)
                ->backgroundColor(255, 255, 255)
                ->margin(2)
                ->format('png')
                ->eyeColor(1, 0, 0, 0, 26, 138, 255)
                ->generate($link);

        // return $qrcode;
        return view('register-anggota.cetak-kartu')->with([
            'user' => $data,
            'qrcode' => $qrcode,
        ]);
    }
}
