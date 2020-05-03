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

/** @var Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    if ($router->app->environment()) {
        return $router->app->version();
    }
    return redirect('https://akabe.co/');
});

$router->get('/stg', function() {
    return \App\Services\ProductSearchService::searchProduct(false);
});

$router->get('/prd', function() {
    return \App\Services\ProductSearchService::searchProduct(true);
});
