<?php
include_once("./../DB/AccesoDatos.php");

class Local
{
    public $direccion;
    public $localidad;
    public $estado;

    public function MostrarDatos()
    {
        return $this->direccion." - ".$this->localidad." - ".$this->estado;
    }
    
    public static function Consultar($tipo, $localidad)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT direccion, estado, localidad
                                                         FROM local WHERE tipo = :tipo
                                                         OR localidad = :localidad");
        
        $consulta->execute(array(":tipo" => $tipo, ":localidad" => $localidad));
        
        $resultado = array();
        while ($respuesta = $consulta->fetchObject("local")) {
            $resultado[] = $respuesta;
        }
        
        return $resultado; 
    }
    
    public static function Insertar($localidad,$estado,$direccion)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO local (localidad, direccion, estado)"
                                                    . "VALUES(:localidad, :direccion, :estado)");
        
        $consulta->bindValue(':localidad', $localidad, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
        $consulta->bindValue(':direccion', $direccion, PDO::PARAM_STR);

        $consulta->execute();   
    }
    
    public static function Modificar($id, $localidad, $direccion, $estado)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE local SET localidad = :localidad, direccion = :direccion, 
                                                        estado = :estado WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':localidad', $localidad, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
        $consulta->bindValue(':direccion', $direccion, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function Eliminar($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM local WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
    
}