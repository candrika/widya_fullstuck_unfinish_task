<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;

class MasterBankSoal extends Model
{
    protected $table = "master_bank_soal";

    protected $primaryKey = "master_bank_soal_id";

    protected $fillable = [
        "jumlah_soal",
        "durasi",
        "descripsi",
        "mapel_id",
        "tutor_id"
    ];
}
