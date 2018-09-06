<?php
    class Pasajero
    {
        private $_apellido;
        private $_nombre;
        private $_dni;
        private $_esPlus;

        function __construct($apellido, $nombre, $dni, $plus)
        {
            $this->_apellido = $apellido;
            $this->_nombre = $nombre;
            $this->_dni = $dni;
            $this->_esPlus = $plus;
        }

        function Equals($p)
        {
            if($this->_dni == $p->_dni)
                return TRUE;
            else 
                return FALSE;
        }

        function GetInfoPasajero()
        {
            $estado = "Pasajero regular";
            if($this->_esPlus)
                $estado = "Pasajero PLUS";
            return "$this->_apellido, $this->_nombre. DNI: $this->_dni. $estado <br>";
        }

        function MostrarPasajero()
        {
            echo $this->GetInfoPasajero();
        }
    }
?>