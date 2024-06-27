<?php

namespace App\Managers;


use App\Models\Setting;
use App\Models\AcademicYear;

class CommonDataManager
{


	public function linkTypeDropdown(){
		return ['header'=>'header','footer'=>'footer','body'=>'body'];
	}

	public function genderDropdown(){
		return [null=>'--select--','Male'=>'Male','Female'=>'Female','Other'=>'Other'];
	}

	public function degreeStatusDropdown(){
		return [null=>'--select--','Running'=>'Running','Completed'=>'Completed'];
	}

	public function statusDropdown(){
		return [null=>'--select--',1=>'Active', 0 =>'Inactive'];
	}

	public function yesNoDropdown(){
		return [null=>'--select--',1=>'YES', 0 =>'NO'];
	}


	public function publishStatusDropdown(){
		return [null=>'--select--',1 =>'Published',0=>'Draft'];
	}

	public function galleryTypeDropdown(){
		return [
			null => '--Select--',
			'image' => 'Image', 
			'video' => 'Video'
		];
	}

	public function socialSiteTypeDropdown(){
		return [
			null => '--Select--',
			'facebook-page' => 'Facebook Page', 
			'twitter-handle' => 'Twitter Handle',
			'google-map' => 'Google Map',
		];
	}

}
