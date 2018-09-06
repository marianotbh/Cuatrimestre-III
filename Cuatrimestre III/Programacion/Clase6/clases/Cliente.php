<?php
include_once("./clases/AccesoDatos.php");
class Cliente
{
    public $nombre;
    public $nacionalidad;
    public $sexo;
    public $edad;

    public function MostrarDatos()
    {
            return $this->nombre." - ".$this->nacionalidad." - ".$this->sexo." - ".$this->edad;
    }
    
    public static function Traer($nacionalidad, $sexo)
    {    
        $ret = "";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "SELECT nombre, nacionalidad, sexo, edad FROM clientes WHERE nacionalidad like :nacionalidad AND sexo like :sexo";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->execute(array(':nacionalidad' => $nacionalidad, ':sexo' => $sexo));
        while($resultado = $consulta->fetchObject('Cliente'))
        {
            $ret .= $resultado->MostrarDatos()."<br/>";
        }
        if($ret == "")
            return "No hay coincidencias";
        else
            return $ret;

    }
    
    public static function Insertar($nombre, $nacionalidad, $sexo, $edad)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "INSERT INTO clientes (nombre, nacionalidad, sexo, edad) VALUES(?, ?, ?, ?)";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->bindValue(1, $nombre, PDO::PARAM_STR);
        $consulta->bindValue(2, $nacionalidad, PDO::PARAM_INT);
        $consulta->bindValue(3, $sexo, PDO::PARAM_STR);
        $consulta->bindValue(4, $edad, PDO::PARAM_STR);
        $consulta->execute();
    }       
}