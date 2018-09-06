<?php
include_once("./clases/AccesoDatos.php");
class Helado
{
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;

    public function MostrarDatos()
    {
            return $this->sabor." - ".$this->precio." - ".$this->tipo." - ".$this->cantidad;
    }
    
    public static function Traer($sabor, $tipo)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "SELECT sabor, precio, tipo, cantidad FROM helados WHERE sabor like :sabor AND tipo like :tipo";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->execute(array(':sabor' => $sabor, ':tipo' => $tipo));
        if($consulta->fetchObject('Helado'))
            return "Sí hay.";
        else
            return "No existe el sabor por el que consultaste";
    }
    
    public static function Insertar($sabor, $precio, $tipo, $cantidad)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "INSERT INTO helados (sabor, precio, tipo, cantidad) VALUES(?, ?, ?, ?)";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->bindValue(1, $sabor, PDO::PARAM_STR);
        $consulta->bindValue(2, $precio, PDO::PARAM_INT);
        $consulta->bindValue(3, $tipo, PDO::PARAM_STR);
        $consulta->bindValue(4, $cantidad, PDO::PARAM_STR);
        $consulta->execute();
    }
    /*
    public static function Modificar($sabor, $precio, $tipo, $cantidad)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $query = "UPDATE helados SET precio = :precio, tipo = :tipo, cantidad = :cantidad WHERE sabor = :sabor";
        $consulta = $objetoAccesoDato->RetornarConsulta($query);
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_STR);
        return $consulta->execute();
    }

    public static function Eliminar($sabor)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM helados WHERE sabor = :sabor");
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
        return $consulta->execute();
    }*/
}