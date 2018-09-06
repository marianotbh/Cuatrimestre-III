<?php
require './vendor/autoload.php';
use \Firebase\JWT\JWT;


class Token{

    private static $key = "example_key";

    private static $token = array(
        "iat" => "", //Cuando fue metido
        "nbf" => "", //Antes de esto no va a funcionar (Desde)
        "exp" => "", //Hasta cuando va a funcionar
        "user" => ""
    );

    public static function CodificarToken($user){        
        $fecha = new Datetime("now", new DateTimeZone('America/Buenos_Aires'));
        Token::$token["iat"] = $fecha->getTimestamp();                
        Token::$token["nbf"] = $fecha->getTimestamp();
        $fecha->add(new DateInterval('P30D'));
        Token::$token["exp"] = $fecha->getTimestamp();
        Token::$token["usuario"] = $user; 
        $jwt = JWT::encode(Token::$token, Token::$key);
        return $jwt;
    }    

    public static function DecodificarToken($token){
        try
        {            
            $payload = JWT::decode($token, Token::$key, array('HS256'));
            $decoded = array("Estado" => "OK", "Payload" => $payload);
        }
        catch(\Firebase\JWT\BeforeValidException $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje.");
        }
        catch(\Firebase\JWT\ExpiredException $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje.");
        }
        catch(\Firebase\JWT\SignatureInvalidException $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje.");
        }
        catch(Exception $e){
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje.");
        }        
        return $decoded;
    }
}
?>