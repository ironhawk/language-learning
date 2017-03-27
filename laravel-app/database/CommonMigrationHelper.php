<?php

use Illuminate\Database\Schema\Blueprint;

class CommonMigrationHelper
{
	public static function addCommonWordFields(Blueprint $table) {
		
		$table->string('hu', 64)->comment('in Hungarian');
		$table->string('foreign', 64)->comment('in Foreign language');
		$table->string('specialties', 128)->nullable()->comment('any markers which are special with this verb in the foreign language');
		
		$table->unsignedInteger('book_id');
		$table->smallInteger('lesson')->nullable()->comment('# of the lesson it belongs to');
		$table->smallInteger('level');
		$table->text('comment')->nullable()->comment('free text comment');
		
		$table->foreign('book_id')->references('id')->on('book')->onDelete('cascade');		
	}

}
