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
use Illuminate\Support\Str;

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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        $providerUser = Socialite::driver('google')->stateless()->user();

        // echo "<pre/>";
        // print_r($providerUser->email);

        $tutor = DB::table('tutor')->where('tutor_email', $providerUser->email)->where('roles_id', 1);
        ($tutor);
        // die;
        if (count($tutor->get()) > 0) {

            $tutor = $tutor->first();

            $user = User::where('username', $providerUser->email);

            $user_data = [
                'username' => $tutor->tutor_email,
                'realname' => $tutor->tutor_name,
                'password' => '123456678',
                'roles_id' => $tutor->roles_id,
            ];

            // print_r($user_data);

            if (count($user->get()) > 0) {
                User::create($user_data);
            }

            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'token' => $this->jwt($user)
            ], 200);
        } else {
            //
            
            return response()->json([
                'status' => false,
                'message' => 'Email anda belum terdaftar sebagai tutor'
            ], 404);
        }


        /* 
         return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'token' => $this->jwt($user)
            ], 200);
        */
    }
}
