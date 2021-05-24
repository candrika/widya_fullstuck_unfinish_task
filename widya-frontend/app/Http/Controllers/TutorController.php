<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TutorController extends Controller
{
    //
    private $request;

    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    public function index(Request $request)
    {
        $response = Http::withHeaders(['x-token' => $request->session()->get('apiToken')])->get('http://localhost:8000/tutor/lists');

        $response = json_decode($response->getBody()->getContents(), true);
        // print_r($response);
        return view('tutor/tutor', ['data' => $response['data']]);
    }

    public function add(Request $request)
    {

        $response = Http::withHeaders(['x-token' => $request->session()->get('apiToken')])->get('http://localhost:8000/roles');
        $response = json_decode($response->getBody()->getContents(), true);
        return view('tutor/add', ['data' => $response]);
    }

    public function save(Request $request)
    {
        $response = Http::withHeaders(['x-token' => $request->session()->get('apiToken')])->post('http://localhost:8000/tutor/add', [
            "tutor_name" => $request->input('nama'),
            "tutor_email" => $request->input('email'),
            "roles" => $request->input("roles"),
            "tutor_address" => $request->input("alamat")
        ]);

        echo $response->getBody();
    }

    public function edit(Request $request)
    {
        $response1 = Http::withHeaders(['x-token' => $request->session()->get('apiToken')])->get('http://localhost:8000/roles');
        $response1 = json_decode($response1->getBody()->getContents(), true);

        $roles = $response1[1];

        $response = Http::withHeaders(['x-token' => $request->session()->get('apiToken')])->get('http://localhost:8000/tutor/list', [
            "id" => $request->input('id'),
        ]);
        $response = json_decode($response->getBody()->getContents(), true);

        $data['roles_id'] =  $roles['roles_id'];
        $data['roles_name'] =  $roles['roles_name'];
        $data['tutor_id'] =  $response['data'][0]['tutor_id'];
        $data['tutor_name'] =  $response['data'][0]['tutor_name'];
        $data['tutor_email'] =  $response['data'][0]['tutor_email'];
        $data['tutor_address'] =  $response['data'][0]['tutor_address'];
                
        return view('tutor/edit', ['data' => $data]);
    }
}
