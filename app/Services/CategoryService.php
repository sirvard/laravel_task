<?php 

namespace App\Services;

use App\Contracts\CategoryServiceInterface;
use App\Category;
use Auth;

class CategoryService implements CategoryServiceInterface
{
	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	public function getCategoriesByUserId($id)
	{
		return $this->category->where('user_id', $id)->get();
	}
	
	public function storeCategory($category_name)
	{
		$user_id = Auth::user()->id;
		return $this->category->create([
			'category_name'	=>	$category_name,
			'user_id'		=>	$user_id
		]);
	}

	public function updateCategoryName($id, $newCategoryName)
	{
		return $this->category->where('id', $id)
				->update(['category_name' => $newCategoryName]);
	}

	public function deleteCategory($id)
	{
		return $this->category->where('id', $id)->delete();
	}

	public function getCategoriesById($id) 
	{
		return $this->category->find($id);
	}
}
