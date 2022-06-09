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
		DB::table('users')->updateOrInsert([
			'username' => 'admin',
		], [
			'id' => Str::uuid(),
			'name' => 'Administrador',
			'email' => 'admin@email.com',
			'user_profile_id' => 'eed1f9bf-33ae-4693-bba3-571605482c6d',
			'password' => Hash::make('admin'),
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
