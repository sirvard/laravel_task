<?php 

namespace App\Services;

use App\Contracts\PostServiceInterface;
use Auth;
use App\User;
use App\Category;
use App\Post;

class PostService implements PostServiceInterface 
{
	public function __construct(User $user, Category $category, Post $post)
	{
		$this->user = $user;
		$this->category = $category;
		$this->post = $post;
	}

	public function getAllPosts(array $categories_ids)
	{
		$user = $this->user->where('id', Auth::id())->first();
		$ids = $user->categories->pluck('id')->toArray();
		return $this->post->whereIn('category_id', $ids)->paginate(4)->all();
	}

	public function getAllPostsInArray(array $ids)
	{		
		$user = $this->user->where('id', Auth::id())->first();
		$ids = $user->categories->pluck('id')->toArray();
		return $this->post->whereIn('category_id', $ids)->paginate(4);
	}

	public function storePost($category_id, $post)
	{
		return	$this->post->create([
            'post'        => $post,
            'category_id' => $category_id,
        ]);
	}

	public function editPost($id, $new_post)
	{
		return $this->post->where('id', $id)->update(['post' => $new_post]);
	}

	public function deletePost($id)
	{
		return $this->post->where('id', $id)->delete();
	}
	public function getPostsById($id) 
	{
		return $this->post->find($id);
	}
}