<?php

use Illuminate\Http\Request;
use Illuminate\Support\Str;

// route testing
$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/tes', function (Request $request) {
    $code = Str::random(32);
    $request->session()->put('tes', $code);
    // $request->session()->flush();
    return $request->session()->get('tes');
});
// ===================================================

// route auth
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->get('verify', 'AuthController@verify');
    $router->post('logout', ['middleware' => 'jwt.auth', 'uses' => 'AuthController@logout']);
    $router->get('tes', ['middleware' => 'jwt.auth', 'uses' => 'AuthController@tes']);
});

// router oauth with google
$router->group(['prefix' => 'oauth'], function () use ($router) {
    $router->get('redirect', 'GoogleController@redirect');
    $router->get('google/redirect', 'GoogleController@callback');
});

// router tambak
$router->group(['prefix' => 'tambak'], function () use ($router) {
    $router->post('store', 'TambakController@store');
    $router->put('{id}/update', 'TambakController@update');
    $router->delete('{id}/destroy', 'TambakController@destroy');
    $router->get('all', 'TambakController@index');
    $router->get('show/{id}', 'TambakController@show');
    $router->get('export', 'TambakController@export');
    // $router->get('list', 'TambakController@list');
});

//router kolam
$router->group(['prefix' => 'kolam'], function () use ($router) {
    $router->get('all', 'KolamController@index');
    $router->get('show/{id}', 'KolamController@show');
    $router->post('store', 'KolamController@store');
    $router->put('{id}/update', 'KolamController@update');
    $router->delete('{id}/destroy', 'KolamController@destroy');
    // $router->get('list', 'KolamController@list');
});

// route stok pakan
$router->group(['prefix' => 'stok'], function () use ($router) {
    $router->get('all', 'StokPakanController@index');
    $router->post('store', 'StokPakanController@store');
    $router->put('{id}/update', 'StokPakanController@update');
    $router->get('show/{id}', 'StokPakanController@show');
    $router->delete('{id}/destroy', 'StokPakanController@destroy');
    $router->get('export', 'StokPakanController@export');
    $router->get('list', 'StokPakanController@list');
});

//router siklus
$router->group(['prefix' => 'siklus'], function () use ($router) {
    $router->get('all', 'SiklusController@index');
    $router->get('show/{id}', 'SiklusController@show');
    $router->post('store', 'SiklusController@store');
    $router->put('{id}/update', 'SiklusController@update');
    $router->delete('{id}/destroy', 'SiklusController@destroy');
});

// routes input pakan
$router->group(['prefix' => 'inputpakan'], function () use ($router) {
    $router->get('all', 'InputPakanController@index');
    $router->get('show/{id}', 'InputPakanController@show');
    $router->post('store', 'InputPakanController@store');
    $router->put('{id}/update', 'InputPakanController@update');
    $router->delete('{id}/destroy', 'InputPakanController@destroy');
});

//routes input kualitas air
$router->group(['prefix' => 'inputkualitasair'], function () use ($router) {
    $router->get('all', 'InputKualitasAirController@index');
    $router->get('show/{id}', 'InputKualitasAirController@show');
    $router->post('store', 'InputKualitasAirController@store');
    $router->put('{id}/update', 'InputKualitasAirController@update');
    $router->delete('{id}/destroy', 'InputKualitasAirController@destroy');
});

//routes input sampling
$router->group(['prefix' => 'inputsampling'], function () use ($router) {
    $router->get('all', 'InputSamplingController@index');
    $router->get('show/{id}', 'InputSamplingController@show');
    $router->post('store', 'InputSamplingController@store');
    $router->put('{id}/update', 'InputSamplingController@update');
    $router->delete('{id}/destroy', 'InputSamplingController@destroy');
});

// routes panen
$router->group(['prefix' => 'panen'], function () use ($router) {
    $router->get('all', 'PanenController@index');
    $router->get('show/{id}', 'PanenController@show');
    $router->post('store', 'PanenController@store');
    $router->put('{id}/update', 'PanenController@update');
    $router->delete('{id}/destroy', 'PanenController@destroy');
});

// routes laporan kolam  atau tambak
$router->group(['prefix' => 'report'], function () use ($router) {
    $router->get('kolam', 'Report\KolamReportController@tampil');
    $router->get('stok', 'Report\PakanReportController@tampil');
});
