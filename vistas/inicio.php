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
<body style="margin: 0; padding: 0;">
  <img src="../img/logoCaja.jpg" style="width: 100%; height: 100vh;">
</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}
 ?>