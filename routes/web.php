<?php

use App\Http\Controllers\KaryawanController;



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/karyawan', 'KaryawanController@index');
$router->post('/karyawan', 'KaryawanController@store');
$router->get('/karyawan/{id}', 'KaryawanController@show');
$router->put('/karyawan/{id}', 'KaryawanController@update');
$router->delete('/karyawan/{id}', 'KaryawanController@destroy');
