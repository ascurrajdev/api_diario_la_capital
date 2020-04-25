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

$router->get('/', function () use ($router) {
    return response()->json([
        "message" => "El framework funciona correctamente"
    ],201);
});

$router->get('api/posts',"PostController@index");
$router->get('api/posts/{id}',"PostController@show");

$router->get('api/categorias','CategoriasController@index');
$router->get('api/categorias/{id}','CategoriasController@show');

$router->get('api/encuestas','EncuestaController@index');
$router->get('api/encuestas/{id}','EncuestaController@show');
$router->post('api/encuestas/{id}','EncuestaController@nuevaRespuesta');

$router->get('api/vistas','VistaController@index');

$router->post('api/lector','LectoresController@store');