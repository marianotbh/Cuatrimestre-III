<?php
    include_once("./Entidades/IMostrable.php");
    class Localidad implements IMostrable {
        private $cp;
        private $nombre;
    
        function __construct($cp, $nombre)
        {
            $this->cp = $cp;
            $this->nombre = $nombre;
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
            return "$this->nombre (CP: $this->cp)";
        }
    }
?>