<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('teams')->group(function() {
    Route::get('', 'TeamController@index');
    Route::post('', 'TeamController@create');
    Route::put('{id}', 'TeamController@update');

    Route::get('{id}/players', 'TeamController@getPlayers');
});

Route::prefix('players')->group(function() {
   Route::get('', 'PlayerController@index');
    Route::post('', 'PlayerController@create');
    Route::put('{id}', 'PlayerController@update');
});
