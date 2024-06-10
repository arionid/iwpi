<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->get();
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated      =   $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        try {
                $user = new User();
                $user->name          = $validated['name'];
                $user->email         = $validated['email'];
                $user->password      = Hash::make($validated['password']);
                $user->save();

        } catch (\Exception $e) {
            // throw $e;

        }

        return redirect()->route('management-user.index')->withSuccess('Administrator ' . $validated['name'] . ' Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $administrator  =   User::find( $id );

        if( !$administrator )
        {
            return back()->withErrors(['status' => 'error', 'message' => 'Admin tidak terdaftar']);
        }

        return view('users.edit', ['data' => $administrator]);
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
        $data  =   User::find( $id );

        if( !$data )
        {
            return back()->withErrors(['status' => 'error', 'message' => 'Admin tidak terdaftar']);
        }

        $validated      =   $request->validate([
                                "name"          =>  "required",
                                "email"         =>  "required|unique:users,email,".$data->id,
                                "password"      =>  "nullable|min:6|confirmed"
                            ]);


        if( isset($request->changepassword) ){
            $data->password        =   \Hash::make( $validated['password'] );
        }

        $data->name            =   $validated['name'];
        $data->email           =   $validated['email'];

        $data->save();

        return redirect()->route('management-user.index')->withSuccess('Data administrator ' . $validated['name'] . ' Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = User::findOrFail($id);
            $data->delete();
            return redirect()->route('management-user.index')->with('success',"User <b>".$data->name."</b> berhasil dihapus dari database.");
        } catch (\Throwable $th) {
            // \abort(404);
        }

        return redirect()->route('management-user.index')->with('success',"User berhasil dihapus dari database.");
    }

    public function profile()
    {
        $user = User::findOrFail(Auth::id());
        return view('users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $data = User::findOrFail(Auth::id());
        $validated  =   $request->validate([
            "name"          => "required",
            "email"         => "required|unique:users,email,$data->id",
            'password_old'  => ['nullable', 'string'],
            'password'      => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        if(isset($request->change_password) && $request->change_password == '1')
        {
            if (!(Hash::check($request->get('password_old'), Auth::user()->password))) {
                // The passwords matches
                return back()->withErrors(['password_old' => ['Password Lama Anda tidak sesuai dengan password yang belaku.']]);
            }

            if(strcmp($request->get('password_old'), $request->get('password')) == 0){
                // Current password and new password same
                return back()->withErrors(['password_old' => ['Password Baru tidak boleh sama dengan password sebelumnya.']]);
            }

            Auth::user()->update([
                'password'      => Hash::make($validated['password']),
                'updated_at'    => Carbon::now()
            ]);

        }
        return redirect()->route('home')->with('success', 'Data Profile ' . $validated['name']. ' berhasil diperbarui dalam database.');
    }
}
