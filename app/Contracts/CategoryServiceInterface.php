<?php 

namespace App\Contracts;

interface CategoryServiceInterface 
{
	public function getCategoriesByUserId($id);
	
	public function storeCategory($category_name);

	public function updateCategoryName($id, $newCategoryName);

	public function deleteCategory($id);
}
