<?php
    include_once("./Clases/Helado.php");
    //include_once("./Clases/Venta.php");

    if(isset($_POST) && count($_POST) != 0)
    {
        echo "POST REQUEST: ".$_POST["accion"]."<br>";
        switch($_POST["accion"])
        {            
            case "ConsultarHelado":
                echo Helado::Consultar($_POST["sabor"], $_POST["tipo"]);
                break;                    
            case "AltaVenta":
                echo Helado::AltaVenta($_POST["email"], $_POST["sabor"], $_POST["tipo"], $_POST["cantidad"]);
                break;
            case "AltaVentaConImagen":
                echo Helado::AltaVenta($_POST["email"], $_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_FILES["foto"]);
                break;
            case "HeladosModificacion":
                echo Helado::Modificar($_POST["saborYTipoDeBusqueda"], $_POST["sabor"], $_POST["tipo"], $_POST["precio"], $_POST["cantidad"], $_FILES["foto"]);
                break;
            case "BorrarHelado":
                echo Helado::Borrar($_POST["sabor"], $_POST["tipo"]);
                break;
        }  
    }
    else if(isset($_GET) && count($_GET) != 0)
    {
        echo "GET REQUEST: ".$_GET["accion"]."<br>";
        switch($_GET["accion"])
        {
            case "CargarHelado":
                echo Helado::Cargar(new Helado($_GET["sabor"], $_GET["precio"], $_GET["tipo"], $_GET["cantidad"]));
                break;
            case "TablaVentas":
                echo Helado::Tabla($_GET["email"], $_GET["sabor"]); 
                break;
            case "ListadoDeImagenes":
                echo Helado::Listar();
                break;
        } 
    } 
?>