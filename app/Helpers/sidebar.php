<?php

use App\Models\SectionMenuModel;

function sidebar() {

  $sidebar = SectionMenuModel::query()
  ->with('pageMenu', function ($query) {
    $query->select([ 'id', 'sequence', 'section_menu_id', 'key', 'name', 'icon' ]);
  })
<<<<<<< HEAD
  ->orderBy('sequence')->get([ 'id', 'sequence', 'key', 'name', 'icon' ]); 
  
=======
  ->orderBy('sequence')->get([ 'id', 'sequence', 'key', 'name', 'icon' ]);
 
>>>>>>> a77d27a61ed3b3e5d2e562f487c8991b1a62d441
  return $sidebar;

}