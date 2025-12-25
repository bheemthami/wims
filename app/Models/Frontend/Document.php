<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'attachment', 'order', 'status', 'summary', 'academic_year_id', 'document_type_id', 'user_id', 'date'];

    protected $table = 'documents';

    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYear');
    }

    public function documentType()
    {
        return $this->belongsTo('App\Models\Frontend\DocumentType');
    }
}
