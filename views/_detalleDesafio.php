<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Información adicional</h4>
      </div>
      <?php
      $equipoSeleccionado = $vars['equipoSeleccionado'];
      $desafio = $vars['desafio'];
      foreach ($desafio as $item) {
        $idDesafio = $item['idDesafio'];
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
                    <th>Desafiante</th>
                    <td><?php echo $item['nombreEquipo']." de color ".$item['colorEquipo']?></td>
                  </tr>
                  <tr>
                    <th>Capitán</th>
                    <td><?php echo $item['nombre']." ".$item['apellido']?></td>
                  </tr>
                  <tr>
                    <th>Comentario</th>
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
      <br/>

      <div class="modal-footer">
         <h6 class="texto-modal-negro">Puedes agregar un comentario al capitán del equipo desafiante. Para aceptar este desafío haciendo click en el botón "Desafiar". </h6>
         <form id="demoform" action="?controlador=Desafio&accion=setEncuentro" method="post">
          <input type="text" name="desafio" value="<?php echo $idDesafio?>" hidden/>
          <input type="text" name="equipo" value="<?php echo $equipoSeleccionado?>" hidden/>
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  
                  <textarea id="texto-input-black" class="form-control" rows="2" maxlength="200" placeholder="Aqui puedes escribir información adicional (hora, posiciones de jugadores, etc.)" name="comentario" ></textarea>
                </div>
              </div>
            </div>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
        <button type="submit" class="btn btn-primary">Desafiar <i class="fa fa-check-circle" aria-hidden="true"></i></button>
        </form>
      </div>


      
    </div>
  </div>