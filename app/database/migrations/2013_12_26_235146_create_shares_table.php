<?php

use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shares', function($t)
		{
            $t->increments('id');
            $t->integer('author_id')->nullable();
            $t->text('code');
            $t->integer('comment_count');
            $t->integer('view_count');
            $t->integer('download_count');
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
		Schema::drop('shares');
	}

}