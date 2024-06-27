<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','image','attachment','summary','description','status','order','quota','duration','eligibility'];

    protected $table = 'programs';

}
