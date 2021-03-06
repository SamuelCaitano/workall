<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('users')) {
			Schema::create('users', function (Blueprint $table) {
				$table->uuid('id')->primary();
				$table->string('name')->nullable();
				$table->string('username', 64)->nullable();
				$table->string('email')->unique();
				$table->timestamp('email_verified_at')->nullable();
				$table->string('password')->nullable();
				$table->foreignUuid('user_profile_id')->references('id')->on('user_profiles')->onUpdate('cascade')->onDelete('cascade');
				$table->rememberToken();
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
};
