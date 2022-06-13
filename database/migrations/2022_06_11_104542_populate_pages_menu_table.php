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
		DB::table('pages_menu')->updateOrInsert( [
			'id' => Str::uuid(),
			'section_menu_id' => 'eed1f9bf-33ae-4693-bba3-571605482c6d',
			'key' => 'profile',
			'name' => 'Perfil',
			'icon' => 'teste',
			'sequence' => '1', 
			'controller' => 'teste',  
		]);

		DB::table('pages_menu')->updateOrInsert( [
			'id' => Str::uuid(),
			'section_menu_id' => 'eed1f9bf-33ae-4693-bba3-571605482c6d',
			'key' => 'user',
			'name' => 'Usuário',
			'icon' => 'teste', 
			'sequence' => '2',
			'controller' => 'teste', 
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
