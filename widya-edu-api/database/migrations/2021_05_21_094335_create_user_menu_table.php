<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menu', function (Blueprint $table) {
            $table->integer('menu_id');
            $table->integer('roles_id');
            $table->nullableTimestamps(0);
            $table->foreign('menu_id')->references('menu_id')->on('menu');
            $table->foreign('roles_id')->references('roles_id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_menu');
    }
}
