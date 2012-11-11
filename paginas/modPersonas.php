<?php
    include dirname(__FILE__). '\..\modelo\Persona.php';
    include dirname(__FILE__). '\..\modelo\Mapeador.php';
    include dirname(__FILE__). '\..\dao\PersonaDAO.php';
    
    $documento = "";
    if(array_key_exists('documento', $_POST)){
        $documento = $_POST['documento'];
    }
    
    $personaDAO = new PersonaDAO();
    $persona = new Persona();
    $persona = $personaDAO->leerPorDocumento($documento);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nueva Persona</title>
</head>
<body>
    <form id="form1" name="form1" method="post" action="ctlPersona.php">
        
        <input name="modificar" type="hidden" value="1"/>
        
  <p>&nbsp;</p>
  <table width="383" border="1" cellspacing="1" cellpadding="1">
	<caption>NUEVA PERSONA</caption>
    <tr>
      <td width="76">Documentos</td>
      <td width="294"><input name="persona[documento]" type="text" readonly="yes" id="documentos" value="<?php echo $persona->getDocumento();?>" /></td>
    </tr>
    <tr>
      <td>Nombres</td>
      <td><input name="persona[nombres]" type="text" id="nombres" size="45" value="<?php echo $persona->getNombre();?>" /></td>
    </tr>
    <tr>
      <td>Apellidos</td>
      <td><input name="persona[apellidos]" type="text" id="apellidos" size="45" value="<?php echo $persona->getApellidos();?>" /></td>
    </tr>
    <tr>
      <td>Telefono 1</td>
      <td><input name="persona[telefono1]" type="text" id="telefono1" value="<?php echo $persona->getTelefono1();?>" /></td>
    </tr>
    <tr>
      <td>Telefono 2</td>
      <td><input name="persona[telefono2]" type="text" id="telefono2" value="<?php echo $persona->getTelefono2();?>" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="persona[email]" type="text" id="email" size="45" value="<?php echo $persona->getEmail();?>" /></td>
    </tr>
    <tr>
      <td>Direccion</td>
      <td><input name="persona[direccion]" type="text" id="direccion" size="45" value="<?php echo $persona->getDireccion();?>" /></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Guardar" /></td>
    </tr>
</table>
</form>
</body>
</html>