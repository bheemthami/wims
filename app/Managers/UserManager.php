<?php

namespace App\Managers;

use App\User;

class UserManager
{
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function count($status = null){
		return $this->user::count();
	}
}
