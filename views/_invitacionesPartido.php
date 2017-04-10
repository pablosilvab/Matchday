
<!--MODAL -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

      <?php
      $tipoPartido = $vars['tipoPartido'];

      if ($tipoPartido == 4){
        ?>
        <h4 class="modal-title">Jugadores del partido</h4>
        <?php
      } else {
        ?>
        <h4 class="modal-title">Invitaciones del partido</h4>
        <?php
      }

      ?>
      
    </div>

    <?php
    $invitaciones = $vars['invitaciones'];
    $estadoPartido = $vars['estadoPartido'];
    $idPartido = $vars['idPartido'];
    


    ?>


    
    <div class="modal-body">
      <h5 class="texto-modal-negro">
         
        <?php 

        if ($tipoPartido == 4 ){
          echo "Los jugadores de los equipos del partido son los siguientes.";
        } else {



          if ($estadoPartido == 4){
            echo $vars['descartados']."  de los ".$vars['nroJugadores']." jugadores invitados no asistirán a este partido.";
            echo " Puedes invitar a otros jugadores de MatchDay haciendo click ";
            ?>
            <button type="button" class="btn btn-success" href="javascript:void(0);" data-toggle="modal" data-target="#modal2"  
            onclick="carga_ajax3('modal','<?php echo $idPartido?>','notificar');">
            Notificar 
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
          </button>
          <?php
          } 
          if ($estadoPartido == 1) {
            echo "Los jugadores están respondiendo a tu invitación, ten paciencia.";
          }
          if ($estadoPartido == 5) {
            echo "Este es tu partido MatchDay";
          }
        }
        ?>
      </h5>
      <br/>



      <!-- Partidos Activos y Pendientes-->

      <?php
      $variable = "Invitado";
      if ($tipoPartido == 4){
        $variable = "Jugador";
      }

      if ($estadoPartido != 5){
      ?>
      <div class="col-md-12">
        <div class="table-responsive">
        <table id="example6" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
          <thead id ="position-table">
            <tr id="color-encabezado">
              <th id="encabezado-especial"></th>
              <th id="encabezado-especial"><?php echo $variable?></th>
              <th id="encabezado-especial">Estado</th>
            </tr>
          </thead>
          <tbody id="texto-contactos" class="center">
            <?php
            foreach ($invitaciones as $key ) {
            ?>
            <tr>
              <td>
                <img 
                  style="-webkit-border-radius: 5px;
                  -moz-border-radius: 5px;
                  border-radius: 5px;" 
                  height="64" 
                  width="64" 
                  src="assets/images/usuarios/<?php echo $key['fotografia']?>"  />
              </td>
              <td>
                <?php 
                if ($key['estadoJugador'] == 3){
                  echo "Invitado externo";
                } else {
                  echo $key['nombre']." ".$key['apellido'];
                }
                ?>
              </td>
              <td>
                <?php 
                if ($key['estado'] == 0){
                  ?>
                  <span class="label label-warning">Esperando respuesta <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                  <?php
                }
                if ($key['estado'] == 1){
                  ?>
                  <span class="label label-success">Confirmado <i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                  <?php
                }
                if ($key['estado'] == 2){
                  ?>
                  <span class="label label-danger">Descartado <i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
                  <?php
                }
                ?>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        </div>
      </div>
      <?php
      }
      ?>


      <!-- Partidos Activos y Pendientes-->

      <?php
      if ($estadoPartido == 5){
      ?>
      <div class="col-md-12">
        <table id="example6" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
          <thead id ="position-table">
            <tr id="color-encabezado">
              <th id="encabezado-especial"></th>
              <th id="encabezado-especial">Invitado</th>
              <th id="encabezado-especial">Estado</th>
            </tr>
          </thead>
          <tbody id="texto-contactos" class="center">
            <?php
            foreach ($invitaciones as $key ) {
              if ($key['estado'] != 2) {
            ?>
            <tr>
              <td>
                <img 
                  style="-webkit-border-radius: 5px;
                  -moz-border-radius: 5px;
                  border-radius: 5px;" 
                  height="64" 
                  width="64" 
                  src="assets/images/usuarios/<?php echo $key['fotografia']?>"  />
              </td>
              <td>
                <?php echo $key['nombre']." ".$key['apellido']?>
              </td>
              <td>
                <?php 
                if ($key['estado'] == 0){
                  ?>
                  <span class="label label-warning">Esperando respuesta <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                  <?php
                }
                if ($key['estado'] == 1){
                  ?>
                  <span class="label label-success">Confirmado <i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                  <?php
                }
                if ($key['estado'] == 2){
                  ?>
                  <span class="label label-danger">Descartado <i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
                  <?php
                }
                }
                ?>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      }
      ?>



    </div>



    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
    </div>
  </div>
</div>



<script type="text/javascript">
  
  function carga_ajax3(div, id, tipo){


  /* Acceder al resumen de un partido pendiente y notificarlo */
  if (tipo == 'notificar'){
    $.post(
      '?controlador=Partido&accion=notificarPartido&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }

 
  }
</script>