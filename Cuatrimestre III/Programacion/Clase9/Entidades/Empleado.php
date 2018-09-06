<?php
include_once("./../DB/AccesoDatos.php");

class Empleado
{
    public $turno;
    public $nombre;
    public $tipo;

    public function MostrarDatos()
    {
        return $this->turno." - ".$this->nombre." - ".$this->tipo;
    }
    
    public static function Consultar($turno, $tipo)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT turno, nombre, tipo
                                                         FROM empleado WHERE turno = :turno
                                                         OR tipo = :tipo");
        
        $consulta->execute(array(":turno" => $turno, ":tipo" => $tipo));
        
        $resultado = array();
        while ($respuesta = $consulta->fetchObject("Empleado")) {
            $resultado[] = $respuesta;
        }
        
        return $resultado; 
    }
    
    public static function Insertar($nombre,$tipo,$turno)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO empleado (nombre, turno, tipo)"
                                                    . "VALUES(:nombre, :turno, :tipo)");
        
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':turno', $turno, PDO::PARAM_STR);

        $consulta->execute();   
    }
    
    public static function Modificar($id, $nombre, $turno, $tipo)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE empleado SET nombre = :nombre, turno = :turno, 
                                                        tipo = :tipo WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':turno', $turno, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function Eliminar($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM empleado WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
    
}