
<!--MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cargando información</h4>
      </div>
      <div class="modal-body">
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--Modal-->


<?php
$implementos = $vars['implementos'];
$idRecinto = $vars['idRecinto'];
?>

<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">
        Implementos 
        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal">
          Nuevo implemento
           <i class="fa fa-plus-circle" aria-hidden="true"></i>
         </button>
      </h3> 
    </div>

    <div class="modal-body">
      <?php
      if (count($implementos) == 0){
        echo "<h3>Este recinto no tiene implementos.</h3>";
      } else {
          ?>
          <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              <th></th>
              <th></th>
            </tr>
            <?php
            foreach ($implementos as $key) {
              $idImplemento = $key['idImplemento'];
            ?>
            <tr>
              <td><?php echo $key['nombre']?></td>
              <td>
              <?php 
                    setlocale(LC_MONETARY, 'es_CL');
      echo money_format('%.0n', $key['precio']) . "\n";

              ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                data-toggle="modal" data-target="#modal3" onclick="carga_ajax3('modal','<?php echo $idImplemento?>','editar');">
                Editar 
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
              </td>
              <td>
                <form action="?controlador=Recinto&accion=eliminarImplemento" method="post">
                  <input name="idImplemento" value="<?php echo $key['idImplemento']?>" hidden>
                  <input name="idRecinto" value="<?php echo $idRecinto?>" hidden>
                  <button type="submit" class="btn btn-danger btn-sm col-xs-12">Eliminar 
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                </form>  
              </td>
            </tr>
            <?php
            }
            ?>
          </table>
        <?php
      }
      ?>
    </div>
    <div class="modal-footer">
      
    </div>
  </div>
</div>







<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agrega un nuevo implemento</h4>
            </div>
            <div class="modal-body">     
              <form action="?controlador=Recinto&accion=agregarImplemento" method="post">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>


                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="number" class="form-control" id="precio" name="precio" required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>

                <input name="idRecinto" value="<?php echo $idRecinto?>" hidden>
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
        </div>
    </div>
</div>









<script>
 
function carga_ajax3(div, id, tipo){

  if (tipo == 'editar'){
    $.post(
      '?controlador=Recinto&accion=editarImplemento&idImplemento='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }


  
}
</script>