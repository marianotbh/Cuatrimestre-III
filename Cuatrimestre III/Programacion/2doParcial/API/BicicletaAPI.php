<?php
    include_once("Entidades/Bicicleta.php");
    include_once("Entidades/Foto.php");
    class BicicletaAPI extends Bicicleta {
        public function TraerTodos($request, $response, $args) {
            $todos = Bicicleta::ConsultarTodos();
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        }

        public function Cargar($request, $response, $args) {
            $parametros = $request->getParsedBody();
            $files = $request->getUploadedFiles();
            $marca = $parametros["marca"];
            $precio = $parametros["precio"];
            $foto = $files["foto"];   
            $ext = Foto::ObtenerExtension($foto);
            if($ext != "ERROR") { 
                $nombreFoto = $marca."_Foto".$ext;
                $rutaFoto = "./Fotos/".$nombreFoto;
                Foto::GuardarFoto($foto, $rutaFoto);
                $respuesta = "Insertado Correctamente.";
                Bicicleta::Insertar($marca, $precio, $nombreFoto);
                $newResponse = $response->withJson($respuesta, 200);
                return $newResponse;
            } else {
                $respuesta = "Ocurrio un error.";
                $newResponse = $response->withJson($respuesta, 200);
                return $newResponse;
            }        
        }
    }
?>