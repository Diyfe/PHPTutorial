<?php

final class Configuracion {

    private static $datos = null;
    
    

    public static function obtConfig($seccion = null) {
        if ($seccion == null) {
            return self::obtDatos();
        }
        $datos = self::obtDatos();
        if (!array_key_exists($seccion, $datos)) {
            throw new Exception("No se encontro la seccion " . $seccion . " en la configuracion");
        }
        return $datos[$seccion];
    }

    private static function obtDatos() {
        $archivo = dirname(__FILE__).'\principal.ini';
        if (self::$datos !== null) {
            return self::$datos;
        }
        self::$datos = parse_ini_file($archivo, true);
        return self::$datos;
    }

}

?>
