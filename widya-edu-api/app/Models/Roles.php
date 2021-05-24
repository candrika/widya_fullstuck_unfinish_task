<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = "roles";

    protected $primaryKey = "roles_id";

    public function users()
    {
        return $this->hasOne('App\Models\Users');
    }
}
