
<style type="text/css">
.borde-radio{
    display: block;
    margin-left: auto;
    margin-right: auto;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
}

</style>


<?php
$jugador = $vars['jugador'];

foreach ($jugador as $key ) {
?>



<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title">Jugador <?php echo $key['nombre']." ".$key['apellido']?></h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-4">

          <img height="100" width="100" src="assets/images/usuarios/<?php echo $key['fotografia']; ?>"  
          class="img-responsive borde-radio" alt="">
        </div>
        <div class="col-md-8">
          <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
              <th width='20%'>Nombre</th>
              <td><?php echo $key['nombre']." ".$key['apellido']?></td>
            </tr>
            <tr>
              <th>Mail</th>
              <td><?php echo $key['mail']?></td>
            </tr>
            <tr>
              <th>Edad</th>
              <td><?php echo $vars['edadJugador']?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      
    </div>
  </div>
</div>
<?php
}
?>