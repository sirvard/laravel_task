<?php 

namespace App\Contracts;

interface PostServiceInterface
{
	public function getAllPosts(array $categories_ids);

	public function getAllPostsInArray(array $ids);

	public function storePost($category_id, $post);

	public function editPost($id, $new_post);

	public function deletePost($id);
}
