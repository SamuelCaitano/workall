<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;  

class SectionMenuModel extends Authenticatable
{ 
    use SoftDeletes;
    
    protected $table = 'pages_menu';

    protected $keyType = 'string';

    protected $fillable = [
        'id',
				'key',
        'name',
        'icon',
        'controller', 
    ]; 
}
