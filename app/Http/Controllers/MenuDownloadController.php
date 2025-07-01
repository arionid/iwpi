<?php

namespace App\Http\Controllers;

use App\Models\MenuDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MenuDownload::latest()->get();
        return view('menu-download.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu-download.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate( [
            'nama_file' => 'required|string',
            'deskripsi' => 'nullable|string',
            'dokumen' => 'required|mimes:pdf,zip,doc,docx|max:10000',
        ],[
            'throttle' => 'Terlalu banyak mengirimkan form pendaftaran. Coba lagi dalam waktu :seconds detik.',
            'file_npwp.required' => 'Data Foto NPWP tidak Di Ijinkan Kosong',
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        try {
            $fileUpload = $request->file('dokumen');
            $data = new MenuDownload();
            $data->nama = $validated['nama_file'];
            $data->keterangan = $validated['deskripsi'];
            $data->file = uploadFile('doc', 'download', 'public', $fileUpload);
            $data->jenis = $fileUpload->getClientOriginalExtension();
            $data->status = $request->status;
            $data->save();

        } catch (\Throwable $th) {
            throw $th;
            Log::error($th->getMessage());
        }
        return redirect()->route('menu-download.index')
        ->with('success',"Data Download Dokumen '".$request->nama_file."' berhasil diupload.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MenuDownload::findOrFail($id);

        return view('menu-download.edit', compact('data'));
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
            'nama_file' => 'required|string',
            'deskripsi' => 'nullable|string',
            'dokumen' => 'nullable|mimes:pdf,zip,doc,docx|max:10000',
        ],[
            'throttle' => 'Terlalu banyak mengirimkan form pendaftaran. Coba lagi dalam waktu :seconds detik.',
            'file_npwp.required' => 'Data Foto NPWP tidak Di Ijinkan Kosong',
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        $data= MenuDownload::findOrFail($id);

        try {
            $data->nama = $validated['nama_file'];
            $data->keterangan = $validated['deskripsi'];
            if( isset($validated['dokumen']) ){
                $data->file = uploadFile('doc', 'download', 'public', $request->file('dokumen'), $data->file);
                $data->jenis = $request->file('dokumen')->getClientOriginalExtension();
            }
            $data->status = $request->status;
            $data->save();

        } catch (\Throwable $th) {
            throw $th;
            Log::error($th->getMessage());
        }

        return redirect()->route('menu-download.index')->with('success',"Data <b>".$validated['nama_file']."</b> berhasil diperbaruhi.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MenuDownload::findOrFail($id);
        try {
           unlinkFile($data->file);
        } catch (\Throwable $th) {
            // throw $th;
        }
        $data->delete();
        return redirect()->route('menu-download.index')
        ->with('success',"Berhasil Menghapus Data");
    }
}
