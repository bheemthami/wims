<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','image','status','order'];

    protected $table = 'training_categories';

    public function trainings()
    {
        return $this->hasMany('App\Models\Frontend\Training');
    }
}
