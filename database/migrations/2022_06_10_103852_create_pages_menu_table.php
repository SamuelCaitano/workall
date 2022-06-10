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
        Schema::create('pages_menu', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('section_menu_id')->references('id')->on('section_menu')->onDelete()->onUpdate();
            $table->string('key', 32)->nullable();
            $table->string('name', 32)->nullable();
            $table->string('icon', 32)->nullable();
            $table->string('controller', 64)->nullable();
        });
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
