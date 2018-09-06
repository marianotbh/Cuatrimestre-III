<?php
    include_once("./Entidades/App21/Auto.php");    
    class Garage 
    {
        private $_razonSocial;
        private $_precioPorHora;
        private $_autos;

        function __construct($razonSocial, $precioPorHora = "")
        {
            $this->_razonSocial = $razonSocial;
            $this->_precioPorHora = $precioPorHora;
        }

        function MostrarGarage()
        {
            $s = "<br>Razón: $this->_razonSocial <br>
                   Hora: $$this->_precioPorHora <br>";
            foreach((array)$this->_autos as $auto)
            {
                $s .= $auto->MostrarAuto();
            }
            echo $s;
        }

        function Equals($a)
        {
            foreach((array)$this->_autos as $auto)
            {
                if($auto->Equals($a))
                {
                    return TRUE;
                }
            }
            return FALSE;
        }

        function Add($a)
        {
            if(!$this->Equals($a))
            {
                $this->_autos[] = $a;
            }
            else
                echo "<br>(!!!) El auto ya se encuentra en el garage.";
        }

        function Remove($a)
        {        
            if($this->Equals($a))
            {
                $key = array_search($a, $this->_autos);
                unset($this->_autos[$key]);
            }
            else
                echo "<br>(!!!) El auto no se encuentra en el garage";
        }
    }
?>