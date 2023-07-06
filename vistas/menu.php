
<?php require_once "dependencias.php" ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="../css/menu.css">
<style>

    .navbar .glyphicon-home {
      margin-right: 3px;
    }
 
    .navbar .glyphicon-list-alt {
      margin-right: 3px;
    }

    .navbar .glyphicon-usd {
      margin-right: 3px;
    }

    .navbar .glyphicon-user {
      margin-right: 3px;
    }

    .navbar .glyphicon-off {
      margin-right: 3px;
    }

    /* Añade un estilo para la imagen de la marca en el menú */
    .navbar-brand {
      background-color: #ff9c2d;
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

    /* Estilos para el botón de navegación en dispositivos móviles */
.navbar-toggle {
  background: none;
  border: none;
  padding: 10px;
  margin-right: 15px;
  transition: all 0.3s ease-in-out;
}

.navbar-toggle .icon-bar {
  display: block;
  width: 22px;
  height: 2px;
  background-color: #fff;
  margin: 4px 0;
  transition: background-color 0.3s ease-in-out;
}

/* Estilos para el estado desplegado del botón de navegación */
.navbar-toggle.collapsed .icon-bar {
  background-color: #fff;
}

/* Estilos para la animación de apertura del menú */
.navbar-toggle .top-bar {
  transform: translateY(5px) rotate(45deg);
}

.navbar-toggle .middle-bar {
  opacity: 0;
}

.navbar-toggle .bottom-bar {
  transform: translateY(-5px) rotate(-45deg);
}

/* Estilos para el estado desplegado de la animación */
.navbar-toggle.collapsed .top-bar {
  transform: none;
}

.navbar-toggle.collapsed .middle-bar {
  opacity: 1;
}

.navbar-toggle.collapsed .bottom-bar {
  transform: none;
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
          <span class="icon-bar top-bar"></span>
          <span class="icon-bar middle-bar"></span>
          <span class="icon-bar bottom-bar"></span>
        </button>
          <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/LOGO3.png" alt="" width="120px" height="150px" ></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

          <li class="nav-item active">
            <a class="nav-link" href="inicio.php" style="background: #ff9c2d;">
              <i class="fas fa-house-user fa-lg"></i>
                <span class="nav-text"><b>INICIO</b></span>
            </a>
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

<footer style="position: fixed; bottom: 0; left: 0; width: 100%; height: 5%; margin: 0; padding: 10px; background-color: #ffbf77; text-align: center;">
    <div style="background-color: #ffbf77; padding: 0px;">
        <p><b><small>Desarrollado por Miguel Espinoza Mollinedo</small></b> | <b><small>Email: miguelespmol@gmail.com</small></b></p>
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