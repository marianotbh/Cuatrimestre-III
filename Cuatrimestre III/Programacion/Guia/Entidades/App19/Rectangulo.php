<?php
    include_once("./Entidades/App19/FiguraGeometrica.php");
    class Rectangulo extends FiguraGeometrica
    {
        protected $_ladoUno;
        protected $_ladoDos;

        function __construct($l1, $l2)
        {
            parent::__construct();
            $this->_ladoUno = $l1;
            $this->_ladoDos = $l2;
            $this->CalcularDatos();
        }
        
        function CalcularDatos()
        {
            $this->_perimetro = ($this->_ladoUno * 2) + ($this->_ladoDos *2);
            $this->_superficie = $this->_ladoUno * $this->_ladoDos;
        }

        function Dibujar()
        {
            $s =  "<div style='color:".strtolower($this->GetColor()).";'";
            for($i = 0; $i < $this->_ladoDos; $i++)
            {
                for($j = 0; $j < $this->_ladoUno; $j++)
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
                Ancho: $this->_ladoUno <br>
                Alto: $this->_ladoDos <br>".$this->Dibujar();
        }
    }
?>