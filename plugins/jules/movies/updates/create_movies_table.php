<?php

namespace Jules\Movies\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('jules_movies_movies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->string('director');
            $table->string('year');
            $table->string('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jules_movies_movies');
    }
}
