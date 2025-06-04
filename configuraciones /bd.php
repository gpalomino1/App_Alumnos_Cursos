<?php 
class BD {
    public static $crearInstancia=null;
    public static function getInstancia() {

        if( !isset (self::$intancia )){
            $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$crearInstancia = new PDO('mysql:host=localhost:82;dbname=aplicacion','gpalomino','161718', $opciones);
            echo "Conexión exitosa a la base de datos";
        }
        return self::$crearInstancia;
    }
}
?>