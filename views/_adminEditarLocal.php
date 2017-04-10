<?php
$local = $vars['local'];

foreach ($local as $key ) {
?>
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title"><?php echo $key['nombre']?></h3>
    </div>
    <div class="modal-body">
      <form action="?controlador=Local&accion=updateLocal" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $key['nombre']?>" required>
          <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
        </div>
        <div class="form-group">
          <label for="superficie">Descripción</label>
          <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $key['descripcion']?>" required>
          <small id="emailHelp" class="form-text text-muted">Indica si el local es un pub, restaurante, restobar, etc.</small>
        </div>
        <div class="form-group">
          <label for="direccion">Dirección</label>
          <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $key['direccion']?>" required>
        </div>

        <input name="idLocal" value="<?php echo $key['idLocal']?>" hidden/>
        <!--div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
        </div-->

        <div class="form-group">
          <label for="fotografia">Fotografía</label>
          <input type="file" class="form-control-file" id="imagen" name="imagen" aria-describedby="fileHelp" >
          <!--small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small-->
        </div>

        <br/>

        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary col-xs-12">Actualizar <i class="fa fa-paper-plane fa-1x"></i></button>
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