<?php
include_once("DB/AccesoDatos.php");

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
    
    public static function ConsultarPorSaborYTipo($sabor, $tipo)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT sabor, precio, tipo, cantidad
                                                         FROM helados WHERE sabor = :sabor
                                                         AND tipo = :tipo");
        
        $consulta->execute(array(":sabor" => $sabor, ":tipo" => $tipo));
        
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Helado");
    }
    
    public static function ConsultarTodos()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM helados");
        
        $consulta->execute();        
                
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Helado");
    }

    public static function Consultar($id)
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM helados where id_helado = :id");
        $consulta->execute(array(":id" => $id));        
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Helado");
    }

    public static function Insertar($precio,$tipo,$cantidad,$sabor)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO helados (precio, sabor, tipo, cantidad)"
                                                    . "VALUES(:precio, :sabor, :tipo, :cantidad)");
        
        $consulta->bindValue(':precio', $precio, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);

        $consulta->execute();   
    }
    
    public static function Modificar($id, $precio, $sabor, $tipo, $cantidad)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE helados SET precio = :precio, sabor = :sabor, 
                                                        tipo = :tipo, cantidad = :cantidad WHERE id_helado = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $precio, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function Eliminar($id)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM helados WHERE id_helado = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
    
}