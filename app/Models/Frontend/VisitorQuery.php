<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorQuery extends Model
{
    use HasFactory;


    protected $table = 'visitor_queries';

    protected $fillable = ['academic_year_id','qid','name','email','phone','subject','message','status'];

    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }
}
