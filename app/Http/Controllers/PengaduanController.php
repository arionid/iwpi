<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\UnitKerjaDjp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengaduan::latest()->get();
        return view('pengaduan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = DB::table('provinsi')->orderBy('kode', 'ASC')->get();
        $djp = UnitKerjaDjp::orderBy('id', 'asc')->get();
        return view('pengaduan.create', compact('province', 'djp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate( [
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
        ],[
            'throttle' => 'Terlalu banyak percobaan gagal, this IP is Susspended from server.',
            'jenis_pengaduan.required' => 'Nomor Jenis Pengaduan Harus diisi',
            'kategori.required' => 'Nomor Kategori Harus diisi',
            'nip.required' => 'Nomor KTP Harus diisi',
            'fullname.required' => 'Data Nama Terlapor tidak Di Ijinkan Kosong',
            'unit_djp.required' => 'Data Kantor Unit DJP Terlapor tidak Di Ijinkan Kosong',
            'province_id.required' => 'Data Provinsi tidak Di Ijinkan Kosong',
            'regency_id.required' => 'Data Kabupaten/KOta tidak Di Ijinkan Kosong',
            'gender.required' => 'Data Jenis Kelamin tidak Di Ijinkan Kosong',
            'agreement_1.required' => 'Data Persyaratan 1 harus di setujui terlebih dahulu.',
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }
        try {
            $data = new Pengaduan();
            $data->pelapor = 'system';
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
            $data->user_agent = $request->userAgent();
            $data->ip_client_register = \fGetClientIp();
            $data->status = 1;
            $data->save();
        } catch (\Throwable $th) {
            throw $th;
            Log::error($th);
        }

        return redirect()->route('pengaduan-yellow-page.index')
        ->with('success',"Form Pengaduan berhasil dikirimkan, Admin IWPI sedang menverifikasi laporan ini,
        Perkembangan proses pendaftaran akan di tindak lanjuti melalui <b>Nomor Telepon & Email</b> yang di masukkan sebelumnya.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pengaduan::select('pengaduan.*', 'provinsi.nama AS provinces_name', 'kabupaten.nama AS regency_name')
        ->where('pengaduan.id', $id)
        ->leftjoin('provinsi', 'pengaduan.province_id', 'provinsi.kode')
        ->leftjoin('kabupaten', 'pengaduan.regency_id', 'kabupaten.kode')
        ->where('pengaduan.id', $id)->first();

        if(empty($data)){
            abort(404);
        }

        $bukti =[];
        if(!empty($data->files) && $data->files != '[]' && $data->files != ''){
            $bukti = json_decode($data->files);
        }

        return view('pengaduan.detail', compact('data', 'bukti'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengaduan::findOrFail($id);
        try {
            $file = json_decode($data->files);
            foreach ($file as $item) {
                unlinkFile($item);
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
        $data->delete();
        return redirect()->route('pengaduan-yellow-page.index')
        ->with('success',"Berhasil Menghapus Data Pengaduan a/n <strong>".$data->fullname."</strong>");
    }

    public function publishStatus(Request $request)
    {
        $data = Pengaduan::findOrFail($request->id);
        if($data->status == 0){
            $data->status = 1;
        }else{
            $data->status = 0;
        }
        $data->save();
        return redirect()->route('pengaduan-yellow-page.index');
    }
}
