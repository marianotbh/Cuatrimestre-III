<?php
    include_once("../Entidades/Persona.php");

    var_dump($_POST);
    var_dump($_FILES);
    
    if(ValidarFoto($_FILES["foto"]))
    {
        $pers = new Persona($_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["legajo"], $_FILES["foto"]);
        
        switch($_POST["btn"])
        {
            case "Cargar":
                if($pers->CargarPersona())
                    echo "Cargado";
                break;
            case "Modificar":
                if($pers->ModificarPersona())
                    echo "Modificado";
                break;
            case "Borrar":
                if($pers->BorrarPersona())
                    echo "Borrado";
                break;
        }
    }  
    else
        echo "Imagen invalida";

    function ValidarFoto($file)
    {
        $imgTypes = array("jpg", "png", "bmp", "gif", "tif", "jpeg");
        $ext = explode(".", $file["name"]);
        if($file["size"] >= 10000000 && in_array($ext[1], $imgTypes))
        {
            return true;
        }
        else
            return false;
    }
?>

<br><br><a href="html.html">VOLVER</a>