<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Información del encuentro</h4>
      </div>
      <?php
      //$equipoSeleccionado = $vars['equipoSeleccionado'];
      $encuentro = $vars['encuentro'];
      foreach ($encuentro as $item) {
        $idEncuentro = $item['idEncuentro'];
        ?>
      <div class="modal-body">
        <!--h6 class="texto-modal-negro">Si aceptas este desafío, el partido se llevará a cabo en la 
          cancha "<?php echo $item['nombreRecinto']?>". A continuación puedes ver toda la información relativa al desafío.</h6-->
        <div class="container-fluid">
          <div class="row">

            <div class="col-xs-12 col-sm-4">
              <h6 class="texto-modal-negro">Cancha: <?php echo $item['nombreRecinto']?></h6>
              <img style="-webkit-border-radius: 21px; -moz-border-radius: 21px; border-radius: 21px;" 
              src="assets/images/recintos/<?php echo $item['fotoRecinto'];?>"  class="img-responsive" alt="">
            </div>
            <div class="col-xs-12 col-sm-8">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th width='25%'>Fecha</th>
                    <td width='75%'><?php echo $item['fechaPartido']?></td>
                  </tr>
                  <tr>
                    <th>Tipo de partido</th>
                    <td><?php 
                    $tipoPartido = $item['tipoPartido'];
                    echo $tipoPartido;
                    /*
                    if ($tipoPartido == 0){
                      echo "Fútbol";
                    }
                    if ($tipoPartido == 1){
                      echo "Futbolito";
                    }
                    if ($tipoPartido == 2){
                      echo "Baby-fútbol";
                    }*/
                    ?></td>
                  </tr>
                  <tr>
                    <th>Partido</th>
                    <td><?php echo $item['equipo1']." vs ".$item['equipo2']?></td>
                  </tr>
                  <!--tr>
                    <th>Capitán Rival</th>
                    <td><?php echo $item['nombreCap']." ".$item['apellidoCap']?></td>
                  </tr>
                  <tr>
                    <th>Comentario</th>
                    <td><?php echo $item['comentario']?></td>
                  </tr-->
                </table>
              </div>
            </div>
          </div>

      </div>
      <?php 
      $estadoEncuentro = $item['estadoSolicitud'];
      }
      ?>
      <br/>

      <div class="modal-footer">

        <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
      </div>


      
    </div>
  </div>