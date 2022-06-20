<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		DB::table('section_menu')->updateOrInsert( [
			'id' => '2dcdb6ad-72b9-4b1e-a256-9f1f1713b31f',			
			'name' => 'Config. Usuário', 
			'key' => 'userConfig',
			'icon' => 'fa-solid fa-users-gear', 
			'sequence' => '1',  
		]);

		DB::table('section_menu')->updateOrInsert( [
			'id' => '7b6be19e-576e-4896-bdf2-1c8ad1fe4820',			
			'name' => 'Config. Pág. Menu', 
			'key' => 'pageMenu',
			'icon' => 'fa-solid fa-folder-plus', 
			'sequence' => '2',  
		]);

		DB::table('section_menu')->updateOrInsert( [
			'id' => '2s6be19e-576e-4896-bdf2-1c8ad1fe4820',			
			'name' => 'Config. Permissoẽs', 
			'key' => 'authConfig',
			'icon' => 'fa-solid fa-unlock-keyhole', 
			'sequence' => '3',  
		]);
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
	}
};
