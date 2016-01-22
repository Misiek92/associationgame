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

// should be changed to post after dev
$app->post('/create-game/{name}', [
    'uses' => 'GameController@createGame'
]);

$app->get('/game/{name}', [
    'uses' => 'GameController@showGame'
]);

$app->get('/game/{name}/captain', [
    'uses' => 'GameController@showGameCaptain'
]);

$app->post('/game/add-point', [
    'uses' => 'GameController@addPoints'
]);

$app->post('/discover-word', [
    'uses' => 'GameController@discoverWord'
]);

$app->get('/distribution/game/{name}', [
    'uses' => 'GameController@getDistributionForGame'
]);

$app->post('/game/{name}/new-distribution', [
    'as' => 'newDistribution',
    'uses' => 'GameController@newDistribution'
]);


