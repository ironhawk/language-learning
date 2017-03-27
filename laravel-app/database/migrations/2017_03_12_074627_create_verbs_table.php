<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verbs', function (Blueprint $table) {
            $table->unsignedInteger('id', true);


            $table->string('s1', 64)->nullable()->comment('E/1 form');
            $table->string('s2', 64)->nullable()->comment('E/2 form');
            $table->string('s3', 64)->nullable()->comment('E/3 form');
            $table->string('m1', 64)->nullable()->comment('T/1 form');
            $table->string('m2', 64)->nullable()->comment('T/2 form');
            $table->string('m3', 64)->nullable()->comment('T/3 form');
            
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
        Schema::dropIfExists('verbs');
    }
}
