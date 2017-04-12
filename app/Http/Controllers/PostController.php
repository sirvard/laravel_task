<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use Auth;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Post $post, Category $category, User $user){
        $this->post = $post;
        $this->category = $category;
        $this->user = $user;
    }

    public function index()
    {
        $posts = [];
        $user = $this->user->where('id', Auth::id())->first();
        $categories_ids = $user->categories->pluck('id')->toArray();
        $posts = $this->post->whereIn('category_id', $categories_ids)->get();
        return view('post', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('fail', "Fill all fields!");
        }

        $post = $request->input('post');
        $category_id = $request->input('category_id');
        $resp = $this->post->create([
            'post'        => $post,
            'category_id' => $category_id,
        ]);

        if ($resp) {
            return redirect()->back()->with('yes', 'Post has added successfully!');
        } else {
            return redirect()->back->with('fail', 'Something went wrong!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $new_post = $request->input('edit_post');
        $response = $this->post->where('id', $id)->update(['post' => $new_post]);

        if ($response) {
            return redirect()->back()->with('edited', "Post has edited successfully!");
        } else {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->post->where('id', $id)->delete();

        if ($res) {
            return redirect()->back();
        }
    }
}
