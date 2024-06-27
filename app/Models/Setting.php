<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicYear;
use App\Models\Teacher;

class Setting extends Model
{
	protected $fillable = ['municipality','office','office_address','province_name','province_no','district_name','logo','local_logo','favicon','system_name','system_short_name','tag_line','academic_year_id'];

	protected $table = 'settings';

	public function academicYear(){
		return $this->belongsTo(AcademicYear::class,'academic_year_id','id');
	}

}
