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
			'email' => 'admin@gmail.com',
			'user_profile_id' => 'eed1f9bf-33ae-4693-bba3-571605482c6d',
			'password' => Hash::make('admin'),
		]);

		DB::table('users')->updateOrInsert([
			'username' => 'samucaitano',
		], [
			'id' => Str::uuid(),
			'name' => 'Samuel Caitano da silva',
			'email' => 'smlcaitano@gmail.com',
			'user_profile_id' => 'eed1f9bf-33ae-4693-bba3-571605482c6d',
			'password' => Hash::make('admin'),
		]);

		DB::table('users')->updateOrInsert([
			'username' => 'weslen',
		], [
			'id' => Str::uuid(),
			'name' => 'weslen',
			'email' => 'teste@gmail.com',
			'user_profile_id' => '2baecd95-7006-42e0-afcc-cd0088648a4a',
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
