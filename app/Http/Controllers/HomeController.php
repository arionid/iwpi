<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blog = Blogs::with(["category" => function($query){
            $query->select('name','id');
            }])
        ->with(["author" => function($query){
            $query->select('name','id');
            }])
        ->latest()->limit(6)
        ->get();
        return view('index', compact('blog'));
    }
}
