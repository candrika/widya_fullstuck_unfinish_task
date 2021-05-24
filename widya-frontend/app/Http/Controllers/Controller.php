<?php

namespace App\Http\Controllers;

// require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $rest_client;

    public function __construct()
    {
        //$this->rest_client = new GuzzleHttp\Client(['base_uri' => API_URL,'curl' => array( CURLOPT_SSL_VERIFYPEER => false )]);
    }
}
