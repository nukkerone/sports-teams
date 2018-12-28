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
    Route::get('{team_id}', 'TeamController@get');
    Route::post('', 'TeamController@create');
    Route::put('{team_id}', 'TeamController@update');
    Route::delete('{team_id}', 'TeamController@delete');

    Route::get('{team_id}/players', 'TeamController@getPlayers');
    Route::post('{team_id}/players', 'TeamController@createPlayer');
    Route::put('{team_id}/players/{player_id}', 'TeamController@updatePlayer');
    Route::delete('{team_id}/players/{player_id}', 'TeamController@deletePlayer');
});

Route::prefix('players')->group(function() {
   Route::get('', 'PlayerController@index');
    Route::post('', 'PlayerController@create');
    Route::put('{id}', 'PlayerController@update');
});
