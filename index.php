<?php
include 'paginas/ctlLogin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOGIN SISTEMA</title>
<script type="text/javascript">
function acceder(){
	var formulario = document.forms['form1'];
	var puedeAcceder = true;
	var msg = '';
	if(formulario.usuario.value.length < 2){
		msg+='Debe escribir un nombre de usuario\n';
		puedeAcceder = false;
	}
	if(formulario.clave.value.length < 2){
		msg+='Debe escribir una clave\n';
		puedeAcceder = false;
	}
        
	if(puedeAcceder){
		formulario.submit();
	}else{
		alert(msg);
	}
}

<?php
if($mensaje !=''){
?>
 window.onload=function(){
     alert('<?php echo $mensaje; ?>');
 }
 
<?php } ?>
</script>
</head>
<body>
<form id="form1" name="form1" method="post" action="index.php">
  
  Usuario: 
  <input type="text" name="usuario" id="usuario" />
  <br />
  <br />
  Clave: &nbsp;&nbsp;
<input type="password" name="clave" id="clave" />
<br />
<br />
<input type="button" name="button" id="button" value="Acceder" onclick="acceder()" />
</form>
</body>
</html>