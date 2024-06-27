<?php

namespace App\Managers;

use App\Models\Designation;

class DesignationManager
{
	protected $designation;

	public function __construct(Designation $designation)
	{
		$this->designation = $designation;
	}

	public function dropdown(){
		return [null => '--select--'] + $this->designation->pluck('name','id')->toArray();
	}

	public function count(){
		return $this->designation::count();
	}


	public function findBySlug($slug){
		return $this->designation::where(['slug'=>$slug])->first();
	}
}
