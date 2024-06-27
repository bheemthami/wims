<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','order','gallery_id'];

    protected $table = 'images';


    public function gallery()
    {
       return $this->belongsTo('App\Models\Frontend\Gallery');
    }
}
