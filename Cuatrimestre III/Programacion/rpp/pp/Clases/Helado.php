<?php
    include_once("./Clases/Tools.php");
    class Helado
    {
        static private $archivo = "./Files/Helados.txt";
        private $sabor;
        private $precio;
        private $tipo;
        private $cantidad;

        function __construct($nom, $ape, $tipo, $cant)
        {
            $this->sabor = $nom;
            $this->precio = $ape;
            $this->tipo = $tipo;
            $this->cantidad = $cant;
        }

        function __get($var)
        {
            return $this->$var;
        }
        function __set($var, $val)
        {
            $this->$var = $val;
        }

        function __toString()
        {
            return "$this->sabor-$this->precio-$this->tipo-$this->cantidad".PHP_EOL;
        }

        static function Cargar($h)
        {
            $ret = "";
            $helados = Tools::FileToArray(Self::$archivo, 3, "-");
            if(Tools::Find($helados, 0, $h->sabor." ".$h->tipo) != null)
                $ret = "La helado ya se encuentra en la lista <br/>";
            else
            {
                $helados[] = array($h->sabor." ".$h->tipo, $h->precio, $h->cantidad);
                Tools::ArrayToFile($helados, Self::$archivo);
                $ret = "Cargado con éxito";
            }            
            return $ret;
        }

        static function Consultar($sabor, $tipo)
        {
            $ret = "";
            $helados = Tools::FileToArray(Self::$archivo, 3, "-");
            $heladosDeSaborYTipos = Tools::FindAll($helados, 0, $sabor." ".$tipo);
            if(count($heladosDeSaborYTipos) == 0)
            {
                $ret = "No hay un helado '$sabor $tipo'";
            }
            else {
                $ret = "Si hay";
            }
            return $ret;
        }

        static function AltaVenta($email, $sabor, $tipo, $cant, $foto = "")
        {
            $ret = "";
            $pic;
            $helados = Tools::FileToArray(Self::$archivo, 3, "-");
            $helado = Tools::Find($helados, 0, $sabor." ".$tipo);
            if($helado != null)
            {
                $key = array_search($helado, $helados);
                if((int)$helado[2] > $cant && (int)$helado[2] > 0)
                {
                    $ref = fopen("./Files/Ventas.txt", "a");
                    if($foto != "")
                    {
                        $pic = Tools::LoadPhoto($foto, $sabor."_".date('dmY'), "ImagenesDeLaVenta");
                    }
                    fwrite($ref, "$email-$sabor $tipo-$cant-$pic".PHP_EOL);
                    fclose($ref);
                    $helado[2] = (int)$helado[2] - $cant;
                    $helados[$key] = $helado;
                    Tools::ArrayToFile($helados, Self::$archivo);
                    $ret = "Alta venta exitosa";
                } else {
                    $ret = "No hay suficiente helado para vender";
                }
            }
            else {
                $ret = "No existe el helado que busca";
            }
            return $ret;
        }

        static function Tabla($email = "", $sabor = "")
        {
            $ret;
            if($email == "" && $sabor != "")
            {
                $ret = Self::Filtrar("Sabor", $sabor);
            } else if($email != "" && $sabor == "")
            {
                $ret = Self::Filtrar("Email", $email);
            } else {
                $ret = Self::Filtrar();
            }
            return $ret;
        }
        
        static function Filtrar($filterType = "", $filterValue = "")
        {
            $ref = fopen("./Files/Ventas.txt", "r");
            $venta;
            $table = "<table border='1px'><tr><th>Usuario</th><th>Helado</th><th>Cantidad</th><th>Foto</th></tr>";
            while(!feof($ref))
            {
                $venta = explode("-", fgets($ref));
                if(count($venta) >= 3)
                {
                    if($filterType != "" && $filterValue != "")
                    {
                        if(($filterType == "Email" && $venta[0] == $filterValue) || ($filterType == "Sabor" && $venta[1] == $filterValue))
                        {
                            $table .= "<tr><td>".$venta[0]."</td>
                                        <td>".$venta[1]."</td>
                                        <td>".$venta[2]."</td>";
                                        if(isset($venta[3]))
                                            $table .= "<td><img src='./ImagenesDeLaVenta/".$venta[3]."'/></td></tr>";
                        }
                    } else {
                        $table .= "<tr><td>".$venta[0]."</td>
                                    <td>".$venta[1]."</td>
                                    <td>".$venta[2]."</td>";
                                    if(isset($venta[3]))
                                        $table .= "<td><img src='./ImagenesDeLaVenta/".$venta[3]."'/></td></tr>";
                    }
                }                
            }
            $table .= "</table>";
            return $table;
        }

        static function Modificar($saborYTipoDeBusqueda, $sabor, $tipo, $precio, $cantidad, $foto)
        {
            $ret = "No se pudo modificar a $sabor $tipo";
            $helados = Tools::FileToArray(Self::$archivo, 3, "-");
            $helado = Tools::Find($helados, 0, $saborYTipoDeBusqueda);
            if($helado == null)
                $ret = "No se encuentra el helado que quiere modificar.";
            else
            {
                $i = array_search($helado, $helados);
                $helado[0] = $sabor." ".$tipo;
                $helado[1] = $precio;
                $helado[2] = $cantidad;
                echo "Cargado: ".Tools::LoadPhoto($foto, $sabor."_".date('dmY'), "ImagenesDeLaVenta");
                $helados[$i] = $helado;
                Tools::ArrayToFile($helados, Self::$archivo);
                $ret = "Modificado con éxito";
            }            
            return $ret;
        }

        static function Borrar($sabor, $tipo)
        {
            $ret = "No se pudo borrar a $sabor $tipo";
            $helados = Tools::FileToArray(Self::$archivo, 3, "-");
            $helado = Tools::Find($helados, 0, $sabor." ".$tipo);
            if($helado == null)
                $ret = "No se encuentra el helado que quiere Sborrar.";
            else
            {
                if(Tools::BackUp($sabor."_".date('dmY').".png", "ImagenesDeLaVenta", "backUpFotos"))
                {
                    $i = array_search($helado, $helados);
                    unset($helados[$i]);
                    unlink("./ImagenesDeLaVenta/".$sabor."_".date('dmY').".png");
                    Tools::ArrayToFile($helados, Self::$archivo);
                    $ret = "Borrado con éxito";
                }
            }            
            return $ret;
        }

        static function Listar($cargadas = "", $borradas = "")
        {
            $ret = "";
            return $ret;
        }
    }
?>