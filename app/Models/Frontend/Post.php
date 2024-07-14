<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'summary', 'image', 'attachment', 'order', 'status', 'date', 'user_id', 'academic_year_id', 'post_category_id', 'show_on_modal'];

    protected $table = 'posts';


    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function postCategory()
    {
        return $this->belongsTo('App\Models\Frontend\PostCategory');
    }
}
