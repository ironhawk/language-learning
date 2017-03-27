<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNounsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nouns', function (Blueprint $table) {
        	$table->unsignedInteger('id', true);
        	
        	$table->string('definite_article', 64)->nullable()->comment('hatarozott nevelo');
        	$table->string('indefinite_article', 64)->nullable()->comment('hatarozatlan nevelo');
        	$table->string('plural', 64)->nullable()->comment('tobbesszam');
        	
        	 
        	// lets add all fields necessary
        	CommonMigrationHelper::addCommonWordFields($table);
        	
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nouns');
    }
}
