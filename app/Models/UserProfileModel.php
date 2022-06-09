<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class UserProfileModel extends Authenticatable
{
  use SoftDeletes;
 
  protected $table = 'user_profiles';

  protected $keyType = 'string';

  protected $fillable = [
    'id',
    'name',
    'level', 
  ];

  function setIdAttribute($val) {
		if (empty($val)) {
			$this->attributes['id'] = Str::uuid();
		}
	}
 
}
