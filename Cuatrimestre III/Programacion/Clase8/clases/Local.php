<?php
include_once("./clases/AccesoDatos.php");
class Local
{
    public $direccion;
    public $idlocalidad;
    public $estado;

    public function MostrarDatos()
    {
            return $this->direccion." - ".$this->idlocalidad." - ".$this->estado;
    }
    
    public static function Traer($direccion, $idlocalidad)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "SELECT nombre, idLocalidad, estado FROM local WHERE direccion like ? AND idLocalidad like ?";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->execute(array(1 => $direccion, 2 => $idlocalidad));
        $resultado = $consulta->fetchObject('Localidad');
        return $resultado; 
    }
    
    public static function Insertar($direccion, $idlocalidad, $estado)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "INSERT INTO local (direccion, idLocalidad, estado) VALUES(?, ?, ?)";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->bindValue(1, $direccion, PDO::PARAM_STR);
        $consulta->bindValue(2, $idlocalidad, PDO::PARAM_STR);
        $consulta->bindValue(3, $estado, PDO::PARAM_STR);
        $consulta->execute();
    } 
}