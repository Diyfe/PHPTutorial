<?php
session_start();
$uNombre = "";
$uUsuario = "";
if(isset($_SESSION['usuario'])){
    $uUsuario = $_SESSION['nombre'];
    $uNombre  = $_SESSION['usuario'];
}else{
    header("Location: fuera.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::INICIO:::</title>
</head>
<body>
<p>Bienvenido <?php echo $uNombre; ?></p>
<p>&nbsp;</p>
<h2>MENU</h2>
<p><a href="paginas/lstPersonas.php">PERSONAS</a></p>
</body>
</html>