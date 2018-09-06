<?php
    include("./Clases/Persona.php");
    class BD 
    {
        static private $server;
        static private $username;
        static private $password;
        static private $pdo;
        static private $isinit = false;

        static function setup()
        {
            if(Self::$isinit == false)
            {
                Self::$server = "mysql:host=localhost;dbname=personas";
                Self::$username = "root";
                Self::$password = "";
                try {
                    Self::$pdo = new PDO(Self::$server, Self::$username, Self::$password);
                    Self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "Connected successfully";
                }
                catch(PDOException $e)
                {
                    echo "Connection failed: ".$e->getMessage();
                }
                Self::$isinit = true;
            }
        }

        static function init()
        {
            Self::setup();
        }

        static function Cargar($persona)
        {
            Self::init();
            $qry = "INSERT INTO Personas(Nombre, Apellido, Edad, Legajo, Foto) VALUES('$persona->nombre', '$persona->apellido', '$persona->edad', '$persona->legajo', '$persona->foto')";
            Self::EjecutarQuery($qry);
        }

        static function Modificar($legajo, $nombre, $apellido, $edad, $foto)
        {
            Self::init();
            $qry = "UPDATE Personas SET Nombre='$nombre', Apellido='$apellido', Edad='$edad', Foto='$foto' WHERE Legajo='$legajo'";
            Self::EjecutarQuery($qry);
        }

        static function Borrar($legajo)
        {
            Self::init();
            $qry = "DELETE FROM Personas WHERE Legajo='$legajo'";
            Self::EjecutarQuery($qry);
        }

        static private function EjecutarQuery($string)
        {
            try {
                Self::$pdo->exec($string);
                echo "Ejecutado con exito";
            } catch(PDOException $e)
            {
                echo $sql."<br>".$e->getMessage();
            }
        }
    }
?>