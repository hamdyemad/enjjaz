<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['0', '1']);
            $table->string('number')->nullable();
            $table->string('address')->nullable();
            $table->integer('count')->nullable();
            $table->double('price');
            $table->integer('shipping');
            $table->string('client');
            $table->text('notes')->nullable();
            $table->text('about_period')->nullable();
            $table->string('days_count')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('tracks');
    }
}
