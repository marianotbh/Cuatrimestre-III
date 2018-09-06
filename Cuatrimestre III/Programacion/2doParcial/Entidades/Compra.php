<?php
    include_once("DB/AccesoDatos.php");
    class Compra {
        public $articulo;
        public $precio;
        public $fecha;
        public $foto;
        public $usuario;

        public static function NuevaCompra($articulo, $fecha, $precio, $foto = "", $usuario = "") {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO compras (articulo,fecha,precio,foto,usuario)
                                                            VALUES(:articulo, :fecha, :precio, :foto, :usuario)");
            $consulta->bindValue(':articulo', $articulo, PDO::PARAM_STR);
            $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $precio, PDO::PARAM_STR);
            $consulta->bindValue(':foto', $foto, PDO::PARAM_STR);
            $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
            $consulta->execute();   
        }

        public static function ComprasUsuario($usuario) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT c.articulo, c.fecha, c.precio, c.foto 
                                                            FROM compras c INNER JOIN usuarios u on u.usuario = c.usuario
                                                            WHERE u.nombre = :usuario");
            $consulta->bindValue(':usuario', $usuario, PDO::PARAM_INT);
            $consulta->execute();        
            return $consulta->fetchAll(PDO::FETCH_CLASS,"Compra");
        }

        public static function ConsultarTodos() {    
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT c.articulo, c.fecha, c.precio, c.foto  
                                                            FROM compras c");
            $consulta->execute();        
            return $consulta->fetchAll(PDO::FETCH_CLASS,"Compra");
        }
    }
?>