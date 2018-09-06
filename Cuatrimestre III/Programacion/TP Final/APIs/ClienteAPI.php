<?php
include_once("IApiUsable.php");
include_once("Entidades/Cliente.php");

class ClienteApi extends Cliente implements IApiUsable{
    public function TraerUno($request, $response, $args){        
        $id = $args["id"];
        $objeto = Cliente::ConsultarPorID($id);
        $newResponse = $response->withJson($objeto,200);
        return $newResponse;
    }

    public function TraerTodos($request, $response, $args){
        $todos = Cliente::ConsultarTodos();
        $newResponse = $response->withJson($todos, 200);
        return $newResponse;
    }
    public function CargarUno($request, $response, $args){
        $parametros = $request->getParsedBody();
        $nombre = $parametros["nombre"];
        $nacionalidad = $parametros["nacionalidad"];
        $sexo = $parametros["sexo"];
        $edad = $parametros["edad"];
        $respuesta = "Insertado Correctamente.";
        Cliente::Insertar($nombre,$sexo,$edad,$nacionalidad);
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }
    public function BorrarUno($request, $response, $args){
        $parametros = $request->getParsedBody();
        $id = $parametros["id"];
        $respuesta = "Eliminado Correctamente.";
        Cliente::Eliminar($id);
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args){
        $parametros = $request->getParsedBody();
        $id = $parametros["id"];
        $nombre = $parametros["nombre"];
        $nacionalidad = $parametros["nacionalidad"];
        $sexo = $parametros["sexo"];
        $edad = $parametros["edad"];
        $respuesta = "Modificado Correctamente.";
        Cliente::Modificar($id,$nombre,$nacionalidad,$sexo,$edad);
        $newResponse = $response->withJson($respuesta,200);
        return $newResponse;
    }
}


?>