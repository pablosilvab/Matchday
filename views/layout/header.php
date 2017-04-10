<!DOCTYPE html>
<html lang="es">
<?php
if(!isset($_SESSION)){
  session_start();
  if(isset($_SESSION['login_user_perfil'])){
      if($_SESSION['login_user_perfil'] == 1)
    header('Location:?controlador=Index&accion=indexJugador');
  if($_SESSION['login_user_perfil'] == 2)
    header('Location:?controlador=Index&accion=indexAdmin');
  }
}



?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>MatchDay | A jugar!</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/animate.min.css" rel="stylesheet"> 
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/lightbox.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link id="css-preset" href="assets/css/presets/preset1.css" rel="stylesheet">
  <link href="assets/css/responsive.css" rel="stylesheet">

  <!--link rel="stylesheet" type="text/css" href="css/bootstrap.css" /-->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/pluton.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.cslider.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />


    <!--Para subir la imagen-->
  <link href="assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="assets/images/soccer.ico">




  <script type="text/javascript" src="assets/js/jquery.js"></script>




</head><!--/head-->

    <?php
        $full_name = $_SERVER['PHP_SELF'];
        $name_array = explode('/',$full_name);
        $count = count($name_array);
        $page_name = $name_array[$count-1];
    ?>



<body>

  <!-- Inicio Header -->

  <header id="home">
    <div class="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?controlador=Index&accion=inicio">
            <h1><img class="img-responsive" src="assets/images/logo.png" alt="logo"></h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="<?php echo ($page_name=='inicio.php')?'active':'';?>"><a href="?controlador=Index&accion=inicio">Inicio</a></li>
            <li class="<?php echo ($page_name=='recintos.php')?'active':'';?>"><a href="?controlador=Recinto&accion=busquedaRecintos">Canchas</a></li>
            <ul class="nav pull-left">
              <li class="dropdown" id="menuLogin">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Ingresar</a>
                <div class="dropdown-menu dropdown-menuprincipal" style="padding:2em;">


                  <form class="form" id="formLogin" action="?controlador=Sesion&accion=verificarLogin" method="post">
                    <label class="design-label">¿TIENES CUENTA?</label><br>
                    <div class="form-group">
                    <input class="entrada-login" name="mail" id="mail" type="email" placeholder="Mail" > 
                    <input class="entrada-login" name="password" id="password" type="password" placeholder="Password" >
                    </div>
                    <button class="btn btn-default btn-md col-md-12" type="submit"><strong>Iniciar sesión</strong></button>
                  </form>
                  <br>
                  <br>
                   <form class="form" id="formLogin" action="?controlador=Usuario&accion=formularioRegistro" method="post">
                    <li role="separator" class="divider"></li>
                    <label class="design-label">¿ERES NUEVO EN MATCHDAY?</label><br>
                    <br>
                    <button class="btn btn-default btn-md col-md-12" type="submit" ><strong>Regístrate</strong></button>
                   </form>
                </div>
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->

  </header><!-- /Fin Header -->