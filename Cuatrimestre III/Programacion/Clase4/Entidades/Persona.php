<?php
    class Persona
    {
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

        function CargarPersona()
        {
            $ret = false;
            $ppl = $this->LevantarPersonas("Lista.txt");
            if($this->BuscarPorLegajo($ppl, $this->legajo))
                echo "La persona ya se encuentra en la lista";
            else
            {
                $this->foto = $this->CargarFoto($this->foto);
                $ppl[] = $this;
                $ret = true;
            }            
            $this->BajarPersonas($ppl, "Lista.txt");
            return $ret;
        }
    
        function ModificarPersona()
        {
            $ret = false;
            $ppl = $this->LevantarPersonas("Lista.txt");
            $persona = $this->BuscarPorLegajo($ppl, $this->legajo);
            if($persona == null)
                echo "No se encuentra la persona que quiere modificar.";
            else
            {
                $this->BackUp($persona->foto);
                $key = array_search($persona, $ppl);
                $persona = $this;
                $persona->foto = $this->CargarFoto($persona->foto);
                $ppl[$key] = $persona;
                $ret = true;
            }
            $this->BajarPersonas($ppl, "Lista.txt");
            return $ret;
        }
    
        function BorrarPersona()
        {
            $ret = false;
            $ppl = $this->LevantarPersonas("Lista.txt");
            if($this->BuscarPorLegajo($ppl, $this->legajo))
            {
                $key = array_search($this, $ppl);
                echo $key;
                unset($ppl[$key]);
                $ret = true;
            }
            else
                echo "La persona no se encuentra en la lista";
            $this->BajarPersonas($ppl, "Lista.txt");
            return $ret;         
        }

        function BuscarPorLegajo($ppl, $legajo)
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

        function LevantarPersonas($file)
        {
            $personas = array();
            $ref = fopen($file, "r");
            while(!feof($ref))
            {
                $persona = explode("-", fgets($ref));
                if(count($persona) == 5)
                {
                    $personas[] = new Persona($persona[0], $persona[1], $persona[2], $persona[3], $persona[4]);
                }
            }
            fclose($ref);
            return $personas;
        }

        function BajarPersonas($ppl, $file)
        {
            $ref = fopen($file, "w");
            foreach($ppl as $peep)
            {
                fwrite($ref, "$peep");
            }
            fclose($ref);
        }

        function CargarFoto($file)
        {
            $ext = explode(".", $file["name"]);
            $foto = "foto_".$_POST["legajo"].".".$ext[1];
            if(move_uploaded_file($file["tmp_name"], "../img/$foto"))
                echo "<p>Archivo movido con exito</p>";
            return $foto;
        }

        function BackUp($file)
        {
            $origen = "../img/$file";
            $destino = "../backup/backup_$file";
            if(copy(trim($origen), trim($destino)))
                echo "<p>Guardada copia de respaldo</p>";
        }
    }

?>