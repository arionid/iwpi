<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Categories::latest()->get();
        return view('categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated  =   $request->validate([
            "model"     => "required",
            "name"     => "required",
            "slug"      => "required",
            'featured_img'   =>  "mimes:jpg,jpeg,png",
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        // checkslug

        if( isset($validated['icon']) )
            $categories_icon          =   saveAndResizeImage(
                                            $validated['icon'], 'categories', 'icon', 150, 150
                                        );
        try {
            $blog = new Categories();
            $blog->model_type    = $validated['model'];
            $blog->name    = $validated['name'];
            $blog->slug     = $validated['slug'];
            $blog->icon = (isset($categories_icon)) ? $categories_icon : null;
            $blog->save();

        } catch (\Throwable $th) {
            throw $th;
            \Log::emergency($th);
        }
        return redirect()->route('categories.index')->with('success',"Data Kategori <b>".$validated['name']."</b> berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Categories::findOrFail($id);
        return view('categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated  =   $request->validate([
            "name"     => "required",
            "slug"      => "required",
            'icon'   =>  "mimes:jpg,jpeg,png",
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }
        $db = Categories::findOrFail($id);

        if( isset($validated['icon']) )
            $icon          =   saveAndResizeImage(
                                            $validated['icon'], 'categories', 'icon', 150, 150, $db->icon
                                        );

        try {
            $db->slug     = $validated['slug'];
            $db->name    = $validated['name'];
            $db->icon = (isset($icon)) ? $icon : $db->icon;
            $db->save();
        } catch (\Throwable $th) {
            throw $th;
            \Log::emergency($th);
        }

        return redirect()->route('categories.index')->with('success',"Kategori <b>".$validated['name']."</b> berhasil diperbaruhi.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $data = Categories::findOrFail($id);
            try {
                unlinkFile($data->icon);
            } catch (\Throwable $th) {
                //throw $th;
            }
            $data->delete();
            return redirect()->route('categories.index')->with('success',"Kategori <b>".$data->name."</b> berhasil dihapus dari database.");
    }
}
