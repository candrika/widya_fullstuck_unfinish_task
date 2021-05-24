<?php

use Illuminate\Support\Str;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/random-key', function () {
    return Str::random(60);
});

$router->post(
    'auth/login',
    [
        'uses' => 'AuthController@authenticate'
    ]
);

$router->get('auth/google', 'AuthController@redirectToGoogle');
$router->get('auth/google/callback', 'AuthController@handleProviderCallback');



$router->get('/banksoal/list', 'BankSoalController@BankSoalEdit');

$router->group(
    ['middleware' => 'jwt.auth'],
    function () use ($router) {
        # code...
        //api config
        $router->get('/menu', 'ConfigController@getMenu');
        $router->get('/roles', 'ConfigController@getRoles');
        $router->get('/mapel', 'ConfigController@getMapel');

        //admin services
        $router->get('/tutor/lists', 'MasterTutorController@MasterTutor');
        $router->get('/tutor/list', 'MasterTutorController@MasterTutorEdit');
        $router->post('/tutor/add', 'MasterTutorController@MasterTutorAdd');
        $router->put('/tutor/update', 'MasterTutorController@MasterTutorUpdate');
        $router->delete('/tutor/delete/{id}', 'MasterTutorController@MasterTutorDelete');

        //tutor service
        $router->get('/banksoal/lists', 'BankSoalController@BankSoal');
        $router->post('/banksoal/add', 'BankSoalController@BankSoalAdd');
        $router->put('/banksoal/update', 'BankSoalController@BankSoalUpdate');
        $router->delete('/banksoal/delete/{id}', 'BankSoalController@BankSoalDelete');

        //evaluasi service
        $router->get('/evaluasi/lists', 'BankSoalController@EvaluasiAll');
        $router->get('/evaluasi/list', 'BankSoalController@EvaluasiList');
        $router->put('/evaluasi/update', 'BankSoalController@EvaluasiUpdate');
        $router->delete('/evaluasi/delete/{id}', 'BankSoalController@EvaluasiDelete');
    }
);
