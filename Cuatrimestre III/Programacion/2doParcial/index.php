<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';
    include_once './API/TokenAPI.php';
    include_once './API/CompraAPI.php';
    include_once './Middleware/TokenMiddleware.php';
    include_once './Middleware/HistorialMiddleware.php';

    $app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

    $app->post('/usuario[/]', \TokenAPI::class.':CrearUsuario');
    $app->get('/usuario[/]', \TokenAPI::class.':TraerTodosLosUsuarios')
    ->add(\TokenMiddleware::class.':ValidarAdmin')
    ->add(\TokenMiddleware::class.':ValidarToken');

    $app->post('/login[/]', \TokenAPI::class.':GenerarToken');

    $app->post('/compra[/]', \CompraAPI::class.':Comprar')
    ->add(\HistorialMiddleware::class.':GenerarHistorial')
    ->add(\TokenMiddleware::class.':ValidarToken');

    $app->get('/compras[/]', \CompraAPI::class.':TraerTodos')
    ->add(\TokenMiddleware::class.':ValidarToken');

    $app->run();
?>