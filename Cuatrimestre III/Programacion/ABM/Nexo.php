<?php
    include_once("./Clases/Archivos.php");
    include_once("./Clases/Persona.php");

    if(count($_POST) != 0)
    {
        if(ValidarFoto($_FILES["foto"]))
        {
            switch($_POST["accion"])
            {
                case "Cargar":
                    echo Persona::Cargar(new Persona($_POST["nombre"], $_POST["apellido"], $_POST["edad"], $_POST["legajo"], CargarFoto($_FILES["foto"])));
                    break;
                case "Modificar":
                    echo Persona::Modificar($_POST["legajo"], $_POST["nombre"], $_POST["apellido"], $_POST["edad"], CargarFoto($_FILES["foto"]));
                    break;
                case "Borrar":
                    echo Persona::Borrar($_POST["legajo"]);
                    break;
            }
        } else
        echo "Imagen invalida";   
    }
    else if(isset($_GET))
    {
        echo Persona::Listar();
    }    
?>

<br><br><a href="html.html">VOLVER</a>