<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = "tutor";
    protected $primaryKey = "tutor_id";
    protected $fillable = ["tutor_name", "tutor_gender", "tutor_address", "tutor_email"];
}
