<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SectionMenuModel extends Authenticatable
{
  use SoftDeletes;

  protected $table = 'section_menu';

  protected $keyType = 'string';

  protected $fillable = [
    'id',
    'key',
    'name',
    'icon',
    'sequence', 
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
