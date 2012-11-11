<?php

include_once dirname(__FILE__) . '\..\configuracion\Configuracion.php';
include_once dirname(__FILE__) . '\..\modelo\Persona.php';

class UsuarioDAO {

    private $db;

    private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        try {
            $cfg = Configuracion::obtConfig("basedatos");
            $this->db = new PDO($cfg['dsn'], $cfg['user'], $cfg['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            throw new Exception("La base de datos no pudo ser creada." . $exc->getMessage());
        }
        return $this->db;
    }

    public function leerPorUsuario($usuario) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $sentencia = $this->getDb()->prepare($sql);
        $sentencia->execute();
        $filas = $sentencia->fetch();
        $usuario = new Usuario();
        if ($filas) {
            Mapeador::mapearUsuario($usuario, $filas);
            return $usuario;
        }else{
            return null;
        }
        
    }

}

?>
