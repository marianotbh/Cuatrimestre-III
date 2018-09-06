<?php
    include("./Clases/BD.php");
    $bd = new BD();
    
    function act($action)
    {
        $pers = new Persona($_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["legajo"], $_FILES["foto"]);
        switch($action)
        {
            case "Cargar":
                if($pers->Cargar())
                    echo "Cargado";
                break;
            case "Modificar":
                if($pers->Modificar())
                    echo "Modificado";
                break;
            case "Borrar":
                if($pers->Borrar())
                    echo "Borrado";
                break;
            case "Listar":
                if($pers->Listar())
                    echo "Fin de lista";
                break;
        }
    }
    
    function ValidarFoto($file)
    {
        $imgTypes = array("jpg", "png", "bmp", "gif", "tif", "jpeg");
        $ext = explode(".", $file["name"]);
        echo $ext[1];
        if($file["size"] <= 10000000 && in_array($ext[1], $imgTypes))
        {
            return true;
        }
        return false;
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
?>