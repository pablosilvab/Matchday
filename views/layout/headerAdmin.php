<!DOCTYPE html>
<html lang="es">
<?php


// Obtener datos del usuario de la sesión.
if (!isset($_SESSION)){
  session_start();
  if(!isset($_SESSION['login_user_perfil']))
    header('Location: ?controlador=Index&accion=inicio');
}
if($_SESSION['login_user_perfil'] == 1 ){
        header('Location: ?controlador=Index&accion=indexJugador');
    }

if (isset($_SESSION['login_user_id'])){
  $idUsuario= $_SESSION['login_user_id'];
}

if (isset($_SESSION['login_user_name'])){
  $nombre= $_SESSION['login_user_name'];
}

if (isset($_SESSION['login_user_email'])){
  $mail= $_SESSION['login_user_email'];
}

if (isset($_SESSION['notificaciones'])){
    $notificaciones = $_SESSION['notificaciones'];
}
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administración - MatchDay</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/assetsAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets/assetsAdmin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/assetsAdmin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/assetsAdmin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/assetsAdmin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="assets/images/soccer.ico">

        <!-- Centrado de tablas -->
    <style type="text/css">
    .centrado{
        text-align: center;
    }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?controlador=Index&accion=indexAdmin">Administración - MatchDay</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> Notificaciones <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <?php
                            if ($notificaciones > 0 ){
                                ?>
                                <a href="?controlador=Recinto&accion=recintosNotificados">
                                <div>
                                    Recintos <span class="badge"><?php echo $notificaciones?></span>
                                </div>
                                 </a>
                                <?php
                            } else {
                                ?>
                                <div>
                                    No hay nuevos recintos
                                </div>
                                <?php
                            }
                            ?>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $nombre?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?controlador=Sesion&accion=logout"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="?controlador=Index&accion=indexAdmin"><i class="fa fa-home fa-fw"></i> Inicio</a>
                        </li>
                        <li>
                            <a href="?controlador=Recinto&accion=adminRecintos"><i class="fa fa-map-marker fa-fw"></i> Recintos</a>
                        </li>
                        <li>
                            <a href="?controlador=Usuario&accion=adminJugadores"><i class="fa fa-user fa-fw"></i> Jugadores</a>
                        </li>
                        <li>
                            <a href="?controlador=Comentario&accion=adminComentarios"><i class="fa fa-comments fa-fw"></i> Comentarios</a>
                        </li>
                        <li>
                            <a href="?controlador=Equipo&accion=adminEquipos"><i class="fa fa-users fa-fw"></i> Equipos</a>
                        </li>
                        <li>
                            <a href="?controlador=Desafio&accion=adminDesafios"><i class="fa fa-futbol-o fa-fw"></i> Desafíos</a>
                        </li>
                        <li>
                            <a href="?controlador=Local&accion=adminLocales"><i class="fa fa-map-marker fa-fw"></i> Locales</a>
                        </li>
                         <li>
                            <a href="?controlador=Partido&accion=calendarioAdmin"><i class="fa fa-calendar fa-fw"></i> Calendario</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>