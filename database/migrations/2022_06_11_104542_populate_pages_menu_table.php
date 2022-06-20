<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 
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
		DB::table('pages_menu')->updateOrInsert( [
			'id' => Str::uuid(),
			'name' => 'Permissoẽs de acesso',
			'section_menu_id' => '2s6be19e-576e-4896-bdf2-1c8ad1fe4820',
			'key' => 'permission',
			'icon' => 'fa-solid fa-key', 
			'sequence' => '1',  
		]);

		DB::table('pages_menu')->updateOrInsert( [
			'id' => Str::uuid(),
			'name' => 'Seção do Menu',
			'section_menu_id' => '7b6be19e-576e-4896-bdf2-1c8ad1fe4820',
			'key' => 'sectionMenu',
			'icon' => 'fa-solid fa-table-columns', 
			'sequence' => '1',  
		]);

		DB::table('pages_menu')->updateOrInsert( [
			'id' => Str::uuid(),
			'name' => 'Página do Menu',
			'section_menu_id' => '7b6be19e-576e-4896-bdf2-1c8ad1fe4820',
			'key' => 'pageMenu',
			'icon' => 'fa-solid fa-file', 
			'sequence' => '2',  
		]);

		DB::table('pages_menu')->updateOrInsert( [
			'id' => Str::uuid(),
			'name' => 'Perfil',
			'section_menu_id' => '2dcdb6ad-72b9-4b1e-a256-9f1f1713b31f',
			'key' => 'userProfile',
			'icon' => 'fa-solid fa-address-card',
			'sequence' => '1',    
		]);

		DB::table('pages_menu')->updateOrInsert( [
			'id' => Str::uuid(),
			'name' => 'Usuário',
			'section_menu_id' => '2dcdb6ad-72b9-4b1e-a256-9f1f1713b31f',
			'key' => 'user',
			'icon' => 'fa-solid fa-user', 
			'sequence' => '2',  
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
