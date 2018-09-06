<?php
    include_once("./Clases/Alumno.php");
    include_once("./Clases/Materia.php");

    if(isset($_POST) && count($_POST) != 0)
    {
        switch($_POST["accion"])
        {
            case "cargarAlumno":
                echo Alumno::Cargar(new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["mail"], CargarFoto($_POST["nombre"], $_FILES["foto"], "./Fotos/")));
                break;                    
            case "cargarMateria":
                echo Materia::Cargar(new Materia($_POST["nombre"],$_POST["codigo"],$_POST["cupo"],$_POST["aula"]));
                break;
            case "modificarAlumno":
                echo Alumno::ModificarAlumno($_POST["mail"], $_POST["nombre"], $_POST["apellido"], CargarFoto($_POST["nombre"], $_FILES["foto"], "./Fotos/"));
                break;
        }  
    } else if(isset($_GET))
    {
        switch($_GET["accion"])
        {
            case "consultarAlumno":
                echo Alumno::Consultar($_GET["apellido"]);
                break;
            case "inscribirAlumno":
                echo Materia::InscribirAlumno($_GET["nombre"], $_GET["apellido"], $_GET["mail"], $_GET["materia"], $_GET["codigo"]);
                break;
            case "inscripciones":
                echo Materia::AlumnosInscriptos($_GET["materia"], $_GET["apellido"]);
                break;
            case "alumnos":
                echo Alumno::Mostrar();
                break;
        } 
    } 
?>

<br><br><a href="html.html">VOLVER</a>