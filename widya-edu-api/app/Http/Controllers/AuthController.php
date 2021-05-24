<?php

namespace App\Http\Controllers;

use App\Models\User;
use Validator;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function jwt(User $user)
    {
        $paylaod = [
            'iss' => 'lumen-jwt',
            'userdata' => $user,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        return JWT::encode($paylaod, env('JWT_SECRET'));
    }

    public function authenticate(Request $request)
    {

        $roles = [
            'username' => 'required|String',
            'password' => 'required|String|min:6'
        ];

        $message = [
            'username.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return response()->json(['status' => 'false', 'message' => $valid->errors()], 500);
        }

        // DB::enableQueryLog();
        $user = User::select('*')
            ->join('roles', 'roles.roles_id', '=', 'users.roles_id')
            ->Where('username', $this->request->input('username'))
            ->Where('password', $this->request->input('password'))->first();
        // dd(DB::getQueryLog());
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Email yang anda masukan salah atau belum terdaftar'
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'token' => $this->jwt($user)
            ], 200);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        $providerUser = Socialite::driver('google')->stateless()->user();

        // print_r($providerUser);
        //update table user
    }
}
