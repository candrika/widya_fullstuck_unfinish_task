<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->increments('evaluasi_id');
            $table->text('evaluasi_content_text');
            $table->text('evaluasi_content_img');
            $table->text('pilhan_ganda_satu');
            $table->text('pilihan_ganda_dua');
            $table->text('pilihan_ganda_tiga');
            $table->text('pilihan_ganda_empat');
            $table->integer('master_bank_soal_id');
            $table->smallInteger('display')->nullable();
            $table->nullableTimestamps();
            $table->foreign('master_bank_soal_id')->references('master_bank_soal_id')->on('master_bank_soal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluasi');
    }
}
