<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickLink extends Model
{
    use HasFactory;

    protected $fillable = ['title','link','status','order','type'];

    protected $table = 'quick_links';


}
