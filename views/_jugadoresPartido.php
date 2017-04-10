<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Jugadores del partido</h4>
    </div>
    <?php
    $tipoPartido = $vars['tipoPartido'];
    //echo $tipoPartido;
    if ($tipoPartido == 4){

      $jugadores1 = $vars['jugadores1'];
      $jugadores2 = $vars['jugadores2'];

      $equipo1 = $vars['equipo1'];
      $equipo2 = $vars['equipo2'];
      foreach ($equipo1 as $key ) {
        $nombreEquipo1 = $key['nombre'];
      }
      foreach ($equipo2 as $key ) {
        $nombreEquipo2 = $key['nombre'];
      }

      ?>
        <!--div class="row"-->
            <div class="col-md-6">
              <table class="table table-striped table-hover table-condensed table-responsive">
                <tr>
                  <th id="color-encabezado" colspan="2">
                    <?php echo $nombreEquipo1;?>
                  </th>
                </tr>
                <?php foreach ($jugadores1 as $key) {
                  ?>
                <tr>
                  <td class="center"><?php echo $key['nombre']." ".$key['apellido']?></td>
                
                </tr>
                 <?php
                  }
                  ?>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-striped table-hover table-condensed table-responsive">
                <tr>
                  <th id="color-encabezado" colspan="2">
                    <?php echo $nombreEquipo2;?>
                  </th>
                </tr>
                <?php foreach ($jugadores2 as $key) {
                  ?>
                <tr>
                  <td class="center"><?php echo $key['nombre']." ".$key['apellido']?></td>
                </tr>
                 <?php
                  }
                  ?>
              </table>
            </div>
        <!--/div-->
      <?php
    } else {

      $jugadores = $vars['jugadores'];
      ?>
      <div class="modal-body">


        <div class="col-md-12">
        <div class="table-responsive">
        <table id="example6" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
          <thead id ="position-table">
            <tr id="color-encabezado">
              <th id="encabezado-especial"></th>
              <th id="encabezado-especial">Invitado</th>
            </tr>
          </thead>
          <tbody id="texto-contactos" class="center">
            <?php
            foreach ($jugadores as $key ) {
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
                if ($key['estado'] == 3){
                  echo "Invitado externo";
                } else {
                  echo $key['nombre']." ".$key['apellido'];
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












      </div>
      <?php
    }
    ?>

    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
    </div>
  </div>
</div>

 