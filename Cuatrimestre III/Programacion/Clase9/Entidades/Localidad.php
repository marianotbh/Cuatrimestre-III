<?php
include_once("./../DB/AccesoDatos.php");

class Localidad
{
    public $provincia;
    public $nombre;
    public $estado;

    public function MostrarDatos()
    {
        return $this->provincia." - ".$this->nombre." - ".$this->estado;
    }
    
    public static function Consultar($provincia, $nombre)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT provincia, estado, nombre
                                                         FROM localidad WHERE provincia = :provincia
                                                         OR nombre = :nombre");
        
        $consulta->execute(array(":provincia" => $provincia, ":nombre" => $nombre));
        
        $resultado = array();
        while ($respuesta = $consulta->fetchObject("Localidad")) {
            $resultado[] = $respuesta;
        }
        
        return $resultado; 
    }
    
    public static function Insertar($nombre,$estado,$provincia)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO localidad (nombre, provincia, estado)"
                                                    . "VALUES(:nombre, :provincia, :estado)");
        
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
        $consulta->bindValue(':provincia', $provincia, PDO::PARAM_STR);

        $consulta->execute();   
    }
    
    public static function Modificar($id, $nombre, $provincia, $estado)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE localidad SET nombre = :nombre, provincia = :provincia, 
                                                        estado = :estado WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
        $consulta->bindValue(':provincia', $provincia, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function Eliminar($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM localidad WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
    
}