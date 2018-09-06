<?php
    include_once("./clases/Cliente.php");
    include_once("./clases/Empleado.php");
    include_once("./clases/Helado.php");
    include_once("./clases/Localidad.php");
    include_once("./clases/Local.php");

    if(isset($_POST) && count($_POST) != 0) {
        switch($_POST["accion"]) {
            case "ConsultarHelado":
                echo Helado::Traer($_POST["sabor"], $_POST["tipo"]);
                break;                    
            case "ConsultarCliente":
                echo Cliente::Traer($_POST["nacionalidad"], $_POST["sexo"]);
                break;
            case "ConsultarEmpleado":
                echo Empleado::Traer($_POST["turno"], $_POST["tipo"]); 
                break;
            case "ConsultarLocalidad":
                echo Localidad::Traer($_POST["nombre"], $_POST["provincia"]);
                break;
            case "ConsultarLocal":
                echo Local::Traer($_POST["direccion"], $_POST["idLocalidad"]);
                break;
        }  
    } else if(isset($_GET) && count($_GET) != 0) {
        switch($_GET["accion"]) {
            case "HeladoCarga":
                Helado::Insertar($_GET["sabor"], $_GET["precio"],$_GET["tipo"], $_GET["cantidad"]); 
                break;
            case "ClienteCarga":
                Cliente::Insertar($_GET["nombre"], $_GET["nacionalidad"],$_GET["sexo"], $_GET["edad"]);
                break;
            case "EmpleadoCarga":
                Empleado::Insertar($_GET["nombre"], $_GET["turno"],$_GET["tipo"]);
                break;
            case "LocalidadCarga":
                Localidad::Insertar($_GET["nombre"], $_GET["provincia"],$_GET["estado"]);
                break;
            case "LocalCarga":
                Local::Insertar($_GET["direccion"], $_GET["idLocalidad"],$_GET["estado"]);
                break;
        } 
    } 
?>