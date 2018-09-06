<?php
include_once("./clases/AccesoDatos.php");
class Empleado
{
    public $nombre;
    public $turno;
    public $tipo;

    public function MostrarDatos()
    {
            return $this->nombre." - ".$this->turno." - ".$this->tipo;
    }
    
    public static function Traer($turno, $tipo)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "SELECT nombre, turno, tipo FROM empleado WHERE turno like ? AND tipo like ?";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->execute(array(1 => $turno, 2 => $tipo));
        $resultado = $consulta->fetchObject('Empleado');
        return $resultado; 
    }
    
    public static function Insertar($nombre, $turno, $tipo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "INSERT INTO empleado (nombre, turno, tipo) VALUES(?, ?, ?)";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->bindValue(1, $nombre, PDO::PARAM_STR);
        $consulta->bindValue(2, $turno, PDO::PARAM_INT);
        $consulta->bindValue(3, $tipo, PDO::PARAM_STR);
        $consulta->execute();
    }    
}