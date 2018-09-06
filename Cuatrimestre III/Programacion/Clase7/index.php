<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    require './vendor/autoload.php';
    
    $app = new \Slim\App;
    
    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });

    $app->post('/hello', function (Request $request, Response $response) {
        $body = $request->getParsedBody();
        $newResponse = $response->withJSON($body, 200);
        return $newResponse;

        //$response->getBody()->write("Hello, ".$body['name']);
        //return $response;
    });

    $app->run();
?>