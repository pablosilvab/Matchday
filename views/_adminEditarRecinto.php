


<?php
$recinto = $vars['recinto'];

foreach ($recinto as $key ) {
  $idRecinto = $key['idRecinto'];
?>
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title"><?php echo $key['nombre']?>

      </h3> 
    </div>
    <div class="modal-body">
      <form action="?controlador=Recinto&accion=updateRecinto" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $key['nombre']?>" required>
          <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
        </div>
        <div class="form-group">
          <label for="tipo">Tipo de recinto</label>
          <select class="form-control" id="tipo" name="tipo" required>
            <?php
            if ($key['tipo'] == null){
              ?>
              <option selected disabled value="">Selecciona el tipo de cancha</option>
              <option>Futbol</option>
              <option>Baby-futbol</option>
              <option>Futbolito</option>
              <?php
            } else {

            
            ?>
            <option selected value="<?php echo $key['tipo']?>"><?php echo $key['tipo']?></option>
            <?php
            if ($key['tipo'] == "Futbolito"){
              ?>
              <option>Baby-fútbol</option>
              <option>Fútbol</option>
              <?php
            } else {
              if ($key['tipo'] == "Baby-futbol"){
                ?>
                <option>Futbolito</option>
                <option>Fútbol</option>
                <?php
              } else {
                if ($key['tipo'] == "Futbol"){
                  ?>
                  <option>Baby-fútbol</option>
                  <option>Futbolito</option>
                  <?php
                } 
              }
            }
            }
            
            ?>
          </select>
          <small id="emailHelp" class="form-text text-muted">Selecciona si es una cancha de fútbol, futbolito o baby-fútbol</small>
        </div>
        <div class="form-group">
          <label for="superficie">Superficie</label>
          <input type="text" class="form-control" id="superficie" name="superficie" value="<?php echo $key['superficie']?>" required>
        </div>
        <div class="form-group">
          <label for="direccion">Dirección</label>
          <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $key['direccion']?>" required>
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $key['telefono']?>" required>
        </div>




        <input name="idRecinto" value="<?php echo $key['idRecinto']?>" hidden/>


        <div class="form-group">
          <label for="fotografia">Fotografía</label>
          <input type="file" class="form-control-file" id="imagen" name="imagen" aria-describedby="fileHelp" >
          <!--small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small-->
        </div>

        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary col-xs-12">Actualizar <i class="fa fa-paper-plane"></i></button>
          </div>
          <div class="col-xs-4">
            <button type="reset" class="btn btn-warning col-xs-12">Reiniciar <i class="fa fa-eraser fa-1x"></i></button>
          </div>
          <div class="col-xs-4">
            <button data-dismiss="modal" class="btn btn-danger col-xs-12">Volver <i class="fa fa-arrow-left fa-1x"></i></button>
          </div>
        </div>
             

        
      </form>
    </div>
    <div class="modal-footer">
      
    </div>
  </div>
</div>
<?php
}
?>


