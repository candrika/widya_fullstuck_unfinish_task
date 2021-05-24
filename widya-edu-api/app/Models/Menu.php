<?php

namespace App\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = "menu";

    protected $primaryKey = "menu_id";

    protected $fillable = [
        "menu_name",
        "parent",
        "link_menu",
        "display",
        "roles_id"
    ];

    public function usermenu()
    {
        return $this->hasOne('App\Models\UserMenu');
    }
}
