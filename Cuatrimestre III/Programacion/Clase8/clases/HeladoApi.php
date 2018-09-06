<?php
    include_once("./clases/Helado.php");
    include_once("./clases/IApiUsable.php");
    class HeladoApi extends Helado implements IApiUsable 
    {
        public function TraerUno($request, $response, $args) {
            $helado = Helado::TraerUnHelado($args['sabor'], $args['tipo']);
            $newResponse = $response->withJson($helado, 200);  
            return $newResponse;
        }
        public function TraerTodos($request, $response, $args) {
             $todosLosCds=cd::TraerTodoLosCds();
            $newResponse = $response->withJson($todosLosCds, 200);  
           return $newResponse;
       }
         public function CargarUno($request, $response, $args) {
            $body = $request->getParsedBody();
            $sabor = $body['sabor'];
            $precio = $body['precio'];
            $tipo = $body['tipo'];
            $cantidad = $body['cantidad'];
           
            Helado::Insertar($sabor, $precio, $tipo, $cantidad);
   
            $archivos = $request->getUploadedFiles();
            $destino = "./fotos/";
    
            $nombreAnterior = $archivos['foto']->getClientFilename();
            $extension = explode(".", $nombreAnterior);
            $extension = array_reverse($extension);
    
            $archivos['foto']->moveTo($destino.$sabor.".".$extension[0]);
            $response->getBody()->write("Helado guardado.");
    
            return $response;
       }
         public function BorrarUno($request, $response, $args) {
            $ArrayDeParametros = $request->getParsedBody();
            $id=$ArrayDeParametros['id'];
            $cd= new cd();
            $cd->id=$id;
            $cantidadDeBorrados=$cd->BorrarCd();
   
            $objDelaRespuesta= new stdclass();
           $objDelaRespuesta->cantidad=$cantidadDeBorrados;
           if($cantidadDeBorrados>0)
               {
                    $objDelaRespuesta->resultado="algo borro!!!";
               }
               else
               {
                   $objDelaRespuesta->resultado="no Borro nada!!!";
               }
           $newResponse = $response->withJson($objDelaRespuesta, 200);  
             return $newResponse;
       }
        
        public function ModificarUno($request, $response, $args) {
            //$response->getBody()->write("<h1>Modificar  uno</h1>");
            $ArrayDeParametros = $request->getParsedBody();
           //var_dump($ArrayDeParametros);    	
           $helado = new cd();
           $helado->id=$ArrayDeParametros['id'];
           $helado->titulo=$ArrayDeParametros['titulo'];
           $helado->cantante=$ArrayDeParametros['cantante'];
           $helado->año=$ArrayDeParametros['anio'];
   
              $resultado =$helado->ModificarCdParametros();
              $objDelaRespuesta= new stdclass();
           //var_dump($resultado);
           $objDelaRespuesta->resultado=$resultado;
           return $response->withJson($objDelaRespuesta, 200);		
       }
    }
?>