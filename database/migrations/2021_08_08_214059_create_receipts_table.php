<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_name');
            $table->enum('type', ['0', '1', '2']);
            $table->integer('price')->nullable();
            $table->integer('all_price')->nullable();
            $table->integer('paid_price')->nullable();
            $table->integer('remain_price')->nullable();
            $table->string('price_kind')->nullable();
            $table->string('about')->nullable();
            $table->string('publication_address')->nullable();
            $table->string('publication_color')->nullable();
            $table->string('publication_pages_count')->nullable();
            $table->string('publication_type')->nullable();
            $table->string('publication_size')->nullable();
            $table->string('publication_time')->nullable();
            $table->string('book_heel')->nullable();
            $table->string('paper_size')->nullable();
            $table->string('publication_amount')->nullable();
            $table->string('publication_other')->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
