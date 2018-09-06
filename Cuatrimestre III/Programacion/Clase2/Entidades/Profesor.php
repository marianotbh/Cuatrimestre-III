<?php
    class Profesor extends Persona
    {
        private $materias;
        private $dias;

        function __construct($nombre,$apellido,$dni,$direccion,$materias,$dias)
        {
            parent::__construct($nombre,$apellido,$dni,$direccion);
            $this->materias = $materias;
            $this->dias = $dias;
        }

        public function __toString()
        {
            $r = "<h3>Profesor:</h3>".parent::toHTML();
            $r .= "<h4 style='line-height:1em;margin:0'>Materias: </h4> ";
            foreach($this->materias as $m)
            {
                $r .= "<br>".$m;
            }
            $r .= "<br><h4 style='line-height:1em;margin:20px 0 0 0'>Dias: </h4>";
            foreach($this->dias as $d)
            {
                $r .= "<br>".$d;
            }
            return $r;
        }


    }
?>