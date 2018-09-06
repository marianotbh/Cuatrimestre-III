<?php
    class Usuario{
        private $user;
        private $password;

        public static function Login($user,$password){
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT COUNT(*)
                                                            FROM BaseDeClaves WHERE user = :user
                                                            AND password = :password");
            
            $consulta->execute(array(":user" => $user, ":password" => $password));
            
            $resultado = $consulta->fetch();
            return $resultado; 
        }

    }
?>