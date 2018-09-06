<?php
    /* La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3 y _vertice4 (que corresponden a los cuatro vértices del rectángulo). <br>
    La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener un constructor para construir el rectángulo por medio de los vértices 1 y 3. <br>
    Los atributos ladoUno, ladoDos, área y perímetro se deberán inicializar una vez construido el rectángulo. <br>
    Desarrollar una aplicación que muestre todos los datos del rectángulo y lo dibuje en la página*/

    include_once("./Entidades/App20/Punto.php");

    class Rectangulo
    {
        private $_vertice1;
        private $_vertice2;
        private $_vertice3;
        private $_vertice4;
        private $area;
        private $ladoDos;
        private $ladoUno;
        private $perimetro;

        function __construct($v1, $v3)
        {
            $this->_vertice1 = $v1;
            $this->_vertice3 = $v3;
        }

        function Dibujar()
        {
            $s;
            echo "$s";
            return $s;
        }
    }
    
?>