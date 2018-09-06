<?php
    include_once("Entidades/Compra.php");
    include_once("Entidades/Foto.php");
    class CompraAPI extends Compra {
        public function Comprar($request, $response, $args) {
            $parametros = $request->getParsedBody();
            $payload = $request->getAttribute("payload")["Payload"];
            $articulo = $parametros["articulo"];
            $fecha  = $parametros["fecha"];
            $precio = $parametros["precio"];
            $foto = "";
            $usuario = $payload->user;
            $respuesa = Compra::NuevaCompra($articulo, $fecha, $precio);
            $respuesta = "Insertado Correctamente.";
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        }

        public function TraerTodos($request, $response, $args) {
            $todos = Compra::ConsultarTodos();
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        }

        public function TraerComprasUsuario($request, $response, $args) {
            $payload = $request->getAttribute("payload")["Payload"];
            $idUsuario = $payload->idUsuario;
            $todos = Compra::ComprasUsuario($idUsuario);
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        }
    }
?>