<?php
    include_once("DB/AccesoDatos.php");
    class Usuario {
        public $nombre;
        public $clave;
        public $sexo;
        public $perfil;

        public static function Login($nombre, $clave, $sexo) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT u.nombre, u.sexo, u.perfil
                                                            FROM usuarios u                                                         
                                                            WHERE u.nombre = :nombre AND u.clave = :clave AND u.sexo = :sexo");
            $consulta->execute(array(":nombre" => $nombre, ":clave" => $clave, ":sexo" => $sexo));
            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            return $resultado; 
        }

        public static function Insertar($nombre, $clave, $perfil, $sexo) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (nombre,clave,sexo,perfil)
                                                            VALUES(:nombre, :clave, :sexo, :perfil)");
            $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
            $consulta->bindValue(':sexo', $sexo, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $perfil, PDO::PARAM_STR);
            $consulta->execute();   
        }

        public static function ConsultarTodos() {    
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT u.nombre, u.sexo, u.perfil
                                                            FROM usuarios u");
            $consulta->execute();        
            return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
        }
    }
?>