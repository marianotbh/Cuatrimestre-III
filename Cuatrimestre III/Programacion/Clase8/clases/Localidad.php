<?php
include_once("./clases/AccesoDatos.php");
class Localidad
{
    public $nombre;
    public $provincia;
    public $estado;

    public function MostrarDatos()
    {
            return $this->nombre." - ".$this->provincia." - ".$this->estado;
    }
    
    public static function Traer($nombre, $provincia)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "SELECT nombre, provincia, estado FROM localidad WHERE nombre like ? AND provincia like ?";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->execute(array(1 => $nombre, 2 => $provincia));
        $resultado = $consulta->fetchObject('Localidad');
        return $resultado; 
    }
    
    public static function Insertar($nombre, $provincia, $estado)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "INSERT INTO localidad (nombre, provincia, estado) VALUES(?, ?, ?)";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->bindValue(1, $nombre, PDO::PARAM_STR);
        $consulta->bindValue(2, $provincia, PDO::PARAM_STR);
        $consulta->bindValue(3, $estado, PDO::PARAM_STR);
        $consulta->execute();
    }  
}