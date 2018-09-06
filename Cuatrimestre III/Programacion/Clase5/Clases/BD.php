<?php
    include("./Clases/Persona.php");
    class BD 
    {
        private $con;
        private $user;
        private $clave;
        private $pdo;

        function __construct()
        {
            $con = "mysql:host=localhost;dbname=cdcol;charset=utf8";
            $user = "root";
            $clave = "";
            $pdo = new PDO($con, $user, $clave);
        }

        function Cargar($persona)
        {
            $pdo;
            $sql = "INSERT INTO Personas(Nombre, Apellido, DNI, Legajo, Foto) VALUES('$persona->nombre', '$persona->apellido', '$persona->dni', '$persona->legajo', '$persona->foto')";
        }

        function Modificar($persona)
        {

        }

        function Borrar($legajo)
        {

        }

        function EjecutarQuery($string)
        {
            $sql = $comm->query($string);
            $res = $sql->execute();
        }
    }
?>