<?php

use Illuminate\Routing\Router;

$router->group(['middleware' => ['api.token','web']], function (Router $router) {

    $router->post('locations', [
        'as' => 'api.admin.location.store',
        'uses' => 'LocationController@store',
        'middleware' =>'token-can:admin.locations.create'
    ]);
});