<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('product');
            $table->float('price', 8, 2);
            $table->string('picture')->nullable();
            $table->string('store')->nullable();
            $table->string('store_link')->nullable();
            $table->string('access_key');
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
        Schema::dropIfExists('gift_lists');
    }
}
