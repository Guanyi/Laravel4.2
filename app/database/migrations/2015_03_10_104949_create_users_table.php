<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->string('id', 50)->unique()->primary();
            $table->string('password', 60);
            $table->boolean('active')->default(0);
            $table->integer('failedLoginNum')->default(0);
            $table->string('notes', 300)->nullable();
            $table->string('tbd', 300)->nullable();
            $table->string('hyperlink1', 100)->nullable();
            $table->string('hyperlink2', 100)->nullable();
            $table->string('hyperlink3', 100)->nullable();
            $table->string('hyperlink4', 100)->nullable();
            $table->string('hyperlink5', 100)->nullable();
            $table->string('hyperlink6', 100)->nullable();
            $table->string('hyperlink7', 100)->nullable();
            $table->string('hyperlink8', 100)->nullable();
            $table->binary('image1')->nullable();
            $table->binary('image2')->nullable();
            $table->binary('image3')->nullable();
            $table->binary('image4')->nullable();
            $table->rememberToken()->nullable();
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
		Schema::drop('users');
	}
}
