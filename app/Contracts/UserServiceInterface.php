<?php 

namespace App\Contracts;

interface UserServiceInterface 
{
	public function updateProfilePicture($id, $image);
}
