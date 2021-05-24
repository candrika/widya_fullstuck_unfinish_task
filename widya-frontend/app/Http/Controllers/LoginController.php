<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Client;
use Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class LoginController extends Controller
{
    //
    private $request;

    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    public function index()
    {

        return view('login');
    }

    public function LoginProcess(Request $request)
    {
        // dd($request);

        $roles = [
            'username' => 'required|String',
            'password' => 'required'
        ];

        $message = [
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong'
        ];

        $valid = Validator::make($request->all(), $roles, $message);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)
                ->withInput();
        }

        $response = Http::post('http://localhost:8000/auth/login', [
            'username' => $this->request->input('username'),
            'password' => $this->request->input('password')
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        if ($response['status'] == true) {
            $this->token_decode($response['token']);
            return redirect('dashboard');
        } else {
            // echo json_encode($response);
            return redirect()->back();
        }
    }

    public function RedirectToGoogle()
    {
        $response = Http::get('http://localhost:8000/auth/google', [
            'username' => 'ekacandrika@gmail.com',
            'password' => 'nasipadang'
        ]);

        echo $response->getBody();
    }

    public function token_decode($token)
    {
        try {
            $credencial = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            $userdata = json_decode(json_encode($credencial), true);
            $userdata['userdata']['apiToken'] = $token;
            session($userdata['userdata']);
            // session(['apiToken' => $token]);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'Token kadaluarsa'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error saat decode token'
            ], 400);
        }
    }

    public function Logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
