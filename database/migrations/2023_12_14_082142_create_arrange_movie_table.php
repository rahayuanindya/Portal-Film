<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrangeMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrange_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theaters_id')->constrained('theaters');
            $table->foreignId('movies_id')->constrained('movies');
            $table->string('studio');
            $table->integer('price');
            $table->json('seats');
            $table->json('schedules');
            $table->enum('status', ['cooming soon', 'in theaters', 'finish']);
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
        Schema::dropIfExists('arrange_movie');
    }
}
