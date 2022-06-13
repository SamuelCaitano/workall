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
			'id' => Str::uuid(), 
			'key' => 'userConfig',
			'name' => 'Config. Usuário',
			'icon' => 'teste', 
			'sequence' => '1', 
			'controller' => '1'
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
