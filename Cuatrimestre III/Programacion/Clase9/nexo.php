<?php
    include_once("./Entidades/Cliente.php");
    include_once("./Entidades/Helado.php");
    include_once("./Entidades/Empleado.php");
    include_once("./Entidades/Localidad.php");
    include_once("./Entidades/Local.php");
    include_once("./Entidades/Venta.php");

    if(isset($_POST["caso"]) && !empty($_POST["caso"]))
    {     
        $caso = $_POST["caso"];
        switch($caso)
        {
            /*ConsultarCliente.php: (por POST) Se ingresa nacionalidad y sexo si coincide con algún registro mostrar 
            todos los clientes, de lo contrario informar si no hay de esa nacionalidad y/o de ese sexo.*/
            case "ConsultarCliente":
                $nacionalidad = $_POST["nacionalidad"];
                $sexo = $_POST["sexo"];
                $response = Cliente::Consultar($nacionalidad,$sexo);
                if(Count($response) > 0){
                    foreach($response as $res){
                        echo $res->MostrarDatos()."<br/>";
                    }    
                }
                else{
                    echo "No hay registros coincidentes.";
                }                            
                break;

            /*ConsultarHelado.php: (por POST) Se ingresa Sabor, 
            Tipo, si coincide con algún registro, retornar “Si Hay”. 
            De lo contrario informar si no existe el tipo o el sabor.*/
            case "ConsultarHelado":
                $sabor = $_POST["sabor"];
                $tipo = $_POST["tipo"];
                $response = Helado::Consultar($sabor,$tipo);
                
                if(Count($response) > 0)
                {
                    echo "Sí hay."; 
                }
                else
                {
                    echo "No hay registros coincidentes.";
                }                
                break;

            /*ConsultarEmpleado.php: (por POST) Se ingresa turno, tipo, si coincide con algún registro, 
            retornar el listado de coincidencias de lo contrario informar que no hay, si de ese tipo o de ese turno.*/
            case "ConsultarEmpleado":
                $turno = $_POST["turno"];
                $tipo = $_POST["tipo"];
                $response = Empleado::Consultar($turno,$tipo);
                $hayTurnoyTipo = false;
                $hayTurno = false;
                $hayTipo = false;

                if(Count($response) > 0){
                    foreach($response as $res){
                        if($res->turno == $turno && $res->tipo == $tipo){
                            echo $res->MostrarDatos()."<br/>";
                            $hayTurnoyTipo = true;
                        }
                        else if($hayTurnoyTipo == false && $res->turno == $turno){
                            $hayTurno = true;
                        }
                        else if($hayTurnoyTipo == false && $res->tipo == $tipo){
                            $hayTipo = true;
                        }                          
                    }    

                    if($hayTurno && !$hayTipo){
                        echo "No coincidió el tipo";
                    }
                    else if(!$hayTurno && $hayTipo){
                        echo "No coincidió el turno";
                    }
                    else if(!$hayTurnoyTipo && $hayTurno && $hayTipo){
                        echo "Existen registros con ese turno y con ese tipo, pero no con los dos al mismo tiempo.";
                    }
                }
                else{
                    echo "No hay registros coincidentes (ni turno ni tipo).";
                }             
                break;

            /*ConsultarLocalidad.php: (por POST) Se ingresa nombre, provincia, si coincide con algún registro, 
            retornar el listado de coincidencias de lo contrario informar que condición no cumple.*/
            case "ConsultarLocalidad":
                $provincia = $_POST["provincia"];
                $nombre = $_POST["nombre"];
                $response = Localidad::Consultar($provincia,$nombre);
                $hayprovinciaynombre = false;
                $hayprovincia = false;
                $haynombre = false;

                if(Count($response) > 0){
                    foreach($response as $res){
                        if($res->provincia == $provincia && $res->nombre == $nombre){
                            echo $res->MostrarDatos()."<br/>";
                            $hayprovinciaynombre = true;
                        }
                        else if($hayprovinciaynombre == false && $res->provincia == $provincia){
                            $hayprovincia = true;
                        }
                        else if($hayprovinciaynombre == false && $res->nombre == $nombre){
                            $haynombre = true;
                        }                          
                    }    

                    if($hayprovincia && !$haynombre){
                        echo "No coincidió el nombre";
                    }
                    else if(!$hayprovincia && $haynombre){
                        echo "No coincidió el provincia";
                    }
                    else if(!$hayprovinciaynombre && $hayprovincia && $haynombre){
                        echo "Existen registros con ese provincia y con ese nombre, pero no con los dos al mismo tiempo.";
                    }
                }
                else{
                    echo "No hay registros coincidentes (ni provincia ni nombre).";
                }             
                break;

            /*ConsultarLocal.php: (por POST) Se ingresa localidad, tipo, si coincide con algún registro, 
            retornar el listado de coincidencias de lo contrario informar que no hay, si de ese tipo o de ese turno.*/
            case "ConsultarLocal":
                $tipo = $_POST["tipo"];
                $localidad = $_POST["localidad"];
                $response = Local::Consultar($tipo,$localidad);
                $haytipoylocalidad = false;
                $haytipo = false;
                $haylocalidad = false;

                if(Count($response) > 0){
                    foreach($response as $res){
                        if($res->tipo == $tipo && $res->localidad == $localidad){
                            echo $res->MostrarDatos()."<br/>";
                            $haytipoylocalidad = true;
                        }
                        else if($haytipoylocalidad == false && $res->tipo == $tipo){
                            $haytipo = true;
                        }
                        else if($haytipoylocalidad == false && $res->localidad == $localidad){
                            $haylocalidad = true;
                        }                          
                    }    

                    if($haytipo && !$haylocalidad){
                        echo "No coincidió el localidad";
                    }
                    else if(!$haytipo && $haylocalidad){
                        echo "No coincidió el tipo";
                    }
                    else if(!$haytipoylocalidad && $haytipo && $haylocalidad){
                        echo "Existen registros con ese tipo y con ese localidad, pero no con los dos al mismo tiempo.";
                    }
                }
                else{
                    echo "No hay registros coincidentes (ni tipo ni localidad).";
                }             
                break;

                /*AltaVenta.php: (por POST) Se recibe el id del local, id del cliente, el id del empleado, 
                el id de helado, la fecha, cantidad, si el helado existe y hay stock guardar la venta en la base*/
                case "AltaVenta":
                    $cliente = $_POST["cliente"];
                    $empleado = $_POST["empleado"];
                    $cantidad = $_POST["cantidad"];
                    $local = $_POST["local"];
                    $helado = $_POST["helado"];
                    $fecha = $_POST["fecha"];
                    Venta::Insertar($cliente,$empleado,$cantidad,$local,$helado,$fecha);
                    echo "Venta cargada";
                    break;

                /*AltaVentaConImagen.php: con imagen, guardando la imagen con el id de la venta y 
                la fecha/ImagenesDeLaVenta.*/
                case "AltaVentaConImagen":
                    $cliente = $_POST["cliente"];
                    $empleado = $_POST["empleado"];
                    $cantidad = $_POST["cantidad"];
                    $local = $_POST["local"];
                    $helado = $_POST["helado"];
                    $fecha = $_POST["fecha"];
                    $imagen = $_FILES["imagen"];
                    Venta::InsertarConImagen($cliente,$empleado,$cantidad,$local,$helado,$fecha,$imagen);
                    echo "Venta cargada";
                    break;

            default:
                echo "Debe establecer un caso válido.";
                break;
        }
    }
    else if(isset($_GET["caso"]) && !empty($_GET["caso"])){
        $caso = $_GET["caso"];
        switch($caso)
        {    
            /*Se ingresa nombre, nacionalidad, sexo (“f” o “m”), edad. 
            Se guardan los datos en la base de datos.*/
            case "ClienteCarga":
                $nombre = $_GET["nombre"];
                $nacionalidad = $_GET["nacionalidad"];
                $sexo = $_GET["sexo"];
                $edad = $_GET["edad"];
                Cliente::Insertar($nombre,$sexo,$edad,$nacionalidad);
                echo "Cliente cargado";
                break;

            /*Se ingresa Sabor, precio, Tipo (“crema” o “agua”), cantidad (de kilos). Se
            guardan los datos en la base de datos*/    
            case "HeladoCarga":
                $precio = $_GET["precio"];
                $tipo = $_GET["tipo"];
                $cantidad = $_GET["cantidad"];
                $sabor = $_GET["sabor"];
                Helado::Insertar($precio,$tipo,$cantidad,$sabor);
                echo "Helado cargado";
                break;
            
            /*Se ingresa Sabor, precio, Tipo (“crema” o “agua”), cantidad (de kilos). Se
            guardan los datos en la base de datos*/ 
            case "EmpleadoCarga":
                $nombre = $_GET["nombre"];
                $tipo = $_GET["tipo"];
                $turno = $_GET["turno"];
                Empleado::Insertar($nombre,$tipo,$turno);
                echo "Empleado cargado";
                break;

            /*se ingresa nombre, provincia, estado (“abierto”, “cerrado”), 
            se guardan en la base de datos.*/ 
            case "LocalidadCarga":
                $nombre = $_GET["nombre"];
                $provincia = $_GET["provincia"];
                $estado = $_GET["estado"];
                Localidad::Insertar($nombre,$estado,$provincia);
                echo "Localidad cargada";
                break;

            /*se ingresa dirección, id localidad, estado (“abierto”, “cerrado”), 
            se guardan en la base de datos*/ 
            case "LocalCarga":
                $direccion = $_GET["direccion"];
                $localidad = $_GET["localidad"];
                $estado = $_GET["estado"];
                Local::Insertar($localidad,$estado,$direccion);
                echo "Local cargado";
                break;

            default:
                echo "Debe establecer un caso válido.";
                break;  
        }
    }
    else{
        echo "Debe establecer un caso.";
    }


?>