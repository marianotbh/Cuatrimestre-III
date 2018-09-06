<?php
    include_once("./Entidades/IMostrable.php");
    abstract class Persona implements IMostrable {
        private $nombre;
        private $apellido;
        private $dni;
        private $direccion;
    
        function __construct($nombre, $apellido, $dni, $direccion)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->dni = $dni;
            $this->direccion = $direccion;
        }

        public function __get($prop)
        {
            return $this->$prop;
        }
        public function __set($prop,$val)
        {
            $this->$prop = $val;
        }

        public function toHTML()
        {
            return "<h5>$this->apellido, $this->nombre (DNI: $this->dni)</h5>
                    <h5>Dirección: ".$this->direccion->toHTML()."</h5>";
        }
    }
?>   