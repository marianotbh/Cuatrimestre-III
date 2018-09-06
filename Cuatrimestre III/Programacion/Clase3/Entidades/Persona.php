<?php
    class Persona
    {
        private $nombre;
        private $apellido;
        private $edad;
        private $legajo;

        function __construct($nom, $ape, $eda, $leg)
        {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->edad = $eda;
            $this->legajo = $leg;
        }

        function __get($var)
        {
            return $this->$var;
        }
        function __set($var, $val)
        {
            $this->$var = $val;
        }

        function __toString()
        {
            return "$this->nombre-$this->apellido-$this->edad-$this->legajo".PHP_EOL;
        }

        static function CargarPersona($p)
        {
            $ret = false;
            $ppl = self::LevantarPersonas("Lista.txt");
            if(self::BuscarPorLegajo($ppl, $p->legajo))
                echo "La persona ya se encuentra en la lista";
            else
            {
                $ppl[] = $p;
                $ret = true;
            }            
            self::BajarPersonas($ppl, "Lista.txt");
            return $ret;
        }
    
        static function ModificarPersona($p)
        {
            $ret = false;
            $ppl = self::LevantarPersonas("Lista.txt");
            $persona = self::BuscarPorLegajo($ppl, $p->legajo);
            echo "$persona";
            if($persona == null)
                echo "No se encuentra la persona que quiere modificar.";
            else
            {
                $key = array_search($persona, $ppl);
                $persona = $p;
                $ret = true;
                $ppl[$key] = $persona;
            }
            self::BajarPersonas($ppl, "Lista.txt");
            return $ret;
        }
    
        static function BorrarPersona($p)
        {
            $ret = false;
            $ppl = self::LevantarPersonas("Lista.txt");
            if(self::BuscarPorLegajo($ppl, $p->legajo))
            {
                $key = array_search($p, $ppl);
                echo $key;
                unset($ppl[$key]);
                $ret = true;
            }
            else
                echo "La persona no se encuentra en la lista";
            self::BajarPersonas($ppl, "Lista.txt");
            return $ret;         
        }

        static function BuscarPorLegajo($ppl, $legajo)
        {
            foreach((array)$ppl as $p)
            {
                if((int)$p->legajo == (int)$legajo)
                {
                    return $p;
                }
            }
            return null;
        }

        static function LevantarPersonas($file)
        {
            $ref = fopen($file, "r");
            while(!feof($ref))
            {
                $persona = explode("-", fgets($ref));
                if(count($persona) == 4)
                {
                    $personas[] = new Persona($persona[0], $persona[1], $persona[2], $persona[3]);
                }
            }
            fclose($ref);
            return $personas;
        }

        static function BajarPersonas($ppl, $file)
        {
            $ref = fopen($file, "w");
            foreach($ppl as $peep)
            {
                fwrite($ref, "$peep");
            }
            fclose($ref);
        }
    }

?>