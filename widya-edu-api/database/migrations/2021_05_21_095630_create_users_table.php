<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('userid');
            $table->string('username', 100);
            $table->string('realname', 100);
            $table->string('password', 100);
            $table->unsignedInteger('roles_id');
            $table->nullableTimestamps(0);
            $table->smallInteger('display')->nullable(0);
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
        Schema::dropIfExists('users');
    }
}
