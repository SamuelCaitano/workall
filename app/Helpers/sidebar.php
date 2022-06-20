<?php

use App\Models\SectionMenuModel;


/**
 * 
 * @return sections and pages
 * 
 */
function sidebar() {

  $sidebar = SectionMenuModel::query()
  ->with('pageMenu', function ($query) {
    $query->select([ 'id', 'sequence', 'section_menu_id', 'key', 'name', 'icon' ]);
  }) 
  ->orderBy('sequence')->get([ 'id', 'sequence', 'key', 'name', 'icon' ]); 
  
  return $sidebar;

}