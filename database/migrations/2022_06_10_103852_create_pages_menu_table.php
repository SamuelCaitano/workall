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
    if (!Schema::hasTable('pages_menu')) {
      Schema::create('pages_menu', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('name', 32)->nullable();
        $table->foreignUuid('section_menu_id')->constrained('section_menu')->onDelete('cascade')->onUpdate('cascade')->nullable();
        $table->string('key', 32)->nullable();
        $table->string('icon', 32)->nullable();
        $table->string('sequence', 64)->nullable();  

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
    Schema::dropIfExists('pages_menu');
  }
};
