
<!--MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
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
            <h4></h4>
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
          $desafio = $vars['desafio'];
          
          $encuentros = $vars['listaEncuentros'];
        ?>
        <h4 class="modal-title">
          <?php
          if (empty($encuentros)){
            echo "Detalle de desafío";
          } else {
            echo "¡Han respondido a tu desafío!";
          }
          ?>
        </h4>
      </div>
      <?php
      foreach ($desafio as $item) {
      
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
                    <td>
                      <?php 
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
                    }
                    */
                    ?>
                  </td>
                  </tr>
                  <tr>
                    <th>Tu comentario</th>
                    <td><?php echo $item['comentario']?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

      </div>
      <?php
      }
      ?>
      <hr/>
      
      <br/>


      <?php
      

      if (!empty($encuentros)){
        ?>


      
      <h6 class="texto-modal-negro">Propuestas</h6>
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-hover">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <th id="encabezado-especial">Equipo</th>
                    <th id="encabezado-especial">Capitán</th>
                    <th id="encabezado-especial">Edad promedio</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($encuentros as $item) {
                    $idEncuentro = $item['idEncuentro'];
                    $idDesafio = $item['idDesafio'];
                  ?>
                  <tr>
                  <td>
                    <?php echo $item['nombreEquipo']?>
                  </td>
                  <td>
                    <?php echo $item['nombreCap']." ".$item['apellidoCap']?>
                  </td>
                  <td>
                    <?php echo $item['edadPromedio']?>
                  </td>
                  <td>
                    <form id="demoform" action="?controlador=Desafio&accion=cancelarEncuentro" method="post">
                      <input type="text" name="idEncuentro" value="<?php echo $item['idEncuentro']?>" hidden/>
                      <input type="text" name="idEquipo" value="<?php echo $item['idEquipo']?>" hidden/>
                      <input type="text" name="idDesafio" value="<?php echo $idDesafio?>" hidden/>
                      <button type="submit" class="btn btn-danger" >Rechazar <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success" href="javascript:void(0);" 
                      data-toggle="modal" data-target="#modal2"  onclick="carga_ajax8('modal','<?php echo $idEncuentro?>','agendar');">
                      Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i></button>
                    </button>
                    <!--form id="demoform" action="?controlador=Desafio&accion=aceptarEncuentro" method="post">
                      <input type="text" name="idEncuentro" value="<?php echo $item['idEncuentro']?>" hidden/>
                      <input type="text" name="idEquipo" value="<?php echo $item['idEquipo']?>" hidden/>
                      <input type="text" name="idDesafio" value="<?php echo $item['idDesafio']?>" hidden/>
                      <button type="submit" class="btn btn-success" >Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i></button>
                    </form-->


                  </td>
                </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php
        }
        ?>





      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>

      </div>


      
    </div>
  </div>






<script>

function carga_ajax8(div, id,tipo){
  if (tipo == 'agendar'){
    $.post(
      '?controlador=Desafio&accion=agendarPartido&idEncuentro='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
  }
}
</script>