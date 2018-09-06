<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';
    //include_once("./clases/Cliente.php");
    //include_once("./clases/Empleado.php");
    include_once("./clases/HeladoApi.php");
    //include_once("./clases/Localidad.php");
    //include_once("./clases/Local.php");
    
    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;
    
    $app = new \Slim\App(["settings" => $config]);
    
    $app->group('/helado', function () {
        $this->get('/', \HeladoApi::class.':TraerTodos');
        $this->get('/{sabor}/{tipo}', \HeladoApi::class.':TraerUno');
        $this->post('/', \HeladoApi::class.':CargarUno');
        $this->delete('/', \HeladoApi::class.':BorrarUno');
        $this->put('/', \HeladoApi::class.':ModificarUno');
    });
    
    $app->run();
?>