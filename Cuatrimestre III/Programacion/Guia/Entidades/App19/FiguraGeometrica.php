<?php
    abstract class FiguraGeometrica 
    {
        protected $_color;
        protected $_perimetro;
        protected $_superficie;

        function __construct() {}

        abstract function CalcularDatos();
        
        abstract function Dibujar();
        
        function GetColor()
        {
            return $this->_color;
        }

        function SetColor($val)
        {
            $this->_color = $val;
        }

        function ToString()
        {
            return "Color: $this->_color <br>
                Perimetro: $this->_perimetro <br>
                Superficie: $this->_superficie <br>";
        }
    }
?>