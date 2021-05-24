<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	private $request;
	public function __construct()
	{
	}

	public function index(Request $request)
	{
		$response = Http::withHeaders(['x-token' => $request->session()->get('apiToken')])->get('http://localhost:8000/menu', [
			'roles_id' => $request->session()->get('roles_id'),
		]);

		$menu = json_decode($response->getBody()->getContents(), true);

		return view('master', ['menu' => $menu]);
	}
}
