<?php
    include_once("./Clases/Archivos.php");
    class Alumno
    {
        static private $archivo = "./alumnos.txt";
        private $nombre;
        private $apellido;
        private $mail;
        private $foto;

        function __construct($nom, $ape, $mail, $fot)
        {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->mail = $mail;
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
            return "$this->nombre-$this->apellido-$this->mail-$this->foto".PHP_EOL;
        }

        static function Cargar($a)
        {
            $ret = "No se pudo cargar a $a->nombre $a->apellido ";
            $alumnos = Self::PickUpAlumnosFromFile(Self::$archivo, 4, "-");
            if(count($alumnos) > 0)
            {
                if(Self::BuscarPorMail($alumnos, $a->mail) != null)
                    $ret = "La persona ya se encuentra en la lista";
            }                
            else
            {
                $alumnos[] = $a;
                DropToFile($alumnos, Self::$archivo);
                $ret = "Cargado con éxito";
            }            
            return $ret;
        }

        static function Consultar($apellido)
        {
            $ret;
            $alumnos = Self::PickUpAlumnosFromFile(Self::$archivo, 4, "-");
            $alumnosApellidados = Self::BuscarPorApellido($alumnos, $apellido);
            if(count($alumnosApellidados) == 0)
                $ret = "No se hay un alumno con apellido $apellido";
            else
            {
                $ret = $alumnosApellidados;
            }            
            return $ret;
        }
    
        static function Modificar($mail, $nombre, $apellido, $foto)
        {
            $ret = "No se pudo modificar a $nombre $apellido";
            $alumnos = Self::PickUpAlumnosFromFile(Self::$archivo, 4, "-");
            $alumno = Self::BuscarPorMail($alumnos, $mail);
            if($alumno == null)
                $ret = "No se encuentra la persona que quiere modificar.";
            else
            {
                BackUp($alumno->foto, "./backUpFotos");
                $key = array_search($alumno, $alumnos);
                $alumno->nombre = $nombre;
                $alumno->apellido = $apellido;
                $alumno->foto = $foto;
                $alumnos[$key] = $alumno;
                DropToFile($alumnos, Self::$archivo);
                $ret = "Modificado con éxito";
            }            
            return $ret;
        }

        static function Listar()
        {
            $ret = "";
            $alumnos = Self::PickUpAlumnosFromFile(Self::$archivo, 4, "-");
            if(count($alumnos) > 0)
            {
                foreach($alumnos as $a)
                {
                    $ret .= "$a";
                }
            }
            else
                $ret = "No hay personas para listar";
            return $ret;
        }

        static function BuscarPorApellido($alumnos, $apellido)
        {
            echo "buscando por apèllido";
            $alumnosApellidados = array();
            foreach((array)$alumnos as $a)
            {
                if($a->apellido == $apellido)
                {
                    $alumnosApellidados[] = $a;
                }
            }
            return $alumnosApellidados;
        }
        
        static function BuscarPorMail($alumnos, $mail)
        {
            echo "buscando por mail";
            foreach($alumnos as $a)
            {
                if($a->mail == $mail)
                {
                    return $a;
                }
            }
            return null;
        }

        static function Mostrar()
        {
            $ref = fopen(Self::$archivo, "r");
            $alumno;
            $table = "<table><tr><th>Nombre</th><th>Apellido</th><th>Mail</th><th>Foto</th></tr>";
            while(!feof($ref))
            {
                $alumno = explode("-", fgets($ref));
                $table .= "<tr><td>".$alumno[0]."</td>
                            <td>".$alumno[1]."</td>
                            <td>".$alumno[2]."</td>
                            <td><img src='".$alumno[3]."'/></td></tr>";
            }
            $table .= "</table>";
            return $table;
        }
        
        static function PickUpAlumnosFromFile($file, $objProperties, $delimiter)
        {
            $obj;
            $arr = null;
            $ref = fopen($file, "r");
            rewind($ref);
            echo "pickingup from file";
            while(!feof($ref))
            {
                if(count($obj = explode($delimiter, fgets($ref))) == $objProperties)
                {
                    $arr[] = new Alumno($obj[0], $obj[1], $obj[2], $obj[3]);
                }
            }
            fclose($ref);
            return $arr;
        }
    }
?>