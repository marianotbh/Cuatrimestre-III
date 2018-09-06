<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
include_once './API/HeladoAPI.php';
include_once './API/TokenAPI.php';

$mdw = function ($request, $response, $next) {
    $response->getBody()->write("entrando");
    $response = $next($request, $response);
    $response->getBody()->write("saliendo");
    return $response;
};

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->group('/login', function()
{
    //Se debe enviar user y password en el body.
    $this->post('[/]', \TokenApi::class . ':GenerarToken');  
    $this->post('/validar[/]', \TokenApi::class . ':ValidarToken');  
})->add($mdw);

$app->group('/helado', function()
{
    $this->get('[/]', \HeladoApi::class . ':TraerTodos');
    $this->get('/{id}[/]', \HeladoApi::class . ':TraerUno');
    $this->post('[/]', \HeladoApi::class . ':CargarUno');
    $this->put('/{param}[/]', \HeladoApi::class . ':ModificarUno');
    $this->delete('/{id}[/]', \HeladoApi::class . ':BorrarUno');    
});

$app->run();