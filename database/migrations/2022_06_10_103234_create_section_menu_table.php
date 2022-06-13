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
        if (!Schema::hasTable('section_menu')){
            Schema::create('section_menu', function (Blueprint $table) {
                $table->uuid('id')->primary(); 
                $table->string('key', 32)->nullable();
                $table->string('name', 32)->nullable();
                $table->string('icon', 32)->nullable();
                $table->integer('sequence')->nullable(); 
                $table->integer('controller')->nullable();                 
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
        Schema::dropIfExists('section_menu');
    }
};
