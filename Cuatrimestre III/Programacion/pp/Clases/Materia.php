<?php
    include_once("./Clases/Archivos.php");
    class Materia
    {
        static private $archivo = "./materias.txt";
        private $nombre;
        private $codigo;
        private $cupo;
        private $aula;

        function __construct($nom, $cod, $cupo, $aula)
        {
            $this->nombre = $nom;
            $this->codigo = $cod;
            $this->cupo = $cupo;
            $this->aula = $aula;
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

        static function Cargar($m)
        {
            $ret = "No se pudo cargar a $m->nombre $m->apellido ";
            echo "Archivo: ".Self::$archivo;
            $materias = Self::PickUpMateriasFromFile(Self::$archivo, 4, "-");
            if(Self::BuscarPorCodigo($materias, $m->codigo))
                $ret = "La materia ya se encuentra en la lista";
            else
            {
                $materias[] = $m;
                DropToFile($materias, Self::$archivo);
                $ret = "Cargado con éxito";
            }            
            return $ret;
        }

        static function BuscarPorCodigo($materias, $codigo)
        {
            foreach((array)$materias as $m)
            {
                if($m->codigo == $codigo)
                {
                    return $m;
                }
            }
            return null;
        }

        function RestarCupo()
        {
            if((int)$this->cupo > 0)
            {
                (int)$this->cupo--;
            }
        }

        static function InscribirAlumno($nombre, $apellido, $mail, $materia, $codigo)
        {
            $ref;
            $key;
            $materias = Self::PickUpMateriasFromFile(Self::$archivo, 4, "-");
            if(count($materias) != 0)
            {
                $m = Self::BuscarPorCodigo($materias, $codigo);
                if($m != null)
                {
                    $ref = fopen("./inscripciones.txt", "a");
                    $m->RestarCupo();
                    $key = array_search($m, $materias);
                    $materias[$key] = $m;
                    fwrite($ref, "$nombre-$apellido-$mail-$materia-$codigo".PHP_EOL);
                    fclose($ref);
                }
            }
        }

        static function AlumnosInscriptos($materia = "", $apellido = "")
        {
            $ret;
            if($materia != "" && $apellido == "")
            {
                $ret = Self::ListarInscripciones($materia);
            } else if($apellido != "" && $materia == "")
            {
                $ret = Self::ListarInscripciones($apellido);
            } else {
                $ret = Self::ListarInscripciones();
            }
            return $ret;
        }

        static function ListarInscripciones($filtro = "")
        {
            $ref = fopen("./inscripciones.txt", "a");
            $inscripcion;
            $table = "<table><tr><th>Nombre</th><th>Apellido</th><th>Mail</th><th>Materia</th><th>Codigo</th></tr>";
            while(!feof($ref))
            {
                if($filtro != "")
                {
                    if($inscripcion[1] == $filtro || $inscripcion[4] == $filtro)
                    {
                        $inscripcion = explode("-", fgets($ref));
                        $table .= "<tr><td>".$inscripcion[0]."</td>
                                    <td>".$inscripcion[1]."</td>
                                    <td>".$inscripcion[2]."</td>
                                    <td>".$inscripcion[3]."</td>
                                    <td>".$inscripcion[4]."</td></tr>";
                    }
                } else {
                    $inscripcion = explode("-", fgets($ref));
                    $table .= "<tr><td>".$inscripcion[0]."</td>
                                <td>".$inscripcion[1]."</td>
                                <td>".$inscripcion[2]."</td>
                                <td>".$inscripcion[3]."</td>
                                <td>".$inscripcion[4]."</td></tr>";
                }
            }
            $table .= "</table>";
            return $table;
        }
        
        static function PickUpMateriasFromFile($file, $objProperties, $delimiter)
        {
            $obj;
            $arr = null;
            $ref = fopen($file, "r");
            rewind($ref);
            while(!feof($ref))
            {
                if(count($obj = explode($delimiter, fgets($ref))) == $objProperties)
                {
                    $arr[] = new Materia($obj[0], $obj[1], $obj[2], $obj[3], $obj[4]);
                }
            }
            fclose($ref);
            return $arr;
        }
    }
?>