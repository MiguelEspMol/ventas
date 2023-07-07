<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "menu.php"; ?>
	<style>
    body {
      margin: 0;
      padding: 0;
      background-color: #e0e0e0;
      background-image: url("../img/Fondo.png");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
    }

	footer {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			margin-top: 30px; /* Ajusta la distancia entre el contenido y el footer */
			padding: 5px; /* Ajusta el espacio interno del footer */
			background-color: #ffbf77;
			text-align: center;
			font-size: 12px; /* Ajusta el tamaño de fuente del texto del footer */
	}

	@media (max-width: 768px) {
      body {
        background-size: 150%;
      }
    }

	@media (min-width: 769px) {
      body {
        background-position-y: 1px; /* Ajusta el valor de píxel según las necesidades */
      }
    }
  </style>
</head>
<body style="margin: 0; padding: 0; background-color: #e0e0e0">
<footer style="position: fixed; bottom: 0; left: 0; width: 100%; height: 5%; margin: 0; padding: 10px; background-color: #ffbf77; text-align: center;">
    <div style="background-color: #ffbf77; padding: 0px;">
        <p><b><small>Desarrollado por Miguel Espinoza Mollinedo</small></b> | <b><small>Email: miguelespmol@gmail.com</small></b></p>
    </div>
</footer>
</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}
 ?>