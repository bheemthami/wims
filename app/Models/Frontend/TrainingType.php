<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','status','order'];

    protected $table = 'training_types';

    public function trainings()
    {
        return $this->hasMany('App\Models\Frontend\Training');
    }
}
