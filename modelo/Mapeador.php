<?php

final class Mapeador {
    public static function mapearPersona(Persona $persona, array $datos){
        
        if(array_key_exists('documento', $datos)){
            $persona->setDocumento($datos['documento']);
        }
        if(array_key_exists('nombres', $datos)){
            $persona->setNombre($datos['nombres']);
        }
        if(array_key_exists('apellidos', $datos)){
            $persona->setApellidos($datos['apellidos']);
        }
        if(array_key_exists('telefono1', $datos)){
            $persona->setTelefono1($datos['telefono1']);
        }
        if(array_key_exists('telefono2', $datos)){
            $persona->setTelefono2($datos['telefono2']);
        }
        if(array_key_exists('email', $datos)){
            $persona->setEmail($datos['email']);
        }
        if(array_key_exists('direccion', $datos)){
            $persona->setDireccion($datos['direccion']);
        }
    }
    
    public static function mapearUsuario(Usuario $usuario, array $datos){
        
        if(array_key_exists('usuario', $datos)){
            $usuario->setUsuario($datos['usuario']);
        }
        if(array_key_exists('nombre', $datos)){
            $usuario->setNombre($datos['nombre']);
        }
        if(array_key_exists('clave', $datos)){
            $usuario->setClave($datos['clave']);
        }
    }
}
?>
