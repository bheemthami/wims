<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','image','status','order'];

    protected $table = 'document_types';
}
