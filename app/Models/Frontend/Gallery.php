<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
  use HasFactory;

  protected $fillable = ['title','slug','summary','status','date','type','link','academic_year_id','is_slider','user_id'];

  protected $table = 'galleries';

  public function images()
  {
     return $this->hasMany('App\Models\Frontend\Image');
  }

  public function academicYear()
  {
   return $this->belongsTo('App\Models\AcademicYear');
  }
}
