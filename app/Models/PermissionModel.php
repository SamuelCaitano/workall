<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PermissionModel extends Authenticatable
{
  use SoftDeletes;

  protected $table = 'permission';

  protected $keyType = 'string';

  protected $fillable = [
    'id',
    'user_profile_id',
    'section_menu_id',
    'page_menu_id',
    'create',
    'update',
    'read',
    'delete', 
  ];

  function setIdAttribute($val)
  {
    if (empty($val)) {
      $this->attributes['id'] = Str::uuid();
    }
  }

  function pageMenu() {
    return $this->hasMany('\App\Models\PageMenuModel', 'section_menu_id', 'id');
  } 
}
