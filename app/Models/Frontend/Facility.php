<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','description','image','attachment','order','status','summary'];

    protected $table = 'facilities';
}
