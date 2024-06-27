<?php

namespace App\Managers;

use App\Models\Role;

class RoleManager
{
	protected $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	public function dropdown(){
		return [null => '--select--'] + $this->role::pluck('name','id')->toArray();
	}

	public function count(){
		return $this->role::count();
	}
}
