<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embed extends Model
{
    use HasFactory;

    protected $fillable = ['type','title','iframe','status'];


    protected $table = 'embeds';
}
