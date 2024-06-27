<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','order','status'];

    protected $table = 'departments';

    public function officials(){
        return $this->hasMany('App/Models/Teacher','teacher_id','id');
    }
}
