<!DOCTYPE html>
<html lang="en">
<?php

include('layout/headerJugador.php'); 

   /*
    if($_SESSION["sesion"]!="jugador") {
      header("Location:../Vista/inicio.php?inicio=falloJugador"); 
    }
    */

/////Usuario de prueba//////
    //$user= $_SESSION['user'];
    $idUsuario= $_SESSION['login_user_id'];
////////////////////////////

    ?>

    <!--Variables -->
    <?php


// Información que viene del partido.;
    $idUsuario= $_SESSION['login_user_id'];
$idRecinto= $_SESSION['idRecinto']; //Recinto seleccionado
$cantidad = $_SESSION['cantidad']; //Cantidad de jugadores seleccionados
$fecha =    $_SESSION['fecha'];
$hora =     $_SESSION['hora'];





//$vectorUsuarios = $jefeUsuarios->leerUsuario($idUsuario);
//$vectorRecintos = $jefeRecintos->leerRecinto($idRecinto);

$vectorLocales = $vars['locales'];
$idPartido = $_SESSION['idPartido'];


?>



<!---->



<!-- Aqui empieza la pagina -->


<style>
  #redimensionar {
    width: 370px;
    height: 277.5px;
  }
</style>




<!-- Portfolio section start -->
<!--link rel="stylesheet" type="text/css" href="css/bootstrap.css" /-->
<div id="contact-us" class="parallax">
  <div class="container">


    <div class="page-header">
      <h2> Busca el lugar ideal para tu tercer tiempo <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
    </div>





   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form action="?controlador=Local&accion=busquedaLocales" method="POST">
        <input type="text" class="form-control" placeholder="Busca tu lugar ideal, por nombre o tipo de local (ej: pub)" name="search" id="texto-input-white"/>


        <div class="col-md-12">
          <br/>
          <button class="btn btn-primary btn-lg col-md-12 center-block" type="submit">
            Buscar
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </div>  

      </form>
    </div><!-- /.col-lg-6 -->
  </div>


  <?php
  $search = '';
  $cont = 0;
  if (isset($vars['search'])) {
    $search = $vars['search'];
  }
                    if ($search!=''){  // if search

                        // AHORA VIENEN LOS RESULTADOS
                      ?>
                      <h3>Resultados</h3>

                      <ul class="nav nav-pills">
                        <li class="filter" data-filter="photo"></li>
                        <li class="filter" data-filter="identity"></li>
                      </ul>
                      <div id="single-project">
                        <?php
                    } // fin if search
                    foreach ($vectorLocales as $key) {   // foreach recintos
                      $nombre = $key['nombre'];
                      $pos = strripos($nombre, $search);
                      $descripcion = $key['descripcion'];
                      $pos2 = strripos($descripcion, $search);
                      $idLocal = $key['idLocal'];
                        if ($pos !== false  ||   $pos2!==false  )  {  // if filtro dentro de foreach recintos
                          ?>



                          <div id="slidingDiv<?php echo $cont?>" class="toggleDiv row-fluid single-project">
                            <div class="span6"> 
                              <style>
                                .Flexible-container {
                                  position: relative;
                                  padding-bottom: 56.25%;
                                  padding-top: 80px;
                                  height: 0;
                                  /* overflow: hidden; */
                                }
                                .Flexible-container iframe,   
                                .Flexible-container object,  
                                .Flexible-container embed {
                                  position: absolute;
                                  top: 0;
                                  left: 0;
                                  width: 100%;
                                  height: 100%;
                                }
                              </style>
                              <div class="Flexible-container">
                                <iframe
                                width="600"   height="500"  frameborder="5" style="border:0"  maptype="satellite"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDR2WyVnnd9GsSTKys5OEkowPu41kMpEUs
                                &q=Chile + Chillan + <?php echo $key['direccion'];?>" allowfullscreen>
                              </iframe>
                            </div>
                          </div>
                          <div class="span6">
                            <div class="project-description">
                              <div class="project-title clearfix">
                                <h3> <?php echo $nombre ?></h3>
                                <span class="show_hide close">
                                  <i class="icon-cancel"></i> 
                                </span>

                              </div>



                              <div class="project-info">
                                <table width='100%'>
                                  <tr>
                                    <td width='50%'><span>Nombre   </span></td>
                                    <td width='50%'><?php echo $key['nombre'];?></td>
                                  </tr>
                                  <tr>
                                    <td><span>Descripción   </span></td>
                                    <td><?php echo $key['descripcion'];?></td>
                                  </tr>
                                  <tr>
                                    <td><span>Dirección   </span></td>
                                    <td><?php echo $key['direccion'];?></td>
                                  </tr>
                                </table>

                                <br/>
                                <center>
                                  <button class="btn btn-primary btn-lg tercer" href="#" data-toggle="modal" data-target="#modal-1" data-id="<?php echo $key['idLocal']; ?>">
                                    Ir Aqui
                                  </button> 
                                </center>

                              </div>

                              <p></p> <!--puede ir algo mas escrito aqui -->
                            </div>

                          </div>

                        </div> <!-- Fin Sliding Div-->

                        <?php 
                        $cont++;

                }  // fin if filtro dentro de foreach
            } // fin foreach recintos
            ?>
            



            <ul id="portfolio-grid" class="thumbnails row">
              <?php
              $cont = 0;
              foreach ($vectorLocales as $key) {   
                $nombre = $key['nombre'];
                $pos = strripos($nombre, $search);
                $descripcion = $key['descripcion'];
                $pos2 = strripos($descripcion, $search);
                $idLocal = $key['idLocal'];
                if ($pos !== false  ||   $pos2!==false  )  {  
                  ?>
                  <li class="span4 mix web">
                    <div class="thumbnail">
                      <img id="redimensionar" src="assets/images/locales/<?php echo $key['fotografia'];?>" height='640' width='400' alt="project 1">
                      <a href="#single-project" class="more show_hide" rel="#slidingDiv<?php echo $cont?>">
                        <i class="icon-plus"></i>
                      </a>
                      <h3> <?php echo "$nombre" ?> </h3>
                      <p><?php echo $key['descripcion']; ?></p>
                      <div class="mask"></div>
                    </div>
                  </li>
                  <?php 

                  $cont++;

                  
                }    
              }
              ?>
            </ul>


          </div>

        </div>
      </div>
      <!-- Portfolio section end -->


      <div class="container">
        <div class="modal fade" id="modal-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Define la información del encuentro</h3>
              </div>
              <div class="modal-body">
                <form  method="post" action="?controlador=TercerTiempo&accion=ingresarTercerTiempo" class="design-form" >
                  <div class="container">  
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label class="label-partido" for="hora">Hora <i class="fa fa-clock-o" aria-hidden="true"></i></label>
                          <input type="time" name="hora" placeholder="Hora del encuentro" class="form-control partido" required="required">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label class="label-partido" for="descripcion">Comentarios adicionales <i class="fa fa-comments-o" aria-hidden="true"></i></label>
                          <input type="textarea" name="comentario" placeholder="Aqui escribe comentarios acerca del encuentro" 
                          class="form-control partido" required="required">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label class="label-partido" for="descripcion">Cuota <i class="fa fa-comments-o" aria-hidden="true"></i></label>
                          <input type="number" name="cuota" placeholder="Cuota personal" 
                          class="form-control partido" required="required">
                        </div>

                      </div>
                    </div>
                    <input id="idLocal" type="number" name="idLocal" value="" hidden></input>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <button type="submit" class="btn-submit" >Siguiente</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>   
              </div>
            </div>
            <div class="modal-footer"></div>
          </div>
        </div>
      </div>




















      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      <script type="text/javascript" src="assets/js/jquerypp.custom.js"></script>
      <script type="text/javascript" src="assets/js/jquery.elastislide.js"></script>



      <!-- /Aqui termina la pagina -->



      <footer id="footer">
        <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <div class="container text-center">
            <div class="footer-logo">
              <a href="?controlador=Index&accion=indexJugador"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
            </div>

            <p>Proyecto de título realizado por Carlos Mora Roa y Pablo Silva Bravo </p>
          </div>
        </div>
      </footer>

      <script src="js/jquery.js"></script>
      <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
      <script type="text/javascript" src="assets/js/bootstrap.js"></script>
      <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
      <script type="text/javascript" src="assets/js/jquery.bxslider.js"></script>
      <script type="text/javascript" src="assets/js/jquery.cslider.js"></script>
      <script type="text/javascript" src="assets/js/jquery.placeholder.js"></script>
      <script type="text/javascript" src="assets/js/jquery.inview.js"></script>

      <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
            <![endif]-->
            <script type="text/javascript" src="assets/js/app.js"></script>



            <script src="http://maps.googleapis.com/maps/api/js"></script>
            <script>
              function initialize() {
                var mapProp = {
                  center:new google.maps.LatLng(-36.602459, -72.077014),
                  zoom:14,
                  mapTypeId:google.maps.MapTypeId.ROADMAP
                };
                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
              }


              google.maps.event.addDomListener(window, 'load', initialize);
              google.maps.event.addDomListener(
                window,
                'load',
                function () {
                 //1000 milliseconds == 1 second,
                 //play with this til find a happy minimum delay amount
                 window.setTimeout(initialize, 1000);
               }
               );
             </script>
             <script >
              var idLocal;
              $('.tercer').click(function (e){
                e.preventDefault();
                idLocal = $(this).data('id');
                document.getElementById('idLocal').setAttribute("value", idLocal);

              }); 
            </script>



          </body>
          </html>