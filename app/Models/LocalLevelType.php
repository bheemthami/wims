<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalLevelType extends Model
{
	protected $table = 'local_level_types';

	protected $fillable = ['type_name','type_name_short','order','slug'];
}
