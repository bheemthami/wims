<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
   use HasFactory;

   protected $fillable = [
      'academic_year_id',
      'first_name',
      'middle_name',
      'last_name',
      'dob',
      'gender',
      'district',
      'local_level_type_id',
      'designation_id',
      'department_id',
      'image',
      'municipality',
      'ward_no',
      'mobile',
      'email',
      'degree',
      'joining_date',
      'leaving_date',
      'working_status',
      'is_teaching_official',
      'status',
      'order'
   ];

   protected $table = 'officials';


   public function department()
   {
      return $this->belongsTo('App\Models\Frontend\Department');
   }

   public function designation()
   {
      return $this->belongsTo('App\Models\Designation');
   }

   public function localLevelType()
   {
      return $this->belongsTo('App\Models\LocalLevelType');
   }

   public function academicYear()
   {
      return $this->belongsTo('App\Models\AcademicYear');
   }
}
