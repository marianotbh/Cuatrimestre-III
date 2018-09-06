<?php 
    class Cliente 
    {
        private $nombre;
        private $correo;
        private $clave;

        function __construct($n, $c, $pw)
        {
            $this->nombre = $n;
            $this->correo = $c;
            $this->clave = $pw;
        }

        function ToString()
        {
            return "$this->nombre-$this->correo-$this->clave".PHP_EOL;
        }

        static function cargarCliente($nombre, $correo, $clave)
        {
            if(self::validar($correo, $clave) == "Cliente inexistente")
            {
                $c = new Cliente($nombre, $correo, $clave);
                $ref = fopen("./clientes/clientesActuales.txt", "a");
                fwrite($ref, $c->ToString());
                fclose($ref);
                return "Cliente cargado,";
            } else if(self::validar($correo, $clave) == "Cliente logueado")
            {
                return "El cliente ya se encuentra cargado en la base de datos.";
            } else {
                return "Error al validar";
            }
        }

        static function validar($correo, $clave)
        {
            $ref = fopen("./clientes/clientesActuales.txt", "r");
            $p;
            while(!feof($ref))
            {
                $p = explode("-", fgets($ref));
                if(count($p) == 3)
                {
                    if((trim($p[1]) == trim($correo) && trim($p[2]) == trim($clave)))
                    {
                        return "Cliente logueado";
                    }
                }
            }
            fclose($ref);
            return "Cliente inexistente";
        }        
    }