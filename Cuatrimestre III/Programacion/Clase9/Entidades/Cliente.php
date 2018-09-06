<?php
include_once("./../DB/AccesoDatos.php");

class Cliente
{
    public $nacionalidad;
    public $nombre;
    public $sexo;
    public $edad;

    public function MostrarDatos()
    {
        return $this->nacionalidad." - ".$this->nombre." - ".$this->sexo." - ".$this->edad;
    }
    
    public static function Consultar($nacionalidad, $sexo)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nacionalidad, nombre, sexo, edad
                                                         FROM clientes WHERE nacionalidad = :nacionalidad
                                                         AND sexo = :sexo");
        
        $consulta->execute(array(":nacionalidad" => $nacionalidad, ":sexo" => $sexo));
        
        $resultado = array();
        while ($respuesta = $consulta->fetchObject("Cliente")) {
            $resultado[] = $respuesta;
        }
        
        return $resultado; 
    }

    public static function ConsultarTodos()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM clientes");
        
        $consulta->execute();        
                
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Cliente");
    }

    public static function ConsultarPorID($id)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM clientes where id = :id");
        $consulta->execute(array(":id" => $id));        
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Cliente");
    }
    
    public static function Insertar($nombre,$sexo,$edad,$nacionalidad)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO clientes (nombre, nacionalidad, sexo, edad)"
                                                    . "VALUES(:nombre, :nacionalidad, :sexo, :edad)");
        
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':sexo', $sexo, PDO::PARAM_STR);
        $consulta->bindValue(':nacionalidad', $nacionalidad, PDO::PARAM_STR);
        $consulta->bindValue(':edad', $edad, PDO::PARAM_INT);

        $consulta->execute();   
    }
    
    public static function Modificar($id, $nombre, $nacionalidad, $sexo, $edad)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE clientes SET nombre = :nombre, nacionalidad = :nacionalidad, 
                                                        sexo = :sexo, edad = :edad WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':sexo', $sexo, PDO::PARAM_STR);
        $consulta->bindValue(':edad', $edad, PDO::PARAM_INT);
        $consulta->bindValue(':nacionalidad', $nacionalidad, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function Eliminar($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM clientes WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
    
}