<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//default route laravel
// Route::get('/', function () {
// 	// $p=Redis::incr('p');
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\LoginController@RedirectToGoogle')->name('login');
ROute::post('/login/process', 'App\Http\Controllers\LoginController@LoginProcess');
Route::get('/login/google', 'App\Http\Controllers\LoginController@RedirectToGoogle')->name('login.google');
Route::get('/logout', 'App\Http\Controllers\LoginController@Logout');

//load dashboard
Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Route::get('/tutor/setting', 'App\Http\Controllers\TutorController@index');
Route::get('/tutor/add', 'App\Http\Controllers\TutorController@add');
Route::post('/tutor/add', 'App\Http\Controllers\TutorController@save');
Route::get('/tutor/edit', 'App\Http\Controllers\TutorController@edit');
