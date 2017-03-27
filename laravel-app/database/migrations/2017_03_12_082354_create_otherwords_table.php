<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherwordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_words', function (Blueprint $table) {
        	$table->unsignedInteger('id', true);
        	
        	$table->string('type', 16)->nullable();
        	 
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
        Schema::dropIfExists('other_words');
    }
}
