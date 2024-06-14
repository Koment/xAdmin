<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->integer('artist_id');
            $table->string('cover');
            $table->string('track');
            $table->string('artist');
            $table->string('feat')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->date('relise');
            $table->boolean('obscense')->default(true);
            $table->string('jenre');
            $table->string('languge');
            $table->string('mus_author');
            $table->string('text_author');
            $table->text('song_text');
            $table->boolean('is_published')->default(false);
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
        Schema::dropIfExists('songs');
    }
}
