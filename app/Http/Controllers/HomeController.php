<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
Use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->middleware('auth');
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // $categories = $this->category->where('user_id', Auth::id())->get();
        // return view('home', ['user' => $user , 'categories' => $categories]);
        return redirect('/app');

    }

    public function getData()
    {
        $user = Auth::user();
        $categories = $this->category->where('user_id', Auth::id())->get();
        return response()->json(['status' => 'success', 'user' => $user, 'categories' => $categories]);   
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => 'success']);
    }
}
