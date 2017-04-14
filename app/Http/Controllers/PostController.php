<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use Auth;
use Validator;
use App\Contracts\PostServiceInterface;

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

    public function index(PostServiceInterface $post_service)
    {   
        $posts = []; 
        $posts = $post_service->getAllPosts($posts);
        $posts_array = $post_service->getAllPostsInArray($posts);
        return view('post', ['posts' => $posts, 'paginate' => $posts_array]);
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
    public function store(Request $request, PostServiceInterface $post_service)
    {
        $validator = Validator::make($request->all(), [
            'post' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('fail', "Fill all fields!");
        }

        $post = $request->input('post');
        $category_id = $request->input('category_id');
        $response = $post_service->storePost($category_id,$post);

        if ($response) {
            return redirect()->back()->with('yes', 'Post has added successfully!');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong!');
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
    public function update(Request $request, PostServiceInterface $post_service, $id)
    {
        $new_post = $request->input('edit_post');
        $response = $post_service->editPost($id, $new_post);

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
    public function destroy(PostServiceInterface $post_service, $id)
    {
        $res = $post_service->deletePost($id);

        if ($res) {
            return redirect()->back()->with('msg', 'Post has deleted successfully!');
        }
    }
}
