
<?php require_once "dependencias.php" ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/menu.css">
  <title></title>
</head>



<body style="background-color: orange">

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top navbar-background" data-spy="affix" data-offset-top="100" style="background: linear-gradient(to bottom, maroon 50%, darkorange 50%);">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/LOGO2.png" alt="" width="120px" height="150px"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php" style="background: linear-gradient(to bottom, maroon 50%, darkorange 50%);"><span class="glyphicon glyphicon-home"></span> INICIO</a>
            </li>

            
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> ADMINISTRAR ALMUERZOS <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="categorias.php">CATEGORIAS</a></li>
              <li><a href="articulos.php">PLATOS</a></li>
            </ul>
          </li>

        <li><a href="ventas.php"><span class="glyphicon glyphicon-usd"></span> VENDER ALMUERZO</a>
          </li>
        <?php
        if($_SESSION['usuario']=="admin"):
         ?>
           <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> ADMINISTRAR USUARIOS</a>
            </li>
         <?php 
       endif;
          ?>
          
          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> USUARIO: <?php echo $_SESSION['usuario']; ?>  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a style="color: red" href="../procesos/salir.php"><span class="glyphicon glyphicon-off"></span> SALIR</a></li>
              
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