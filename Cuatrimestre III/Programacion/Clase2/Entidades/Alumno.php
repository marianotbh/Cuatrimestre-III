<?php
    class Alumno extends Persona
    {
        private $legajo;
        private $fechaInscripcion;

        public function __construct($nombre,$apellido,$dni,$direccion,$legajo, $fIns)
        {
            parent::__construct($nombre,$apellido,$dni,$direccion);
            $this->legajo = $legajo;
            $this->fechaInscripcion = $fIns;
        }

        public function __toString()
        {
            return "<h3>Alumno:</h3>".parent::toHTML()." 
                    Legajo: $this->legajo <br>Fecha de inscripcion: $this->fechaInscripcion";
        }
    }
?>