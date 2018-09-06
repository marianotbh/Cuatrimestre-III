<?php
include_once("IApiUsable.php");
include_once("Entidades/Helado.php");

class HeladoApi extends Helado implements IApiUsable{
    public function TraerUno($request, $response, $args){        
        $id = $args["id"];
        $objeto = Helado::Consultar($id);
        $newResponse = $response->withJson($objeto,200);
        return $newResponse;
    }

    public function TraerTodos($request, $response, $args){
        $todos = Helado::ConsultarTodos();
        $newResponse = $response->withJson($todos, 200);
        return $newResponse;
    }
    public function CargarUno($request, $response, $args){
        $parametros = $request->getParsedBody();
        $sabor = $parametros["sabor"];
        $precio = $parametros["precio"];
        $tipo = $parametros["tipo"];
        $cantidad = $parametros["cantidad"];
        $respuesta = "Insertado Correctamente.";
        Helado::Insertar($precio,$tipo,$cantidad,$sabor);
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }
    public function BorrarUno($request, $response, $args){
        $id = $args["id"];
        $respuesta = Helado::Eliminar($id);
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args){
        $parametros = json_decode($args["param"]);
        $id = $parametros->id;
        $sabor = $parametros->sabor;
        $precio = $parametros->precio;
        $tipo = $parametros->tipo;
        $cantidad = $parametros->cantidad;
        $respuesta = "Modificado Correctamente.";
        Helado::Modificar($id,$precio,$sabor,$tipo,$cantidad);
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }
}


?>