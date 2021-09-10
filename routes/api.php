<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::get('load-session', 'Api\AuthController@load_session');

});

    Route::group(['middleware' => ['apiJwt']], function(){

        Route::resource('adm', 'Api\AdmController');
        Route::resource('ranking', 'Api\RankingController');
        Route::resource('item', 'Api\ItemController');
        Route::resource('nota', 'Api\NotaController');
        Route::resource('func', 'Api\FuncController');
        Route::resource('prod', 'Api\ProdController');
        Route::resource('user', 'Api\UserController');

    });


