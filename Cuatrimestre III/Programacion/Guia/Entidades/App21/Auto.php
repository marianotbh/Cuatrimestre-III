<?php
    class Auto 
    {
        private $_color;
        private $_precio;
        private $_marca;
        private $_fecha;

        function __construct($marca, $color, $precio = "", $fecha = "")
        {
            $this->_marca = $marca;
            $this->_color = $color;
            $this->_precio = $precio;
            $this->_fecha = $fecha;
        }

        function AgregarImpuestos($imp)
        {
            $this->_precio += $imp;
        }

        function MostrarAuto()
        {
            $fecha = "-";
            if($this->_fecha != "")
            {
                 $fecha = $this->_fecha->format('Y-m-d');
            }                
            $s = "Color: $this->_color <br>
                Precio: $this->_precio <br>
                Marca: $this->_marca <br>
                Fecha: ".$fecha."<br>";
            return $s;
        }

        function Equals($otroAuto)
        {
            if($this->_marca == $otroAuto->_marca)
                return TRUE;
            else
                return FALSE;
        }

        static function Add($a1, $a2)
        {
            if($a1->Equals($a2) && $a1->_color == $a2->_color)
                return ($a1->_precio + $a2->_precio);
            else
            {
                echo "No se pueden sumar autos de marca o color distintos";
                return 0;
            }
                
        }
    }    
?>