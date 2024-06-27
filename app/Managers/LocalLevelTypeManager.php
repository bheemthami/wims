<?php

namespace App\Managers;

use App\Models\LocalLevelType;

class LocalLevelTypeManager
{
	protected $localleveltype;

	public function __construct(LocalLevelType $localleveltype)
	{
		$this->localleveltype = $localleveltype;
	}

	public function dropdown(){
		return [null => '--select--'] + $this->localleveltype::pluck('type_name','id')->toArray();
	}
}
