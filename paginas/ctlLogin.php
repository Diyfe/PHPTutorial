<?php
/* He modificado este archivo.
 * Notese que el editor coloca unas marcas, que indican 
 * que se esta realizando un cambio al archivo.
 */
include dirname(__FILE__) . '\..\modelo\Usuario.php';
include dirname(__FILE__) . '\..\modelo\Mapeador.php';
include dirname(__FILE__) . '\..\dao\UsuarioDAO.php';
$mensaje = "  ";
session_start();
if (array_key_exists("usuario", $_POST)) {
    $usuarioP = $_POST['usuario'];
    $usuario = new Usuario();
    $usuario->setUsuario($usuarioP);
    $userDAO = new UsuarioDAO();
    $usuario = $userDAO->leerPorUsuario($usuarioP);
    if($usuario == null){
        $mensaje="Usuario/Clave no encontrados";
    }else{
        header('Location: home.php');
        die();
    }
}
?>
