<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBankSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_bank_soal', function (Blueprint $table) {
            $table->increments('master_bank_soal_id');
            $table->integer('jumlah_soal');
            $table->integer('durasi');
            $table->string('descripsi');
            $table->smallInteger('display')->nullable();
            $table->integer('mapel_id');
            $table->integer('tutor_id');
            $table->nullableTimestamps(0);
            $table->foreign('mapel_id')->references('mapel_id')->on('mapel');
            $table->foreign('tutor_id')->references('tutor_id')->on('tutor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_bank_soal');
    }
}
