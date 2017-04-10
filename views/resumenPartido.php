<!DOCTYPE html>
<html lang="en">
<?php
 
    




// Obtener datos del usuario de la sesión.
if (!isset($_SESSION['login_user_name'])){
  session_start();
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

/*
if(isset($_GET["tercertiempo"]) ){
  $tercertiempo=$_GET["tercertiempo"];
}else{
  $tercertiempo=0;
}*/
/////Usuario de prueba//////

    $user= $_SESSION['login_user_name'];
    $idUsuario= $_SESSION['login_user_id'];
///////////////////////////////



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


  <link rel="stylesheet" type="text/css" href="assets/css/demo.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/elastislide.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/custom.css" />




    <!--Para subir la imagen-->

  <link href="assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="assets/images/soccer.ico">


  <script src="assets/js/modernizr.custom.17475.js"></script>
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
          <a class="navbar-brand" href="index.html">
            <h1><img class="img-responsive" src="assets/images/logo.png" alt="logo"></h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="<?php echo ($page_name=='inicioJugador')?'active':'';?>"><a href="?controlador=Index&accion=indexJugador">Inicio</a></li>
            <li class="<?php echo ($page_name=='recintos')?'active':'';?>"><a id="myLink" href="#" onclick="partido();return false;">Jugar</a></li> <!--Jugar = 1 para entrar a buscar recintos en el mismo reutilizando-->
            <li class="<?php echo ($page_name=='desafios')?'active':'';?>"><a href="?controlador=Desafio&accion=listaDesafios">Desafios</a></li>
            <ul class="nav pull-left">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $nombre?> <i class="fa fa-user"></i>
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="?controlador=Usuario&accion=perfilUsuario">Perfil   </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Contacto&accion=listaContactos">Contactos </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Equipo&accion=listaEquipos">Equipos </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Recinto&accion=notificarRecinto">Notificar recinto </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Sesion&accion=logout">Cerrar Sesion <i class="fa fa-sign-out"></i></a></li>
                   
                </ul>
              </li>
            </ul>
            <ul class="nav pull-left">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Partidos <i class="fa fa-flag" aria-hidden="true"></i>
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php


                  ?>
                  <li><a href="partidosPendientes.php">Partidos pendientes: </a></li>
                  <div class="drop-divider"></div>
                  
                  
                  <?php

                  ?>
                  <li><a href="partidosDisponibles.php">Partidos MatchDay:</a></li>
                  
                  <li><a href="partidosGestionados.php">Partidos Agendados</a></li>

                  
                </ul>
              </li>
            </ul>

          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->


  </div>
  <form action="?controlador=Recinto&accion=busquedaRecintos" method=post name="formulario1"> 
    <input type="hidden" name="jugar" value="1"> 
    <input type="hidden" name="tipo" value="1"> 
</form>
  <form action="?controlador=Recinto&accion=busquedaRecintos" method=post name="formulario2"> 
    <input type="hidden" name="jugar" value="0"> 
    <input type="hidden" name="tipo" value="1"> 
</form>

  <script>
  
   
      function partido(){
          document.formulario1.submit()
      }
      function cancha(){
        document.formulario2.submit()
      }
    
    

  </script>
  </header><!-- /Fin Header -->

<!--Variables -->
<?php

//$idPartido= $_SESSION["idPartido"];
$idUsuario= $_SESSION['login_user_id'];
$idRecinto= $_SESSION['idRecinto']; //Recinto seleccionado
$cantidad = $_SESSION['cantidad']; //Cantidad de jugadores seleccionados
$fecha =    $_SESSION['fecha'];
$hora =     $_SESSION['hora'];






if (isset($vars['tercerTiempo'])){
  // Variable local
  $tercerTiempo= end($vars['tercerTiempo']);
  $local = $tercerTiempo['idLocal'];
  $vectorLocales = $vars['local'];
  $vectorTercerTiempo = $vars['tercerTiempo'];

foreach ($vectorTercerTiempo as $key ) {
  $horaTercer = $key['hora'];
  $descripcion = $key['comentario'];
}
} 

?>



<!---->



<!-- Aqui empieza la pagina -->
<div id="contact-nosotros" class="parallax">
  <div class="container">
     <?php
      if (!(isset($vars['tercerTiempo']))){ // SI NO HAY TERCER TIEMPO 
        ?>
    <div class="row">
      <h2>Resumen del partido</h2>
      <div class="col-md-4">
          <h4>Información del partido</h4>
          <table class="table table-bordered center">
            <tr>
              <th>Organizador:&nbsp;</th>
              <td><?php echo $_SESSION['login_user_name']?></td>
            </tr>
            <tr>
              <th>Jugadores:&nbsp;</th>
              <td><?php echo $cantidad;?></td>
            </tr>
            <tr>
              <th>Fecha:&nbsp;</th>
              <td><?php echo $fecha;?></td>
            </tr>
            <tr>
              <th>Hora:&nbsp;</h>
              <td><?php echo $hora;?></td>
            </tr>

          </table>
          <div class="row">


            <div class="container-mini demo-1-mini">
              <h4>Jugadores</h4>
              <div class="main-mini">
                <ul id="carousel" class="elastislide-list-mini">
                  <?php
                  foreach ($vars['jugadores'] as $key) {
                    ?>
                    <!-- Deben ser imagenes chicas .. al subirlas se podrian redimensionar. -->
                    <li>
                      <table>
                        <tr>
                          <td><img class="resize-resumen" src="assets/images/usuarios/<?php echo $key['fotografia']; ?>" alt="image01" /></td>
                        </tr>
                        <tr>
                          <td><h6><?php echo $key['nickname'];?></h6></td>
                        </tr>
                      </table>
                     </li>
                      <?php
                    }
                    ?>
                  </ul> <!-- End Elastislide Carousel -->
                </div>
              </div>



            </div>
      </div>
      <div class="col-md-4">
        <?php
            foreach ($vars['recinto'] as $key ) {
            ?>
            <h4>Cancha: <?php echo $key['nombre'];?></h4>
            <div class="folio-image">
                  <img class="img-responsive" src="assets/images/recintos/<?php echo  $key['fotografia']; ?>" alt="">
                </div>
           
      </div>
      <div class="col-md-4">
        <h4>¿Cómo llegar?</h4>
        <iframe
          width="100%" height="336px" frameborder="5" style="border:0"  maptype="satellite"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDR2WyVnnd9GsSTKys5OEkowPu41kMpEUs
          &q=Chile  + Chillan + <?php echo $key['direccion']?>" allowfullscreen>
  </iframe>
   <?php
            }
            ?>
      </div>
     

    </div><!-- /row -->

<a href="enviarInvitaciones.php">
<center><button class="btn btn-invitar">Enviar invitaciones</button></center></a>


    <?php
      } else {       // SI HAY TERCER TIEMPO
        ?>
        <div class="row">
      <h2>Resumen del partido</h2>
      <div class="col-md-4">
          <h4>Información del partido</h4>
          <table class="table table-bordered center">
            <tr>
              <th>Organizador:&nbsp;</th>
              <?php
              ?>
              <td><?php echo $_SESSION['login_user_id'];?></td>
              <?php
              ?>
            </tr>
            <tr>
              <th>Jugadores:&nbsp;</th>
              <td><?php echo $cantidad;?></td>
            </tr>
            <tr>
              <th>Fecha:&nbsp;</th>
              <td><?php echo $fecha;?></td>
            </tr>
            <tr>
              <th>Hora:&nbsp;</h>
              <td><?php echo $hora;?></td>
            </tr>
            <tr>
              <th>Hora Tercer Tiempo:&nbsp;</h>
              <td><?php echo $horaTercer;?></td>
            </tr>
            <tr>
              <th>Descripción:&nbsp;</h>
              <td><?php echo $descripcion;?></td>
            </tr>
            
          </table>
          
      </div>



      <div class="col-md-4">
        <?php
            foreach ($vars['recinto'] as $key ) {
            ?>
            <h4>Cancha: <?php echo $key['nombre'];?></h4>
            <div class="folio-image">
                  <img class="img-responsive" src="assets/images/recintos/<?php echo  $key['fotografia']; ?>" alt="">
                </div>
           
      </div>


      <div class="col-md-4">
        <h4>¿Cómo llegar?</h4>
        <iframe
          width="100%" height="336px" frameborder="5" style="border:0"  maptype="satellite"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDR2WyVnnd9GsSTKys5OEkowPu41kMpEUs
          &q=Chile  + Chillan + <?php echo $key['direccion'];?>" allowfullscreen>
          </iframe>
           <?php
                    }
                    ?>
      </div>
     

    </div><!-- /row -->

    <div class="row">

            <div class="col-md-4">
        <div class="row">


            <div class="container-mini demo-1-mini">
              <h4>Jugadores</h4>
              <div class="main-mini">
                <ul id="carousel" class="elastislide-list-mini">
                  <?php
                  foreach ($vars['jugadores'] as $key) {
                    ?>
                    <!-- Deben ser imagenes chicas .. al subirlas se podrian redimensionar. -->
                    <li>
                      <table>
                        <tr>
                          <td><img class="resize-resumen" src="assets/images/usuarios/<?php echo $key['fotografia']; ?>" alt="image01" /></td>
                        </tr>
                        <tr>
                          <td><h6><?php echo $key['nickname'];?></h6></td>
                        </tr>
                      </table>
                      </li>
                      <?php
                    }
                    ?>
                  </ul> <!-- End Elastislide Carousel -->
                </div>
              </div>



            </div>
           
      </div>


      <div class="col-md-4">
        <?php
            foreach ($vectorLocales as $key ) {
            ?>
            <h4>Local: <?php echo $key['nombre'];?></h4>
            <div class="folio-image">
                  <img class="img-responsive" src="assets/images/locales/<?php echo  $key['fotografia']; ?>" alt="">
                </div>
           
      </div>

      
      <div class="col-md-4">
        <h4>¿Cómo llegar al tercer tiempo?</h4>
        <iframe
          width="100%" height="336px" frameborder="5" style="border:0"  maptype="satellite"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDR2WyVnnd9GsSTKys5OEkowPu41kMpEUs
          &q=Chile  + Chillan + <?php echo $key['direccion'];?>" allowfullscreen>
          </iframe>
           <?php
            }
        ?>
      </div>
    </div>
<a href="enviarInvitaciones.php">
<center><button class="btn btn-invitar" >Enviar invitaciones</button></center></a>





        <?php
      }
      ?>
  </div> 
</div> 

  



 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquerypp.custom.js"></script>
    <script type="text/javascript" src="assets/js/jquery.elastislide.js"></script>
    <script type="text/javascript">
      
      $( '#carousel' ).elastislide();
      
    </script>


  
<!-- /Aqui termina la pagina -->



  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li> 
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; 2016 Oxygen Theme.</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="assets/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="assets/js/wow.min.js"></script>
  <script type="text/javascript" src="assets/js/mousescroll.js"></script>
  <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
  <script type="text/javascript" src="assets/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
  <script type="text/javascript" src="assets/js/main.js"></script>

  <script type="text/javascript" src="assets/js/fileinput.min.js"></script>
  <script type="text/javascript" src="assets/js/jquerypp.custom.js"></script>
  <script type="text/javascript" src="assets/js/jquery.elastislide.js"></script>
    <script>     

    //Creo que hay un error en este script.

       $(document).ready(function() {     
        $.ajax({
          type:'post',
          cache:false,
          url:"?controlador=Partido&accion=enviarInvitaciones"
         });
        });


  </script>
</body>
</html>
