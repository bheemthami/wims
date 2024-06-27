<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','description','image','attachment','status','start_date','end_date','start_time','end_time','speaker','user_id','academic_year_id','remarks'];

    protected $table = 'events';


    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

}
