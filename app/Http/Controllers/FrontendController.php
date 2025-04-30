<?php

namespace App\Http\Controllers;

use App\Jobs\KirimEmailNotifikasiPendaftaranJob;
use App\Models\AnggotaIWPI;
use App\Models\Blogs;
use App\Models\PaymentDetail;
use App\Models\PendaftaranAnggota;
use App\Models\PendaftaranAnggotaKehormatan;
use App\Models\Pengaduan;
use App\Models\UnitKerjaDjp;
use App\Notifications\AnggotaRegisterNotification;
use App\Traits\MidtransTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    use MidtransTrait;

    public function beranda() {
        $blog = Blogs::with(["category" => function($query){
            $query->select('name','id');
            }])
        ->with(["author" => function($query){
            $query->select('name','id');
            }])
        ->where('status', 1)
        // ->whereIn('id', [82, 84, 86])
        ->limit(3)
        ->get();

        return view('frontend.beranda')
        ->with([
            'blog'  => $blog
        ]);
    }

    public function aboutUs() {
        return view('frontend.about-us');
    }

    public function artiLogo() {
        return view('frontend.arti-logo');
        // return view('frontend.yellow-list');
    }

    public function news() {
        $recentBlog = Cache::remember('recent-blog', now()->addHours(2), function () {
            return Blogs::with(["category" => function($query){
                $query->select('name','id');
                }])
            ->with(["author" => function($query){
                $query->select('name','id');
                }])
            ->where('status', 1)
            ->latest()->limit(5)->get();
        });


        $blog = Blogs::with(["category" => function($query){
            $query->select('name','id');
            }])
        ->with(["author" => function($query){
            $query->select('name','id');
            }])
        ->where('status', 1)
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
            ->where([['slug', $slug],['status', 1]])
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

    public function privacyPolicy() {
        return view('frontend.privacy-policy');
    }

    public function registerMember()
    {
        $province = DB::table('provinsi')->orderBy('kode', 'ASC')->get();
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
        $perusahaan = "Perseorangan";
        if(!empty($request->perusahaan) && $request->perusahaan != ''){
            $perusahaan = $request->perusahaan;
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

        // notif telegram ada calon angota baru mendaftar

            $midtrans = $this->createPaymentLinkApi($anggota);
            $paymentDetail =  new PaymentDetail();
            $paymentDetail->pendaftaran_id = $data->id;
            $paymentDetail->order_id = $midtrans->order_id;
            $paymentDetail->payment_link_id = $midtrans->payment_url;
            $paymentDetail->expired_at = Carbon::now()->addDay();
            $paymentDetail->save();

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
            $user = PendaftaranAnggota::with(['detail','payment_detail'])->where('email',$validated['email'])->first();
            KirimEmailNotifikasiPendaftaranJob::dispatch($user)
                ->delay(now()->addSeconds(5));
            return redirect()->away($midtrans->payment_url);
        } catch (\Throwable $th) {
            throw $th;
            Log::error("Notifikasi Telegram Error");
        }
        return redirect()->route('register.member')
        ->with('nominal', $nominalLayanan)
        ->with('success',"Form Pendaftaran Anggota Atas Nama <strong>".$data->fullname."</strong> Telah di Kirimkan,
        Buka Kotak Masuk email ".$validated['email']." dan Ikuti Instruksi yang diberikan.
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
       /*  $user = PendaftaranAnggota::select('pendaftaran_anggota.*', 'provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name', 'kecamatan.nama AS district_name', 'kelurahan.nama AS village_name')
        ->where('pendaftaran_anggota.nik', $nik)
        ->leftjoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota.regency_id', 'kabupaten.kode')
        ->leftjoin('kecamatan', 'pendaftaran_anggota.district_id', 'kecamatan.kode')
        ->leftjoin('kelurahan', 'pendaftaran_anggota.village_id', 'kelurahan.kode')->first();
        if(empty($user)) { \abort(404); }

        return view('register-anggota.kartu', compact('user')); */
    }

    public function kartuAnggota($nik){
        return view('frontend.pre-check-kta');
    }

    public function postKTA(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'captcha' => 'required|captcha',
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
        'anggota_iwpi.nomor_anggota',
        'anggota_iwpi.layanan',
        'anggota_iwpi.tgl_akhir AS date_active',
        'pendaftaran_anggota.status',
        'pendaftaran_anggota.nik',
        'pendaftaran_anggota.perusahaan',
        'provinsi.nama AS provinces_name',
        'kabupaten.nama AS regency_name')
        ->where('anggota_iwpi.nomor_anggota', $request->kta)
        ->leftjoin('anggota_iwpi', 'pendaftaran_anggota.id', 'anggota_iwpi.pendaftaran_id')
        ->leftjoin('provinsi', 'pendaftaran_anggota.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pendaftaran_anggota.regency_id', 'kabupaten.kode')->first();



        if (str_contains($request->kta, '.B.')) {
            // DATA ANGGOTA KEHORMATAN
            $user = PendaftaranAnggotaKehormatan::select('pendaftaran_anggota_kehormatan.fullname',
            'pendaftaran_anggota_kehormatan.bidang_pekerjaan',
            'pendaftaran_anggota_kehormatan.no_kta_kehormatan',
            'pendaftaran_anggota_kehormatan.tgl_akhir AS date_active',
            'pendaftaran_anggota_kehormatan.nik',
            'provinsi.nama AS provinces_name',
            'kabupaten.nama AS regency_name')
            ->where('pendaftaran_anggota_kehormatan.no_kta_kehormatan', $request->kta)
            ->leftjoin('provinsi', 'pendaftaran_anggota_kehormatan.province_id', 'provinsi.kode')
            ->leftjoin('kabupaten', 'pendaftaran_anggota_kehormatan.regency_id', 'kabupaten.kode')->first();
        }

        if(empty($user)) { \abort(404); }
        // \sleep(3);
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
            $anggota = PendaftaranAnggota::where('id', $request->pendaftar_id)->first();
            $notifyParam=[
                'title'     =>'Pembayaran Registrasi IWPI',
                'message'   =>"*".$anggota->fullname."* Berhasil Melakukan Konfirmasi Pembayaran Anggota *IWPI.INFO*\n".
                "segera validasi pembayarannya \n",
            ];
            Notification::route('telegram', \config('nnd.telegram_id_chat_admin'))
                        ->notify(new AnggotaRegisterNotification($notifyParam));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Notifikasi Telegram Error");
        }
        \sleep(3);

        return redirect()->route('konfirmasi-pembayaran')->with('success',"Konfirmasi Pembayaran untuk anggota NPWP : <strong>".$request->npwp."</strong> Berhasil upload, Admin IWPI Akan segera menghubungi anda");
    }

    public function refreshCaptcha() {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    public function formPengaduan() {
        $province = DB::table('provinsi')->orderBy('kode', 'ASC')->get();
        $djp = UnitKerjaDjp::orderBy('id', 'asc')->get();
        return view('frontend.form-pengaduan', compact('province', 'djp'));
    }

    public function yellowlist() {
        $data = Pengaduan::select('pengaduan.*', DB::raw('COUNT(*) as total'))
        ->where('status', '1')
        ->groupBy('pengaduan.fullname')->orderBy('id', 'desc')->get();
        return view('frontend.yellow-list', compact('data'));
    }

    public function pengaduanYellowList(Request $request) {
        $validated = $request->validate( [
            'nama_pelapor' => 'nullable',
            'peran_pelapor' => 'nullable',
            'tlp_pelapor' => 'nullable',
            'jenis_pengaduan' => 'required',
            'kategori' => 'required',
            'kantor' => 'nullable',
            'unit_djp' => 'nullable',
            'fullname' => 'required',
            'nip' => 'nullable',
            'jabatan' => 'nullable',
            'gender' => 'nullable',
            'province_id' => 'required',
            'regency_id' => 'required',
            'kronologi' => 'required',
            'file.*' => 'required|file|mimes:jpg,png,pdf,doc,docx|max:20048',
        ],[
            'throttle' => 'Terlalu banyak percobaan gagal, this IP is Susspended from server.',
            'nama_pelapor.required' => 'Nama Kontak Pelapor Harus diisi',
            'peran_pelapor.required' => 'Peran Kontak Pelapor Harus diisi',
            'tlp_pelapor.required' => 'Telepon Pelapor Harus diisi',
            'jenis_pengaduan.required' => 'Nomor Jenis Pengaduan Harus diisi',
            'kategori.required' => 'Nomor Kategori Harus diisi',
            'nip.required' => 'Nomor KTP Harus diisi',
            'fullname.required' => 'Data Nama Terlapor tidak Di Ijinkan Kosong',
            'unit_djp.required' => 'Data Kantor Unit DJP Terlapor tidak Di Ijinkan Kosong',
            'province_id.required' => 'Data Provinsi tidak Di Ijinkan Kosong',
            'regency_id.required' => 'Data Kabupaten/KOta tidak Di Ijinkan Kosong',
            'gender.required' => 'Data Jenis Kelamin tidak Di Ijinkan Kosong',
            'kronologi.required' => 'Data Kronologi harus di setujui terlebih dahulu.',
            'agreement_1.required' => 'Data Persyaratan 1 harus di setujui terlebih dahulu.',
            'captcha.*' => 'Captcha yang di masukkan Tidak Sesuai!'
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        if( isset($validated['file']) ){
            $uploadFile = [];
            for ($i=0; $i < sizeof($validated['file']); $i++) {
                $files          =   uploadFile(
                    'pengaduan', 'dokumen', 'bukti', $validated['file'][$i]
                 );

                 array_push($uploadFile, $files);
            }
        }
        try {
            $data = new Pengaduan();
            $data->pelapor = $validated['nama_pelapor'];
            $data->peran_pelapor = $validated['peran_pelapor'];
            $data->tlp_pelapor = $validated['tlp_pelapor'];
            $data->jenis_pengaduan = $validated['jenis_pengaduan'];
            $data->kategori = $validated['kategori'];
            $data->kantor = $validated['kantor'] ?? null;
            $data->unit_djp = $validated['unit_djp'] ?? null;
            $data->fullname = $validated['fullname'];
            $data->nip = $validated['nip'] ?? null;
            $data->jabatan = $validated['jabatan'];
            $data->gender = $validated['gender'];
            $data->province_id = $validated['province_id'];
            $data->regency_id = $validated['regency_id'];
            $data->kronologi = $validated['kronologi'];
            $data->files = (isset($uploadFile)) ? json_encode($uploadFile, JSON_UNESCAPED_SLASHES) : null;
            $data->user_agent = $request->userAgent();
            $data->ip_client_register = \fGetClientIp();
            $data->save();
        } catch (\Throwable $th) {
            throw $th;
            Log::error($th);
        }

        return redirect()->route('form-pengaduan')
        ->with('success',"Form Pengaduan berhasil dikirimkan, Admin IWPI sedang menverifikasi laporan ini,
        Perkembangan proses pendaftaran akan di tindak lanjuti melalui <b>Nomor Telepon & Email</b> yang di masukkan sebelumnya.");

    }

    public function download()
    {
        $document = array(
            [
                'name' => 'Format Surat Pemberitahuan Kendala Core Tax',
                'loc'   => 'document-download/format-surat-pemberitahuan-kendala-core-tax.docx',
                'type'  => 'word'
            ],
            [
                'name' => 'Keterangan Tertulis - Implementasi Coretax DJP',
                'loc'   => 'document-download/keterangan-tertulis-implementasi-coretax-djp.pdf',
                'type'  => 'pdf'
            ],
            [
                'name' => 'Surat Edaran Ketua Umum',
                'loc'   => 'document-download/se-iwpipenyikapan-skp-dan-stp.pdf',
                'type'  => 'pdf'
            ]
            );
        return view('frontend.listdownload', compact('document'));
    }


}
