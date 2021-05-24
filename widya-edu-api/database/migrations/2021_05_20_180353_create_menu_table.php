<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->string('menu_name');
            $table->integer('parent');
            $table->string('link_menu');
            $table->smallInteger('display')->nullable(0);
            $table->nullableTimestamps(0);
            // $table->unsignedInteger('user_menu_id');
            // $table->foreign('menu_id')->references('menu_id')->on('user_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
