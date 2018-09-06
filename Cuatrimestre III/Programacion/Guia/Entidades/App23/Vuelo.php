<?php
    include_once("./Entidades/App23/Pasajero.php");
    class Vuelo
    {
        private $_fecha;
        private $_empresa;
        private $_precio;
        private $_listaDePasajeros;
        private $_cantMaxima;

        function __construct($empresa, $precio, $fecha, $cantMaxima = "")
        {
            $this->_empresa = $empresa;
            $this->_precio = $precio;
            $this->_fecha = $fecha;
            $this->_cantMaxima = $cantMaxima;
            $this->_listadoDePasajeros = array();
        }

        function GetCantMax()
        {
            return $this->_cantMaxima;
        }

        function GetInfoVuelo()
        {
            $fecha = "-";
            if($this->_fecha != "")
            {
                 $fecha = $this->_fecha->format('Y-m-d');
            }                
            $s = "Fecha: $fecha <br>
                  Empresa: $this->_empresa <br>
                  Precio: $$this->_precio <br>
                  Cant. Máx. de Pasajeros: $this->_cantMaxima <br>";
            foreach($this->_listaDePasajeros as $pasajero)
            {
                $s .= $pasajero->GetInfoPasajero();
            }
            return $s;
        }

        function AgregarPasajero($p)
        {
            if(!$this->Equals($p) && count((array)$this->_listaDePasajeros) < $this->_cantMaxima)
            {
                $this->_listaDePasajeros[] = $p;
                return 0;
            }
            else
            {
                echo "No se pudo agregar pasajero: ".$p->GetInfoPasajero();
                return 1;
            }
        }

        function Equals($p)
        {
            foreach((array)$this->_listaDePasajeros as $pasajero)
            {
                if($p->Equals($pasajero))
                    return TRUE;
            }
            return FALSE;
        }

        function MostrarVuelo()
        {
            echo $this->GetInfoVuelo();
        }

        static function Add($v1, $v2)
        {
            $totalV1 = $this->Recaudar($v1);
            $totalV2 = $this->Recaudar($v2);
            return ($totalV1 + $totalV2);            
        }

        function Recaudar($v)
        {
            $total;
            foreach($v->_listaDePasajeros as $pasajero)
            {
                if($pasajero->_esPlus)
                {
                    $total += ($v->_precio * 0.8);
                }
                else
                    $total += $v->_precio;
            }
            return $total;
        }

        static function Remove($p)
        {        
            if($this->Equals($p))
            {
                $key = array_search($p, $this->_listaDePasajeros);
                unset($this->_listaDePasajeros[$key]);
            }
            else
                echo "<br>(!!!) El auto no se encuentra en el garage";
            return $this;
        }
    }

?>