<?php
    include("./Entidades/App24/Operario.php");
    class Fabrica
    {
        private $_cantMaxOperarios;
        private $_operarios;
        private $_razonSocial;

        function __construct($rs)
        {
            $this->_cantMaxOperarios = 5;
            $this->_razonSocial = $rs;
            $this->_operarios = array();
        }

        function Add($op)
        {
            if(!$this->Equals($op) && count((array)$this->_operarios) < $this->_cantMaxOperarios)
            {
                $this->_operarios[] = $op;
            }
            else
                echo "No se pudo agregar el operario: ".$op->Mostrar();
        }

        function Equals($op)
        {
            foreach($this->_operarios as $operario)
            {
                if($op->Equals($operario))
                {
                    return TRUE;
                }
            }
            return FALSE;
        }

        function Mostrar()
        {
            return "<br>$this->_razonSocial. Cant. Máx. de Operarios: $this->_cantMaxOperarios <br>".$this->MostarOperarios()."Costos a cubrir: ".Fabrica::MostrarCosto($this)."<br>";
        }

        static function MostrarCosto($f)
        {
            return $f->RetornarCostos();
        }

        function MostarOperarios()
        {
            $s = "";
            foreach($this->_operarios as $op)
            {
                $s .= $op->Mostrar();
            }
            return $s;
        }

        function Remove($op)
        {
            if($this->Equals($op))
            {
                $key = array_search($op, $this->_operarios);
                unset($this->_operarios[$key]);
                return TRUE;
            }
            else
            {
                echo "El operario no se encuentra en la lista";
                return FALSE;
            }                
        }

        private function RetornarCostos()
        {
            $costo = 0;
            foreach($this->_operarios as $op)
            {
                $costo += $op->GetSalario();
            }
            return $costo;
        }
    }
?>