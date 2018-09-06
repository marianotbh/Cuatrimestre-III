<?php
    include_once("./Entidades/IMostrable.php");
    class Direccion implements IMostrable {   
        private $calle;
        private $altura;
        private $localidad;
    
        function __construct($calle, $altura, $localidad)
        {
            $this->calle = $calle;
            $this->altura = $altura;
            $this->localidad = $localidad;
        }
    
        public function __get($prop)
        {
            return $this->$prop;
        }
        public function __set($prop,$val)
        {
            $this->$prop = $val;
        }

        function toHTML()
        {
            return "$this->calle al $this->altura, ".$this->localidad->toHTML();
        }
    }
?>