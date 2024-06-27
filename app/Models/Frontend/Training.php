<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','image','attachment','summary','description','status','order','training_category_id','training_type_id','quota','duration','eligibility'];

    protected $table = 'trainings';

    public function trainingCategory()
    {
        return $this->belongsTo('App\Models\Frontend\TrainingCategory');
    }

    public function trainingType()
    {
        return $this->belongsTo('App\Models\Frontend\TrainingType');
    }

}
