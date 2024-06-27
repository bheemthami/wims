<?php

namespace App\Managers;

use App\Models\AcademicYear;

class AcademicYearManager
{
	protected $academicYear;

	public function __construct(AcademicYear $academicYear)
	{
		$this->academicYear = $academicYear;
	}

	public function count(){
		return $this->academicYear::count();
	}

	public function dropdown(){
		return [null => '----'] + $this->academicYear::orderBy('year','DESC')->pluck('year','id')->toArray();
	}

	public function find($yid){
		return $this->academicYear::find($yid);
	}


	public function previousYear($yid){
		$current_year  = $this->academicYear->find($yid);
		$previousYear = $this->academicYear->where(['year'=>$current_year->year-1])->first();
		return $previousYear;
	}
}
