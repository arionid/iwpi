<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Categories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blogs::with('author')->latest()->get();
        return view('blog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::where('model_type','Article')->orderBy('name','ASC')->get();
        return view('blog.create')->with(['category' => $categories]);
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
            "title"     => "required",
            "slug"      => "required",
            "content"   => "required",
            "type"      => "required",
            "categories"   => "required",
            'featured_img'   =>  "mimes:jpg,jpeg,png",
            'meta_image'   =>  "mimes:jpg,jpeg,png",
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }

        if( isset($validated['featured_img']) )
            $featured_img          =   saveAndResizeImage(
                                            $validated['featured_img'], 'blog', 'featured', 850, 450
                                        );
        try {
            $blog = new Blogs();
            $blog->slug     = $validated['slug'];
            $blog->title    = $validated['title'];
            $blog->excerpt  = (isset($request->excerpt)) ? $request->excerpt : Str::limit(strip_tags($validated['content']), 155);
            $blog->content  = $validated['content'];
            $blog->featured_img = (isset($featured_img)) ? $featured_img : null;
            // $blog->status       = $validated[''];
            $blog->type         = $validated['type'];
            $blog->meta_title   = (isset($request->meta_title)) ? $request->meta_title : Str::limit($validated['title'], 55);
            $blog->meta_description     = (isset($request->meta_description)) ? Str::limit($request->meta_description, 160) : Str::limit(strip_tags($validated['content']), 155);
            $blog->meta_image   = (isset($featured_img)) ? $featured_img : null;
            // $blog->tag  = $validated[''];
            $blog->categories_id   = $validated['categories'];
            $blog->published_at = Carbon::now();
            $blog->author_id = Auth::id();
            /* if( isset($validated['featured_img']) )
                $blog->addMedia($validated['featured_img'])
                ->withResponsiveImages()
                ->usingName($validated['title'])
                ->toMediaCollection("Featured Image"); */

            $blog->save();

        } catch (\Throwable $th) {
            // throw $th;
            \Log::emergency($th);
        }
        return redirect()->route('blog.index')->with('success',"Artikel <b>".$validated['title']."</b> berhasil ditambahkan.");
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
        $categories = Categories::where('model_type','Article')->orderBy('name','ASC')->get();
        $data= Blogs::findOrFail($id);
        return view('blog.edit')
        ->with([
            'category'  => $categories,
            'data'      => $data
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
        $validated  =   $request->validate([
            "title"     => "required",
            "slug"      => "required",
            "content"   => "required",
            "type"      => "required",
            "categories"   => "required",
            "status"   => "required",
            'featured_img'   =>  "mimes:jpg,jpeg,png",
            'meta_image'   =>  "mimes:jpg,jpeg,png",
        ]);

        if( !$validated )
        {
            return back()->withErrors( $validated );
        }
        $blog=Blogs::findOrFail($id);

        if( isset($validated['featured_img']) )
            $featured_img          =   saveAndResizeImage(
                                            $validated['featured_img'], 'blog', 'featured', 850, 450, $blog->featured_img
                                        );

        try {
            $blog->slug     = $validated['slug'];
            $blog->title    = $validated['title'];
            $blog->excerpt  = (isset($request->excerpt)) ? $request->excerpt : Str::limit(strip_tags($validated['content']), 155);
            $blog->content  = $validated['content'];
            $blog->featured_img = (isset($featured_img)) ? $featured_img : $blog->featured_img;
            $blog->status       = $validated['status'];
            $blog->type         = $validated['type'];
            $blog->meta_title   = (isset($request->meta_title)) ? Str::limit($request->meta_title, 180) : Str::limit($validated['title'], 55);
            $blog->meta_description     = (isset($request->meta_description)) ? Str::limit(strip_tags($request->meta_description), 180) : Str::limit(strip_tags($validated['content']), 155);
            $blog->meta_image   = (isset($featured_img)) ? $featured_img : $blog->featured_img;
            // $blog->tag  = $validated[''];
            $blog->categories_id   = $validated['categories'];
            $blog->published_at = Carbon::now();
            $blog->author_id = Auth::id();

            $blog->save();
        } catch (\Throwable $th) {
            // throw $th;
            \Log::emergency($th);
        }
        return redirect()->route('blog.index')->with('success',"Artikel <b>".$validated['title']."</b> berhasil diperbaruhi.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Blogs::findOrFail($id);
        try {
            unlinkFile($data->featured_img);
        } catch (\Throwable $th) {
                //throw $th;
        }
        $data->delete();

        return redirect()->route('blog.index')->with('success',"Artikel <b>".$data->title."</b> berhasil dihapus dari database.");

    }
}
