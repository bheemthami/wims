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

	public function count($status = null)
	{
		$query = $this->user::select('*');

		if ($status) {
			$query->where(['status' => $status]);
		}

		return $query->count();
	}
}
