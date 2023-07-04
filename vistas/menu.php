
<?php require_once "dependencias.php" ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/menu.css">
<style>
    /* Añade un estilo para la imagen de la marca en el menú */
    .navbar-brand {
      padding: 5px 15px;
    }

    /* Añade un estilo para el logo en la imagen de la marca */
    .navbar-brand .logo {
      max-width: 100%;
      height: auto;
    }

    /* Ajusta el espacio entre la imagen de la marca y los campos del menú en dispositivos móviles */
    @media (max-width: 767px) {
      .navbar-collapse {
        margin-top: 60px;
      }
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
  </style>
  <title></title>
</head>



<body style="margin: 0; padding: 10; background-color: #e0e0e0">

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top navbar-background" data-spy="affix" data-offset-top="100" style="background: #ff9c2d;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/LOGO3.png" alt="" width="120px" height="150px" ></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php" style="background: #ff9c2d;"><span class="glyphicon glyphicon-home"></span> INICIO</a>
            </li>

            
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span><b> ADMINISTRAR ALMUERZOS</b><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="categorias.php"><b>CATEGORIAS</b></a></li>
              <li><a href="articulos.php"><b>PLATOS</b></a></li>
            </ul>
          </li>

        <li><a href="ventas.php"><span class="glyphicon glyphicon-usd"></span><b> VENDER ALMUERZO</b></a>
          </li>
        <?php
        if($_SESSION['usuario']=="admin"):
         ?>
           <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span><b> ADMINISTRAR USUARIOS</b></a>
            </li>
         <?php 
       endif;
          ?>
          
          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" ></span> <b>USUARIO:</b> <?php echo $_SESSION['usuario']; ?>  <span class="caret"></span></a>
            <ul class="dropdown-menu" >
              <li> <a style="color: red" href="../procesos/salir.php"><span class="glyphicon glyphicon-off"></span> <b>SALIR</b></a></li>
              
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.contatiner -->
  </div>
</div>
<!-- Main jumbotron for a primary marketing message or call to action -->





<!-- /container -->        

<footer style="position: fixed; bottom: 0; left: 0; width: 100%; margin: 0; padding: 10px; background-color: #ffbf77; text-align: center;">
    <div style="background-color: #ffbf77; padding: 0px;">
        <p><b>Desarrollado por Miguel Espinoza Mollinedo</b> | <b>Email: miguelespmol@gmail.com</b></p>
    </div>
</footer>
</body>
</html>

<script type="text/javascript">
  $(window).scroll(function() {
    if ($(document).scrollTop() > 150) {
      $('.logo').height(200);

    }
    else {
      $('.logo').height(100);
    }
  }
  );
</script>