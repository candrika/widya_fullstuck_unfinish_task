<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    protected $table = "user_menu";
    // protected $primaryKey = ''

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
