<?php
include_once("./../DB/AccesoDatos.php");

class Venta
{
    public $local;
    public $cliente;
    public $empleado;
    public $helado;
    public $fecha;
    public $cantidad;

    public function MostrarDatos()
    {
        return $this->local." - ".$this->cliente." - ".$this->empleado." - ".$this->helado." - ".$this->cantidad." - ".$this->fecha;
    }

    public static function Insertar($cliente,$empleado,$cantidad,$local,$helado,$fecha)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO venta (cliente, local, empleado, cantidad, helado, fecha)"
                                                    . "VALUES(:cliente, :local, :empleado, :cantidad, :helado, :fecha)");
        
        $consulta->bindValue(':cliente', $cliente, PDO::PARAM_STR);
        $consulta->bindValue(':empleado', $empleado, PDO::PARAM_STR);
        $consulta->bindValue(':local', $local, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':helado', $helado, PDO::PARAM_STR);
        $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);

        $consulta->execute();   
    }

    public static function InsertarConImagen($cliente,$empleado,$cantidad,$local,$helado,$fecha,$imagen)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO venta (cliente, local, empleado, cantidad, helado, fecha, imagen)"
                                                    . "VALUES(:cliente, :local, :empleado, :cantidad, :helado, :fecha, :imagen)");
        
        $consulta->bindValue(':cliente', $cliente, PDO::PARAM_STR);
        $consulta->bindValue(':empleado', $empleado, PDO::PARAM_STR);
        $consulta->bindValue(':local', $local, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':helado', $helado, PDO::PARAM_STR);
        $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
        $consulta->bindValue(':imagen', $imagen, PDO::PARAM_LOB);

        $consulta->execute();   
    }
}