<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "menu.php"; ?>
</head>
<body style="margin: 0; padding: 0; background-color: #e0e0e0">
  <img src="../img/Fondo.png" style="width: 100%; height: 100%; background-color: #e0e0e0;">
</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}
 ?>