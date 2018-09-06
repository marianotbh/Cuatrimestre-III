<?php
    include_once("./Cliente.php");
    include_once("./Helado.php");
    if(isset($_POST))
    {
        switch($_POST["accion"])
        {
            case "cargarCliente":
                echo Cliente::cargarCliente($_POST["nombre"], $_POST["correo"], $_POST["clave"]);
                break;
            case "validar":
                echo Cliente::validar($_POST["correo"], $_POST["clave"]);
                break;
            case "cargarHelado":
                echo Helado::cargarHelado(new Helado($_POST["sabor"], $_POST["precio"], $_FILES["foto"]));
                break;
            case "borrarHelados":
                $h = new Helado($_POST["sabor"], $_POST["precio"], $_FILES["foto"]);
                echo $h->borrarHeladosPOST();
                break;
        } 
    } else if(isset($_GET))
    {
        switch($_GET["accion"])
        {
            case "vender":
                $h = new Helado($_POST["sabor"], $_POST["precio"], $_FILES["foto"]);
                echo $h->vender();
                break;
            case "ListadoHelados":
                echo Helado::ListadoHelados();
                break;
            case "borrarHelados":
                $h = new Helado($_POST["sabor"], $_POST["precio"], $_FILES["foto"]);
                echo $h->borrarHeladoGET();
                break;
        }
    }
?>

<br><br><a href="html.html">VOLVER</a>