<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMenu;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getMenu(Request $request)
    {

        if ($this->request->input('roles_id') != null) {
            $menu = UserMenu::select("*")
                ->join('menu', 'user_menu.menu_id', '=', 'menu.menu_id')
                ->join('roles', 'user_menu.roles_id', '=', 'roles.roles_id')
                ->where('user_menu.roles_id', $this->request->input('roles_id'));
        } else {
            $menu = UserMenu::select("*")
                ->join('menu', 'user_menu.menu_id', '=', 'menu.menu_id')
                ->join('roles', 'user_menu.roles_id', '=', 'roles.roles_id');
        }

        $user_menu = $menu->get();

        // dd(DB::getQueryLog());

        return response()->json($user_menu, 200);
    }

    public function getRoles(Request $request)
    {
        $roles = Roles::All();

        return response()->json($roles, 200);
    }

    public function getMapel()
    {
        $mapel = DB::table('mapel')->whereNull('display')->get();
        // dd($mapel);
        if (count($mapel) === 0) {
            return response()->json([
                'status' => 'false',
                'message' => 'Mata Pelajar tidak temukan',
                'data' => $mapel,
                'record' => count($mapel)
            ], 400);
        }

        return response()->json([
            'status' => 'true',
            'message' => 'Mata Pelajar berhasil temukan',
            'data' => $mapel,
            'record' => count($mapel)
        ], 200);
    }
}
