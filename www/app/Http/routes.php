<?php

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

$app->get('/', [
    'uses' => 'GameController@index'
]);

$app->get('/create-game/{name}', [
    'uses' => 'GameController@createGame'
]);

$app->get('/game/{name}', [
    'uses' => 'GameController@showGame'
]);

$app->get('/game/captain/{name}', [
    'uses' => 'GameController@showGameCaptain'
]);



