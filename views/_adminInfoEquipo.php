<?php
$equipo = $vars['equipo'];

foreach ($equipo as $key ) {
  $nombreEquipo = $key['nombre'];
}
?>
<style type="text/css">
  
  .profile-userpic img {
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}


</style>



<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title">Jugadores de <?php echo $nombreEquipo?></h3>
    </div>
    <div class="modal-body">
      <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th></th>
                <th>Nombre del jugador</th>
                <th >Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($equipo as $key) {
              ?>
              <tr>
                <td><div class="profile-userpic"><img height="64" width="64" src="assets/images/usuarios/<?php echo $key['fotografia']; ?>"  alt=""></div></td>
                <td ><?php echo $key['nombreJugador']." ".$key['apellidoJugador']?></td>
                <td >
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <span class="label label-success col-xs-12">Habilitado</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <span class="label label-danger col-xs-12">Deshabilitado</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 3){
                                                ?>
                                                <span class="label label-warning col-xs-12">Invitado</span>
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
    <div class="modal-footer">
      
    </div>
  </div>
</div>
