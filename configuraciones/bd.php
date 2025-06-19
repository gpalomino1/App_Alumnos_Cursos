<?php
class BD {
    private static $instancia = null;

    public static function crearInstancia() {
        if (self::$instancia === null) {
            $host = '127.0.0.1';
            $db = 'aplicacion';
            $user = 'gpalomino';
            $pass = '161718';
            $charset = 'utf8mb4';
            $port = 3306;

            $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_TIMEOUT => 5,
            ];

            try {
                self::$instancia = new PDO($dsn, $user, $pass, $opciones);
            } catch (PDOException $e) {
                die("❌ Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
