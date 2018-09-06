<?php
    class Operario
    {
        private $_apellido;
        private $_nombre;
        private $_legajo;
        private $_salario;

        function __construct($legajo, $nombre, $apellido)
        {
            $this->_legajo = $legajo;
            $this->_nombre = $nombre;
            $this->_apellido = $apellido;
            $this->_salario = 15000;
        }

        function Equals($op)
        {
            if($this->_legajo == $op->_legajo)
                return TRUE;
            else
                return FALSE;
        }

        function GetNombreApellido()
        {
            return "$this->_apellido, $this->_nombre";
        }

        function GetSalario()
        {
            return $this->_salario;
        }

        function Mostrar()
        {
            return "OPERARIO: ".$this->GetNombreApellido().". LEGAJO: $this->_legajo. SALARIO: ".$this->GetSalario()."<br>";
            
        }

        static function CMostrar($op)
        {
            return $op.Mostrar();
        }

        function SetAumentarSalario($aumento)
        {
            $this->_salario += ($this->_salario * $aumento) / 100;
        }                
    }
?>