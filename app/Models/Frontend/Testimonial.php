<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['statement_by','recognition','statement','image','remarks','status','order'];

    protected $table = 'testimonials';
}
