<?php

include_once dirname(__FILE__) . '\..\configuracion\Configuracion.php';
include_once dirname(__FILE__) . '\..\modelo\Persona.php';

class PersonaDAO {

    private $db;

    const SQL_INSERTAR = 1;

    private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        try {
            $cfg = Configuracion::obtConfig("basedatos");
            $this->db = new PDO($cfg['dsn'], $cfg['user'], $cfg['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            throw new Exception("La base de datos no pudo ser creada.".$exc->getMessage());
        }
        return $this->db;
    }

    public function leerTodos() {
        $sql = "SELECT * FROM personas";
        $sentencia = $this->getDb()->prepare($sql);
        $cursor = $sentencia->execute();
        if(!$cursor){
            self::lanzarErrorBD($this->getDb()->errorInfo());
        }
        $filas = $sentencia->fetchAll();
        if(!$filas){
            self::lanzarErrorBD($this->getDb()->errorInfo());
        }
        return $filas;
    }

    public function leerPorDocumento($documento = '') {
        $sql = "SELECT * FROM personas WHERE documento = $documento";
        $sentencia = $this->getDb()->prepare($sql);
        $sentencia->execute();
        $filas = $sentencia->fetch();
        $persona = new Persona();
        Mapeador::mapearPersona($persona, $filas);
        return $persona;
    }

    public function insertarPersona(Persona $persona) {
        $sql = "INSERT INTO `personas` (`documento`, `nombres`, `apellidos`, `telefono1`, `telefono2`, `email`, `direccion`,`fechaRegistro`) VALUES ";
        $sql.=" (:documento, :nombres, :apellidos, :telefono1, :telefono2, :email, :direccion, :fechaRegistro) ";
        $resul = false;
        try {
            $resul = $this->ejecutarInserUpdate($sql, $persona);
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
        return $resul;
    }

    public function actualizarPersona(Persona $persona) {
        $sql = "UPDATE `personas` SET `nombres`=:nombres,`apellidos`=:apellidos,`telefono1`=:telefono1, ";
        $sql.=" `telefono2`=:telefono2,`email`=:email,`direccion`=:direccion,`fechaRegistro`=:fechaRegistro ";
        $sql.=" WHERE documento = :documento ";
        return $this->ejecutarInserUpdate($sql, $persona);
    }
    
    public function eliminarPersona(Persona $persona) {
        $sql = "DELETE FROM personas WHERE documento = :documento";
        return $this->ejecutarDelete($sql, $persona);
    }
    

    private function ejecutarInserUpdate($sql, Persona $persona) {
        $sentencia = $this->getDb()->prepare($sql);
        $parametros = $this->getParametros($persona);
        //return $sentencia->execute($parametros);
        $retorno = $sentencia->execute($parametros);
        if ($retorno == false) {
            self::lanzarErrorBD($this->getDb()->errorInfo());
        }
        return $retorno;
    }
    
    private function ejecutarDelete($sql, Persona $persona){
        $sentencia = $this->getDb()->prepare($sql);
        $parametros = array(':documento' => $persona->getDocumento());
        $retorno = $sentencia->execute($parametros);
        if ($retorno == false) {
            self::lanzarErrorBD($this->getDb()->errorInfo());
        }
        return $retorno;
        
    }

    private function getParametros(Persona $persona) {
        $parametros = array(
            ':documento' => $persona->getDocumento(),
            ':nombres' => $persona->getNombre(),
            ':apellidos' => $persona->getApellidos(),
            ':telefono1' => $persona->getTelefono1(),
            ':telefono2' => $persona->getTelefono2(),
            ':email' => $persona->getEmail(),
            ':direccion' => $persona->getDireccion(),
            ':fechaRegistro' => date('Y-m-d G:i:s')
        );
        return $parametros;
    }


    public static function lanzarErrorBD($arrayError){
        throw new Exception("Error de operacion en BD: ".$arrayError[1]);
    }
}

?>
