<?php
class AccesoDatos {
    private static $_objetoAccesoDatos;
    private $_objetoPDO;
 
    private function __construct() {
        try {
            $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=ventasdb;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->_objetoPDO->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            print "Error.<br>" . $e->getMessage();
            die();
        }
    }
 
    public function RetornarConsulta($sql) { return $this->_objetoPDO->prepare($sql); }
 
    public static function DameUnObjetoAcceso()//singleton
    {
        if (!isset(self::$_objetoAccesoDatos)) {       
            self::$_objetoAccesoDatos = new AccesoDatos(); 
        }
        return self::$_objetoAccesoDatos;        
    }
    
    public function __clone() { trigger_error('No se puede clonar este objeto', E_USER_ERROR); }
}
?>