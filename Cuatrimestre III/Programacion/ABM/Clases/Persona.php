<?php
    include_once("./Clases/Archivos.php");
    include_once("./Clases/BD.php");
    class Persona
    {
        static private $archivo = "./Lista.txt";
        private $nombre;
        private $apellido;
        private $edad;
        private $legajo;
        private $foto;

        function __construct($nom, $ape, $eda, $leg, $fot)
        {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->edad = $eda;
            $this->legajo = $leg;
            $this->foto = $fot;
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
            return "$this->nombre-$this->apellido-$this->edad-$this->legajo-$this->foto".PHP_EOL;
        }

        static function Cargar($p)
        {
            $ret = "No se pudo cargar a $p->nombre $p->apellido ";
            echo "Archivo: ".Self::$archivo;
            $ppl = Self::PickUpPersonasFromFile(Self::$archivo, 5, "-");
            if(Self::BuscarPorLegajo($ppl, $p->legajo))
                $ret = "La persona ya se encuentra en la lista";
            else
            {
                $ppl[] = $p;
                DropToFile($ppl, Self::$archivo);
                BD::Cargar($p);
                $ret = "Cargado con éxito";
            }            
            return $ret;
        }
    
        static function Modificar($legajo, $nombre, $apellido, $edad, $foto)
        {
            $ret = "No se pudo modificar a $nombre $apellido";
            $ppl = Self::PickUpPersonasFromFile(Self::$archivo, 5, "-");
            $persona = Self::BuscarPorLegajo($ppl, $legajo);
            if($persona == null)
                $ret = "No se encuentra la persona que quiere modificar.";
            else
            {
                BackUp($persona->foto);
                $key = array_search($persona, $ppl);
                $persona->nombre = $nombre;
                $persona->apellido = $apellido;
                $persona->edad = $edad;
                $persona->foto = $foto;
                $ppl[$key] = $persona;
                DropToFile($ppl, Self::$archivo);
                BD::Modificar($legajo, $nombre, $apellido, $edad, $foto);
                $ret = "Modificado con éxito";
            }            
            return $ret;
        }
    
        static function Borrar($legajo)
        {
            $ret = false;
            $ppl = Self::PickUpPersonasFromFile(Self::$archivo, 5, "-");
            $paBorrar = Self::BuscarPorLegajo($ppl, $legajo);
            if($paBorrar != null)
            {
                $key = array_search($paBorrar, $ppl);
                unlink($ppl[$key]->foto);
                unset($ppl[$key]);
                DropToFile($ppl, Self::$archivo);
                BD::Borrar($legajo);                
                $ret = "Borrado con éxito";
            }
            else
                $ret = "La persona no se encuentra cargada";
            return $ret;      
        }

        static function Listar()
        {
            $ret = "";
            $personas = Self::PickUpPersonasFromFile(Self::$archivo, 5, "-");
            if(count($personas) > 0)
            {
                foreach($personas as $p)
                {
                    $ret .= "$p";
                }
            }
            else
                $ret = "No hay personas para listar";
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

        
        static function PickUpPersonasFromFile($file, $objProperties, $delimiter)
        {
            $obj;
            $arr = null;
            $ref = fopen($file, "r");
            rewind($ref);
            while(!feof($ref))
            {
                if(count($obj = explode($delimiter, fgets($ref))) == $objProperties)
                {
                    $arr[] = new Persona($obj[0], $obj[1], $obj[2], $obj[3], $obj[4]);
                }
            }
            fclose($ref);
            return $arr;
        }
    }
?>