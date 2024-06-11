<?php

namespace App\Http\Controllers;

use App\Jobs\KirimEmailNotifikasiPendaftaranJob;
use App\Mail\VerifikasiPendaftaranMail;
use App\Models\AnggotaIWPI;
use App\Models\Blogs;
use App\Models\PendaftaranAnggota;
use App\Notifications\AnggotaRegisterNotification;
use App\Rules\ReCaptcha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\validated;

class FrontendController extends Controller
{
    public function beranda() {
        $blog = Blogs::with(["category" => function($query){
            $query->select('name','id');
            }])
        ->with(["author" => function($query){
            $query->select('name','id');
            }])
        // ->whereIn('id', [82, 84, 86])
        ->limit(3)
        ->get();

        return view('frontend.beranda')
        ->with([
            'blog'  => $blog
        ]);
    }

    public function news() {
        $recentBlog = Cache::remember('recent-blog', now()->addHours(2), function () {
            return Blogs::with(["category" => function($query){
                $query->select('name','id');
                }])
            ->with(["author" => function($query){
                $query->select('name','id');
                }])
            ->latest()->limit(5)->get();
        });


        $blog = Blogs::with(["category" => function($query){
            $query->select('name','id');
            }])
        ->with(["author" => function($query){
            $query->select('name','id');
            }])
        ->latest()
        ->paginate(5);

        return view('frontend.news')
        ->with([
            'blog'  => $blog,
            'recentBlog'    => $recentBlog
        ]);
    }

    public function newsDetail($slug) {
        $blog = Cache::remember('detail-new-'.$slug, now()->addDay(), function () use ($slug){
            return Blogs::with(["category" => function($query){
                $query->select('name','id');
                }])
            ->with(["author" => function($query){
                $query->select('name','id');
                }])
            ->where([['slug', $slug]])
            ->first();
        });

        if(empty($blog)){ \abort(404); }
        $recentBlog = Cache::remember('recent-blog', now()->addMinutes(30), function () {
            return Blogs::with(["category" => function($query){
                $query->select('name','id');
                }])
            ->with(["author" => function($query){
                $query->select('name','id');
                }])
            ->latest()->limit(5)->get();
        });

        return view('frontend.detail-news', compact('blog'))
        ->with('previous', $blog->previous)
        ->with('next', $blog->next)
        ->with('recentBlog', $recentBlog);
    }

    public function registerMember()
    {
        $province = \DB::table('provinsi')->orderBy('kode', 'ASC')->get();
        return view('frontend.register-member', compact('province'));
    }

    public function submitRegisterMember(Request $request)
    {
        $validated = $request->validate( [
            'npwp' => ['required','unique:pendaftaran_anggota', 'min:15'],
            'nik' => ['required','unique:pendaftaran_anggota', 'min:15'],
            'email' => ['required', 'unique:pendaftaran_anggota'],
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
            'file_ktp' => 'required|mimes:jpg,jpeg,png',
            'file_npwp' => 'required|mimes:jpg,jpeg,png',
            'agreement_1' => 'required',
            // 'g-recaptcha-response' => 'recaptcha',
            // OR since v4.0.0
            // recaptchaFieldName() => recaptchaRuleName()
        ],[
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
            'file_ktp.required' => 'Data Foto KTP tidak Di Ijinkan Kosong',
            'file_npwp.required' => 'Data Foto NPWP tidak Di Ijinkan Kosong',
            'agreement_1.required' => 'Data Persyaratan 1 harus di setujui terlebih dahulu.',
            'agreement_2.required' => 'Data Persyaratan 2 harus di setujui terlebih dahulu.'
        ]);

        if( !$validated )
        {
            // dd($request);
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

        $nominalLayanan = ($validated['layanan_keanggotaan'] == 'Badan Usaha') ? 150000 : 50000;

        try {

            $data = new PendaftaranAnggota();
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
            $data->file_ktp = (isset($img_ktp)) ? $img_ktp : null;
            $data->file_npwp = (isset($img_npwp)) ? $img_npwp : null;
            $data->user_agent = $request->userAgent();
            $data->ip_client_register = \fGetClientIp();
            $data->save();

            // add to anggota iwpi
            $anggota = new AnggotaIWPI();
            $anggota->pendaftaran_id = $data->id;
            $anggota->nomor_anggota  = $data->village_id.".".sprintf( '%04d', $data->id );
            $anggota->layanan = $validated['layanan_keanggotaan'];
            $anggota->layanan_nominal = $nominalLayanan;
            $anggota->status = "Menunggu Pembayaran";
            $anggota->save();

        } catch (\Throwable $th) {
            throw $th;
            Log::emergency("Query Pendaftaran Error :".$th->getMessage());
        }

        // notif telegram ada calon angota baru mendaftar
        // dd($request);

        try {
            $notifyParam=[
                'title'     =>'Registrasi Anggota IWPI',
                'message'   =>"*".$validated['fullname']."* Berhasil Melakukan Pendaftaran Calon Anggota  *IWPI.INFO*\n".
                "NPWP : ".$validated['npwp']."\n".
                "Perusahaan : ".$request->perusahaan ?? "Perseorangan"."\n".
                "E-MAIL : ".$validated['email']."\n".
                "PHONE : ".$validated['phone']."\n",
            ];
            Notification::route('telegram', env('TELEGRAM_ID_CHAT_ADMIN', '-321143573'))
                        // ->route('mail', 'nando.arionid@gmail.com')
                        ->notify(new AnggotaRegisterNotification($notifyParam));

            // notif pendaftar
            $user = PendaftaranAnggota::with('detail')->find($data->id)->first();
            KirimEmailNotifikasiPendaftaranJob::dispatch($user)
                ->delay(now()->addSeconds(5));

        } catch (\Throwable $th) {
            //throw $th;
            \Log::error("Notifikasi Telegram Error");
        }

        return redirect()->route('register.member')
        ->with('nominal', $nominalLayanan)
        ->with('success',"Form Pendaftaran Anggota Atas Nama <strong>".$data->fullname."</strong> Telah di Kirimkan,
        Pendaftaran tersebut telah sedang di proses oleh admin IWPI.
        Perkembangan proses pendaftaran akan di tindak lanjuti melalui <b>Nomor Telepon & Email</b> Terdaftar");

    }

    public function getWilayah(Request $request) {
        $validated = $request->validate( [
            'id' => 'required',
            'category'    => 'nullable'
        ]);

        if( !$validated )
        {
            \abort(404);
        }
        switch ($request->category) {
            case 'regency':
                $data= DB::table('kabupaten')->where('kode','LIKE', $request->id."%")->get();
                break;
            case 'district':
                $data= DB::table('kecamatan')->where('kode','LIKE', $request->id."%")->get();
                break;
            case 'village':
                $data= DB::table('kelurahan')->where('kode','LIKE', $request->id."%")->get();
                break;
            case 'provinces':
                    $data= DB::table('provinsi')->get();
                    break;
            default:
                $data = false;
                break;
        }

        return $data;

    }

    public function anggotaProfile($nik){
        $user = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name', 'kecamatan.nama AS district_name', 'kelurahan.nama AS village_name')
        ->where('pendaftaran_anggota.nik', $nik)
        ->leftjoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota.regency_id', 'kabupaten.kode')
        ->leftjoin('kecamatan', 'pendaftaran_anggota.district_id', 'kecamatan.kode')
        ->leftjoin('kelurahan', 'pendaftaran_anggota.village_id', 'kelurahan.kode')->first();
        if(empty($user)) { \abort(404); }

        return view('register-anggota.kartu', compact('user'));
    }

    public function kartuAnggota($nik){
        return view('frontend.pre-check-kta');
    }

    public function postKTA(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'captcha' => 'required|captcha',
            "kta"      => "required",
        ],[
            'throttle' => 'Terlalu banyak percobaan gagal, this IP is Susspended from server.',
            'captcha.*' => 'Captcha yang di masukkan Tidak Sesuai!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors( $validator );
        }

        $user = PendaftaranAnggota::select('pendaftaran_anggota.fullname',
        'pendaftaran_anggota.jabatan',
        'pendaftaran_anggota.date_active',
        'pendaftaran_anggota.status',
        'pendaftaran_anggota.nik',
        'provinces.name AS provinces_name',
        'provinces.name AS provinces_name',
        'regencies.name AS regency_name')
        ->where('pendaftaran_anggota.nik', $request->kta)
        ->leftjoin('provinces', 'pendaftaran_anggota.province_id', 'provinces.id')
        ->leftjoin('regencies', 'pendaftaran_anggota.regency_id', 'regencies.id')->first();
        if(empty($user)) { \abort(404); }

        \sleep(3);
        return view('frontend.anggota', compact('user'));
    }

    public function cekTagihan(Request $request) {
        $validated = $request->validate( [
            'npwp' => 'required'
        ]);

        if( !$validated )
        {
            \abort(404);
        }

        $data = PendaftaranAnggota::select('npwp', 'email', 'anggota_iwpi.layanan', 'anggota_iwpi.layanan_nominal', 'anggota_iwpi.pendaftaran_id')
        ->join('anggota_iwpi', 'pendaftaran_anggota.id', 'anggota_iwpi.pendaftaran_id')
        ->where([['npwp', $request->npwp], ['anggota_iwpi.status', 'Menunggu Pembayaran']])->first();
        if(!$data)
            \abort(404);

        return response()->json($data);
    }

    public function caraPembayaran() {
        return view('frontend.cara-pembayaran');
    }

    public function konfirmasiPembayaran() {

        return view('frontend.konfirmasi-pembayaran');
    }

    public function submitKonfirmasiPembayaran(Request $request) {
        $validator = Validator::make($request->all(), [
            'captcha'       => 'required|captcha',
            "pendaftar_id"  => "required",
        ],[
            'throttle' => 'Terlalu banyak percobaan gagal, this IP is Susspended from server.',
            'captcha.*' => 'Captcha yang di masukkan Tidak Sesuai!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors( $validator );
        }
        $data = AnggotaIWPI::where([['pendaftaran_id', $request->pendaftar_id], ['status', 'Menunggu Pembayaran']])->first();
        if(!$data){return \redirect()->back()->withInput($request->input())->with('error', "Data yang anda masukkan tidak ada dalam database kami, silahkan check kembali data anda") ;}

        if( isset($request->file_bukti) )
        $file_bukti          =   saveAndResizeImage(
                                        $request->file_bukti, 'Konfirmasi', 'Pembayaran', 850, 450
                                    );
        $data = AnggotaIWPI::where('pendaftaran_id', $request->pendaftar_id)->update([
            'nama_pengirim' => $request->pengirim,
            'tgl_bayar' => Carbon::parse($request->tgl_bayar)->format('Y-m-d'),
            'bukti_bayar' => (isset($file_bukti)) ? $file_bukti : null,
            'keterangan' => $request->keterangan ?? NULL,
            'status' => "Menunggu Validasi",
            'updated_at'    =>Carbon::now()
        ]);

        try {
            $anggota = PendaftaranAnggota::where('id', $data->pendaftar_id)->first();
            $notifyParam=[
                'title'     =>'Pembayaran Registrasi IWPI',
                'message'   =>"*".$anggota->fullname."* Berhasil Melakukan Konfirmasi Pembayaran Anggota *IWPI.INFO*\n".
                "segera validasi pembayarannya \n",
            ];
            Notification::route('telegram', env('TELEGRAM_ID_CHAT_ADMIN', '-321143573'))
                        ->notify(new AnggotaRegisterNotification($notifyParam));
        } catch (\Throwable $th) {
            //throw $th;
            \Log::error("Notifikasi Telegram Error");
        }

        \sleep(3);

        return redirect()->route('konfirmasi-pembayaran')->with('success',"Konfirmasi Pembayaran untuk anggota NPWP : <strong>".$request->npwp."</strong> Berhasil upload, Admin IWPI Akan segera menghubungi anda");
    }

    public function refreshCaptcha() {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }
}
