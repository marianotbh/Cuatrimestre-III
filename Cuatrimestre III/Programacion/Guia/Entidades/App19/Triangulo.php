<?php
    include_once("./Entidades/App19/FiguraGeometrica.php");
    class Triangulo extends FiguraGeometrica
    {
        protected $_altura;
        protected $_base;

        function __construct($h, $b)
        {
            parent::__construct();
            $this->_altura = $h;
            $this->_base = $b;
            $this->CalcularDatos();
        }
        
        function CalcularDatos()
        {
            $this->_superficie = ($this->_base * $this->_altura) / 2;
            $this->_perimetro = "?";
        }

        function Dibujar()
        {
            $s = "<div style='color:".strtolower($this->GetColor()).";'>";
            for($i = 1; $i <= $this->_base; $i++)
            {
                for($j = 1; $j <= $i; $j++)
                {
                    $s .= "*";
                }
                $s .= "<br>";
            }           
            $s .= "</div>";
            return $s;
        }

        function ToString()
        {
            return parent::ToString()."
                Altura: $this->_altura <br>
                Base: $this->_base".$this->Dibujar();
        }
    }
?>