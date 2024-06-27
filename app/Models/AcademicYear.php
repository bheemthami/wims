<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
	protected $fillable = ['year','school_open_days','no_of_exams','year_eng','grading_system_id'];

	protected $table = 'academic_years';

}
