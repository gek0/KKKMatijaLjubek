<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create users table
        Schema::create('users', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('username', 20)->unique();
            $table->string('email', 50)->unique();
            $table->string('password', 60);
            $table->string('remember_token', 100);
            $table->timestamps();
        });

        //create persons table
        Schema::create('persons', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('person_full_name', 255)->unique();
            $table->text('person_description');
            $table->date('person_birthday');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('person_category');
            $table->enum('is_athlete', array('yes', 'no'))->default('yes');
            $table->string('slug', 255);
            $table->timestamps();
        });

        //create persons category table
        Schema::create('person_category', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('category_name', 100)->unique();
        });

        //create persons image table
        Schema::create('person_images', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('file_name', 255)->unique();
            $table->double('file_size', 15, 8);
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->timestamps();
        });

        //create gallery images table
        Schema::create('gallery_images', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('file_name', 255)->unique();
            $table->double('file_size', 15, 8);
            $table->string('caption', 255);
            $table->timestamps();
        });

        //create news table
        Schema::create('news', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('news_title', 255)->unique();
            $table->text('news_body');
            $table->integer('news_author')->unsigned();
            $table->foreign('news_author')->references('id')->on('users');
            $table->integer('num_visited')->unsigned();
            $table->string('slug', 255);
            $table->timestamps();
        });

        //create news images table
        Schema::create('news_images', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('file_name', 255)->unique();
            $table->double('file_size', 15, 8);
            $table->integer('news_id')->unsigned();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->timestamps();
        });

        //create tags table
        Schema::create('tags', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('tag', 50);
            $table->string('slug', 255);
            $table->timestamps();
        });

        Schema::create('news_tag', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('news_id')->unsigned();
            $table->foreign('news_id')->references('id')->on('news');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//drop database
        Schema::drop('users');

        Schema::drop('persons');
        Schema::drop('person_category');
        Schema::drop('person_images');

        Schema::drop('gallery_images');

        Schema::drop('news');
        Schema::drop('news_images');

        Schema::drop('tags');

        Schema::drop('news_tag');
	}

}
