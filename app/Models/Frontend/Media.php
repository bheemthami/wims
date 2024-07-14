<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = ['title', 'image'];

    public function taggable()
    {
        return $this->morphTo();
    }
}
