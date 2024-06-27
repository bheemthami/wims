<?php

namespace App\Managers;

use App\Models\Setting;

class SettingManager
{
	protected $setting;

	public function __construct(Setting $setting)
	{
		$this->setting = $setting;
	}

	public function defaultSetting(){
		return $this->settings = Setting::select('settings.*')->join('academic_years','settings.academic_year_id','=','academic_years.id')->first();
	}


	public function count(){
		return $this->settings = Setting::count();
	}


}
