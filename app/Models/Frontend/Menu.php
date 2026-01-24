<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'label',
        'url',
        'position',
        'icon',
        'parent_id',
        'is_active',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
