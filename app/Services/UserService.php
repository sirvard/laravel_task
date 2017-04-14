<?php 

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\User;
use Auth;

class UserService implements UserServiceInterface
{
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function updateProfilePicture($id, $image)
	{	
		$imagename = time() . '.' . $image->extension();
		$image->move(public_path() . '/images/', $imagename);
		return $this->user->where('id', $id)->update(['avatar' => $imagename]);
	}
}
