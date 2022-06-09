<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		DB::table('user_profiles')->updateOrInsert([ 'id' => 'eed1f9bf-33ae-4693-bba3-571605482c6d'], [
			'name' => 'Administrador',
			'level' => 1,
		]);

		DB::table('user_profiles')->updateOrInsert([ 'id' => '2baecd95-7006-42e0-afcc-cd0088648a4a' ], [
			'name' => 'Usuário',
			'level' => 2,
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
