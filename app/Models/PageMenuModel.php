<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class PageMenuModel extends Authenticatable
{
  use SoftDeletes;

  protected $table = 'pages_menu';

  protected $keyType = 'string';

  protected $fillable = [
    'id',
    'section_menu_id',
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

  function sectionMenu()
	{
		return $this->hasOne('\App\Models\SectionMenuModel', 'id', 'section_menu_id');
	}
}
