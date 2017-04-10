  
<?php
$implemento = $vars['implemento'];

?>

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <?php
      foreach ($implemento as $key ) {
        $idImplemento = $key['idImplemento'];
      ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo "Implemento ".$key['nombre']?></h4>
      </div>
      <div class="modal-body">
              <form action="?controlador=Recinto&accion=actualizarImplementoRecinto" method="post">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $key['nombre']?>"  required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>



                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $key['precio']?>" required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>

                <!--input name="idRecinto" value="<?php echo $idRecinto?>" hidden-->

                <input name="idImplemento" value="<?php echo $idImplemento?>" hidden>
                <div class="row modal-footer">
                  <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary col-xs-12" >Agregar <i class="fa fa-plus-circle fa-1x" aria-hidden="true"></i></button>
                  </div>
                  <div class="col-xs-6">             
                    <button data-dismiss="modal" class="btn btn-danger col-xs-12">Volver <i class="fa fa-arrow-left fa-1x"></i></button>
                  </div>
                </div>
              </form>
      </div>
      <?php
      }
      ?>


      <div class="modal-footer">
      </div>
    </div>
  </div>