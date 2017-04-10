


<!--MODAL -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando ...</h4>
      </div>
      <div class="modal-body">
        <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
        <h4>Espere por favor ... </h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->








<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Información del partido</h4>
    </div>

    <?php

      /* Verificar si se viene al detalle para:
        1. Ver el resumen de un partido en el sistema.
        2. Ver el resumen de un partido pendiente y cancelarlo.
        3. Ver el resumen de un partido pendiente y notificarlo a los jugadores del sistema
      */

        foreach ($vars['partido'] as $key ) {
          $idPartido = $key['idPartido'];
          $idOrganizador = $key['idOrganizador'];
          $idRecinto = $key['idRecinto'];
          $fecha = $key['fechaPartido'];
          $hora = $key['horaPartido'];
          $nombreRecinto = $key['nombre'];
          $fotoRecinto = $key['fotografia'];
          $organizador = $key['nombreCap']." ".$key['apellidoCap'];
          $tipoPartido = $key['tipoPartido'];

          $tipoRecinto = $key['tipo'];
          $cuota = $key['cuota'];


        }
        ?>

        <div class="modal-body">

          <div class="container-fluid">
            <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
              <div class="span4">
                <img src="assets/images/recintos/<?php echo $fotoRecinto?>" alt="project 2">
                <button type="button" class="btn btn-primary btn-md center-block col-md-12" href="javascript:void(0);" 
                data-toggle="modal" data-target="#modal2"  onclick="carga_ajax('modal2','<?php echo $idRecinto;?>' ,'mapaRecinto');">
                ¿Cómo llegar? <i class="fa fa-map-marker" aria-hidden="true"></i>
              </button>
            </div>
            <div class="span8">
              <div class="project-description">
                <div class="project-info">
                  <table>
                    <tr>
                      <th width='15%'><span>Cancha</span></th>
                      <td id="texto-blanco" width='25%'><?php echo $nombreRecinto;?></td>
                    </tr>
                    <tr>
                      <th><span>Organizador</span></th>
                      <td id="texto-blanco"><?php echo $organizador?></td>
                    </tr>
                    <tr>
                      <th><span>Fecha</span></th>
                      <td id="texto-blanco"><?php echo $fecha;?></td>
                    </tr>
                    <tr>
                      <th><span>Hora</span></th>
                      <td id="texto-blanco"><?php echo $hora;?></td>
                    </tr>
                    <tr>
                      <th><span>Tipo</span></th>
                      <td id="texto-blanco"><?php echo $tipoRecinto;?></td>
                    </tr>
                    <tr>
                      <th><span>Cuota</span></th>
                      <td id="texto-blanco">
                      <?php 			setlocale(LC_MONETARY, 'es_CL');
										echo money_format('%.0n', $cuota) . "\n";

                      ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <br/>

        <div class="modal-footer">
          <?php
          $accion = $vars['accion'];
        if ($accion == 0){  // Solicitud
          ?>
          <form action="?controlador=Partido&accion=enviarSolicitud" method="post">
            <input name="idPartido" value="<?php echo $idPartido; ?>"  hidden/>
            <input name="accion" value="<?php echo $accion; ?>"  hidden/>
            <div class="row">
              <div class="col-md-12 center-block">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                <button type="submit" class="btn btn-primary btn-lg">Enviar solicitud <i class="fa fa-check-circle" aria-hidden="true"></i></button>
              </div>
            </div>       
          </form>



          <?php
        }
        if ($accion == 1){  // Cancelar
          ?>
          <h5 class="modal-title">¿Estás seguro que deseas cancelar este partido?</h5>
          <form action="?controlador=Partido&accion=accionCancelarPartido" method="post">
            <input name="idPartido" value="<?php echo $idPartido; ?>"  hidden/>
            <input name="accion" value="<?php echo $accion; ?>"  hidden/>
            <div class="row">
              <div class="col-md-12 center-block">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">No <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                <button type="submit" class="btn btn-primary btn-lg">Si <i class="fa fa-check-circle" aria-hidden="true"></i></button>
              </div>
            </div>       
          </form>


          <?php
        }
        if ($accion == 2){  // Notificar
          ?>
          <h5 class="modal-title">Al notificar este partido al sistema, todos los jugadores de MatchDay tendrán acceso
            a la información referente al partido. ¿Estás seguro que deseas notificar el partido?</h5>
            <br/>
            <form action="?controlador=Partido&accion=partidoMatchday" method="post">
              <input name="idPartido" value="<?php echo $idPartido; ?>"  hidden/>
              <input name="accion" value="<?php echo $accion; ?>"  hidden/>
              <div class="row">
                <div class="col-md-12 center-block">
                  <button type="button" class="btn btn-danger btn-lg " data-dismiss="modal">No, deseo volver a mi lista <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                  <button type="submit" class="btn btn-primary btn-lg">Si, notificar partido <i class="fa fa-check-circle" aria-hidden="true"></i></button>
                </div>
              </div>       
            </form>
            <?php
          }
        if ($accion == 3){  // Resumen
          ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            if ($tipoPartido == 4){
              echo "El desafío ha sido agendado";
            } else {
              echo "
              Tu invitación ha sido enviada a los jugadores que elegiste, ten paciencia.";
            }
            ?>
          </div>

          <br/>
          <div class="row">
            <div class="col-md-12 center-block">
              <button type="button" class="btn btn-primary btn-lg " data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            </div>
          </div> 
          <?php
        }
        if ($accion == 4){  // Ver respuestas
          $solicitudes = $vars['solicitudes'];
          $i = 0;
          foreach ($solicitudes as $key) {
            if ($key['estado'] == 2){
              $i++;
            }
          }
          $nroRespuestas = $i;
          if ($nroRespuestas == 0){
            ?>
            <div class="alert alert-warning alert-dismissible">
              Actualmente no tienes ninguna solicitud para este partido.
            </div>
            <?php
          } else {
            ?>
            <div class="alert alert-info alert-dismissible">
              Los siguientes jugadores han enviado una solicitud para unirse a tu partido.
            </div>

            <div class="col-md-12">
              <!--div class="table-responsive"-->
              <table id="example4" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <th id="encabezado-especial">Jugador</th>
                    <th id="encabezado-especial">Edad</th>
                    <th id="encabezado-especial">Teléfono</th>
                    <th id="encabezado-especial"></th>
                    <th id="encabezado-especial"></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($solicitudes as $item) {
                    $estado = $item['estado'];
                    if ($estado == 2){
                      $idUsuario = $item['idUsuario'];
                      $nombre = $item['nombre']." ".$item['apellido'];
                      $fono = $item['telefono'];
                      ?>
                      <tr>
                        <td width='20%'>
                          <?php echo $nombre?>
                        </td>
                        <td width='20%'>
                          <?php echo $vars['edadUsuario'.$item['idUsuario']]?>
                        </td>
                        <td width='20%'>
                          <?php echo $fono?>
                        </td>
                        <td>
                          <form action="?controlador=Partido&accion=accionResponderSolicitud" method="post">
                            <input name="idUsuario" value="<?php echo $idUsuario; ?>"  hidden/>
                            <input name="accion" value="<?php echo $accion; ?>"  hidden/>
                            <input name="respuesta" value="3"  hidden/>
                            <input name="idPartido" value="<?php echo $idPartido; ?>" hidden/>
                            <button type="submit" class="btn btn-danger btn-md">Rechazar <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                          </form>
                        </td>
                        <td>
                          <form action="?controlador=Partido&accion=accionResponderSolicitud" method="post">
                            <input name="idUsuario" value="<?php echo $idUsuario; ?>"  hidden/>
                            <input name="accion" value="<?php echo $accion; ?>"  hidden/>
                            <input name="respuesta" value="1"  hidden/>
                            <input name="idPartido" value="<?php echo $idPartido; ?>" hidden/>
                            <button type="submit" class="btn btn-primary btn-md">Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i></button>
                          </form>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
              <!--/div-->
            </div>




            <script type="text/javascript">
              $(document).ready(function() {
                $('#example4').DataTable({
                  responsive: true
                });
              } );
            </script>

            <?php
          }


          $aux = 0;
          foreach ($solicitudes as $key) {
            if ($key['estado'] == 1){
              $aux++;
            }
          }

          if ($aux > 0 ){
            ?>
            <br/>
            <br/>


            


            <div class="col-md-12">

              <div class="alert alert-info">
                Has aceptado <?php echo $aux?> solicitud(es).
              </div>

              <table id="example5" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <th id="encabezado-especial">Jugador</th>
                    <th id="encabezado-especial">Edad</th>
                    <th id="encabezado-especial">Teléfono</th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($solicitudes as $item) {
                    $estado = $item['estado'];
                    if ($estado == 1){
                      $idUsuario = $item['idUsuario'];
                      $nombre = $item['nombre']." ".$item['apellido'];
                      $fono = $item['telefono'];
                      ?>
                      <tr>
                        <td width='20%'>
                          <?php echo $nombre?>
                        </td>
                        <td width='20%'>
                          <?php echo $vars['edadUsuario'.$item['idUsuario']]?>
                        </td>
                        <td width='20%'>
                          <?php echo $fono?>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>




            <script type="text/javascript">
              $(document).ready(function() {
                $('#example5').DataTable({
                  responsive: true
                });
              } );
            </script>
            <?php
          }

          ?>






          <br/>
          <div class="row">
            <div class="col-md-12 center-block">
              <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            </div>
          </div> 
          <?php
        }


        if ($accion == 5){

          ?>

          <table class="table">
            <tr>
              <th style="border-top:transparent; text-align:center;" colspan="2"><h4>¿Deseas aceptar la invitación?</h4></th>
            </tr>
            <tr>
              <th style="border-top:transparent; text-align:center;">

                <form action="?controlador=Partido&accion=cancelarInvitacion" method="post">
                  <input name="idPartido" value="<?php echo $idPartido?>" hidden>
                  <input name="idUsuario" value="<?php echo $_SESSION['login_user_id']?>" hidden>
                  <button type="submit" class="btn btn-md btn-warning btn-lg col-xs-12">No
                    <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                  </button>
                </form>


              </th>
              <th style="border-top:transparent; text-align:center;">


                <form action="?controlador=Partido&accion=aceptarInvitacion" method="post">
                  <input name="idPartido" value="<?php echo $idPartido?>" hidden>
                  <input name="idUsuario" value="<?php echo $_SESSION['login_user_id']?>" hidden>
                  <button type="submit" class="btn btn-md btn-primary btn-lg col-xs-12">Si
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                  </button>
                </form>



              </th>
            </tr>
          </table>

          <?php

        }



        if ($accion == 6){

          ?>


          <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            if ($tipoPartido == 4){
              echo "El desafío ha sido agendado";
            } else {
              echo "Tu respuesta ha sido enviada a ".$organizador;
            }
            ?>
          </div>

          <br/>
          <div class="row">
            <div class="col-md-12 center-block">
              <button type="button" class="btn btn-primary btn-lg " data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            </div>
          </div> 
          

          <?php
          


        }

        if ($accion == 7){

          $estadoInvitacion = $vars['invitacion'];

          if ($estadoInvitacion == 0){




            ?>


            <table class="table">
              <tr>
                <th style="border-top:transparent; text-align:center;" colspan="2"><h4>¿Deseas aceptar la invitación?</h4></th>
              </tr>
              <tr>
                <th style="border-top:transparent; text-align:center;">

                  <form action="?controlador=Partido&accion=cancelarInvitacion" method="post">
                    <input name="idPartido" value="<?php echo $idPartido?>" hidden>
                    <input name="idUsuario" value="<?php echo $_SESSION['login_user_id']?>" hidden>
                    <button type="submit" class="btn btn-md btn-warning btn-lg col-xs-12">No
                      <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                    </button>
                  </form>


                </th>
                <th style="border-top:transparent; text-align:center;">


                  <form action="?controlador=Partido&accion=aceptarInvitacion" method="post">
                    <input name="idPartido" value="<?php echo $idPartido?>" hidden>
                    <input name="idUsuario" value="<?php echo $_SESSION['login_user_id']?>" hidden>
                    <button type="submit" class="btn btn-md btn-primary btn-lg col-xs-12">Si
                      <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    </button>
                  </form>



                </th>
              </tr>
            </table>


            <?php
          } 
          if ($estadoInvitacion == 1){


           if ($_SESSION['login_user_id'] == $idOrganizador ){

            ?>

            <div class="alert alert-info alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php
              if ($tipoPartido == 4){
                echo "El desafío ha sido agendado";
              } else {
                echo "
                Tu invitación ha sido enviada a los jugadores que elegiste, ten paciencia.";
              }
              ?>
            </div>


            <?php

          } else {

            ?>

            <div class="alert alert-info alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php
              if ($tipoPartido == 4){
                echo "El desafío ha sido agendado";
              } 
              ?>
            </div>

            <?php

            ?>


            <br/>
            <div class="row">
              <div class="col-md-12 center-block">
                <button type="button" class="btn btn-primary btn-lg " data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
              </div>
            </div> 

            <?php
          }
          ?>




          <?php
        }

      }

      ?>

    </div>



  </div>
</div>


<script>

  function carga_ajax(div, id, tipo){

    /* Acceder al mapa */
    if (tipo == 'mapaRecinto'){
      $.post(
        '?controlador=Recinto&accion=verMapaRecinto&idRecinto='+id,
        function(resp){
          $("#"+div+"").html(resp);
        }
        ); 
    }

  }


</script>   