<?php

use Illuminate\Database\Migrations\Migration;

class CreatePasteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pastes', function($t)
		{
            $t->increments('id');
            $t->integer('author_id')->nullable();
            $t->integer('parent_id')->nullable();
            $t->text('code');
            $t->integer('comment_count');
            $t->integer('child_count');
            $t->integer('view_count');
            $t->dateTime('last_viewed');
            $t->timestamps();
            $t->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pastes');
	}

}