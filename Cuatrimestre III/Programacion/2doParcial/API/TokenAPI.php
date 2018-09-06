<?php
    include_once("Entidades/Token.php");
    include_once("Entidades/Usuario.php");
    class TokenApi extends Token {
        public function GenerarToken($request, $response, $args) {
            $parametros = $request->getParsedBody();
            $nombre = $parametros["nombre"];
            $clave  = $parametros["clave"];
            $sexo = $parametros["sexo"];
            $usuario = Usuario::Login($nombre, $clave, $sexo)[0];
            if($usuario != null && $usuario->perfil != ""){
                $token = Token::CodificarToken($nombre, $usuario->perfil, $usuario->clave);
                $respuesta = array("Estado" => "OK", "Mensaje" => "OK", "Token" => $token);
            }
            else{
                $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario o clave invalidos.");
            }
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        }

        public function CrearUsuario($request, $response, $args) {
            $parametros = $request->getParsedBody();
            $nombre = $parametros["nombre"];
            $clave  = $parametros["clave"];
            $perfil = $parametros["perfil"];
            $sexo = $parametros["sexo"];
            Usuario::Insertar($nombre, $clave, $perfil, $sexo);
            $respuesta = "Insertado Correctamente.";
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        }

        public function TraerTodosLosUsuarios($request, $response, $args) {
            $todos = Usuario::ConsultarTodos();
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        }
    }
?>