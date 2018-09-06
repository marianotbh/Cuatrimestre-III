<?php
    include_once("./Clases/Persona.php");
    include_once("./Clases/Archivos.php");
    
    if(ValidarFoto($_FILES["foto"]))
    {
        if(isset($_POST))
        {
            act($_POST["accion"]);
        }
        else if(isset($_GET))
        {
            act("Listar");
        }
    }  
    else
        echo "Imagen invalida";
?>

<br><br><a href="html.html">VOLVER</a>