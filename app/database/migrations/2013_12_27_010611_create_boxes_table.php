<?php

use Illuminate\Database\Migrations\Migration;

class CreateBoxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('boxes', function($t)
		{
            $t->increments('id');
            $t->integer('author_id')->nullable();
            $t->string('name', 120);
            $t->string('description');
            $t->string('document', 120);
            $t->text('code');
            $t->integer('comment_count');
            $t->integer('view_count');
            $t->integer('download_count');
            $t->integer('forked_count');
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
		Schema::drop('boxes');
	}

}