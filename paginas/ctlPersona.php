<?php

include dirname(__FILE__) . '\..\modelo\Persona.php';
include dirname(__FILE__) . '\..\modelo\Mapeador.php';
include dirname(__FILE__) . '\..\dao\PersonaDAO.php';

$persona = new Persona();

$mensaje = "";

$datos = array(
    'documento' => $_POST['persona']['documento'],
    'nombres' => $_POST['persona']['nombres'],
    'apellidos' => $_POST['persona']['apellidos'],
    'telefono1' => $_POST['persona']['telefono1'],
    'telefono2' => $_POST['persona']['telefono2'],
    'email' => $_POST['persona']['email'],
    'direccion' => $_POST['persona']['direccion']
);

Mapeador::mapearPersona($persona, $datos);

$personaDAO = new PersonaDAO();
try {
    if (array_key_exists("agregar", $_POST)) {
        $retorno = $personaDAO->insertarPersona($persona);
    } elseif (array_key_exists("modificar", $_POST)) {
        $retorno = $personaDAO->actualizarPersona($persona);
    } elseif (array_key_exists("eliminar", $_POST)) {
        $retorno = $personaDAO->eliminarPersona($persona);
    }
} catch (Exception $ex) {
    $mensaje = "HA OCURRIDO UN ERROR!!!: " . $ex->getMessage();
}

echo $mensaje . "<p/><a href='../index.php'>Regresar al inicio</a>";
?>