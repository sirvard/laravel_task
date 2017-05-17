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

    public function index(PostServiceInterface $postService)
    {   
        $posts = []; 
        $posts = $postService->getAllPosts($posts);
        $posts_array = $postService->getAllPostsInArray($posts);
        return response()->json(['status' => 'success', 'posts' => $posts]);   
        //return view('post', ['posts' => $posts, 'paginate' => $posts_array]);
    }

    public function getPost(PostServiceInterface $postService, $id)
    {
        $post = $postService->getPostsById($id);
        return response()->json(['status' => 'success', 'post' => $post]);   
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
    public function store(Request $request, PostServiceInterface $postService)
    {
        /*$validator = Validator::make($request->all(), [
            'post' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('fail', "Fill all fields!");
        }*/
        //dd($request->all());

        $post = $request->input('post');
        $category_id = $request->input('category');
        $response = $postService->storePost($category_id,$post);

        if ($response) {
            return response()->json(['status' => 'success', 'message' => 'Post added successfully!']); 
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);   
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
     * Update the specified resou
     rce in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostServiceInterface $postService, $id)
    {
        //dd($request->all());
        $new_post = $request->input('new_post');
        $response = $postService->editPost($id, $new_post);

        if ($response) {
            return response()->json(['status' => 'success', 'message' => 'Post edited successfully!']); 
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostServiceInterface $postService, $id)
    {
        $response = $postService->deletePost($id);
        if ($response) {
            return response()->json(['status' => 'success', 'message' => 'Post deleted successfully!']); 
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);   
        }
    }
}
