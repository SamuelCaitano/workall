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
    if (!Schema::hasTable('permission')) {
      Schema::create('permission', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('name', 32)->nullable();
        $table->foreignUuid('user_profile_id')->constrained('user_profiles')->onDelete('cascade')->onUpdate('cascade')->nullable(); 
        $table->foreignUuid('section_menu_id')->constrained('section_menu')->onDelete('cascade')->onUpdate('cascade')->nullable(); 
        $table->foreignUuid('page_menu_id')->constrained('pages_menu')->onDelete('cascade')->onUpdate('cascade')->nullable(); 
        $table->unsignedTinyInteger('create')->nullable();
        $table->unsignedTinyInteger('read')->nullable();
        $table->unsignedTinyInteger('update')->nullable();
        $table->unsignedTinyInteger('delete')->nullable();
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
    Schema::dropIfExists('permission');
  }
};
