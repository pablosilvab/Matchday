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
$horarios = $vars['horarios'];
$idRecinto = $vars['idRecinto'];
?>

<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">
        Horarios 
        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal">
          Nuevo horario
           <i class="fa fa-plus-circle" aria-hidden="true"></i>
         </button>
      </h3> 
    </div>

    <div class="modal-body">
      <?php
      if (count($horarios) == 0){
        echo "<h3>Este recinto no tiene horarios asociados.</h3>";
      } else {
        ?>
          <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Hora inicio</th>
              <th>Hora fin</th>
              <th>Días</th>
              <th></th>
              <th></th>
            </tr>
            <?php
            foreach ($horarios as $key) {
              $idHorario = $key['idHorario'];
          
            ?>
            <tr>
              <td><?php echo $key['nombre']?></td>
              <td>
              <?php       setlocale(LC_MONETARY, 'es_CL');
      echo money_format('%.0n', $key['precio']) . "\n";

              ?></td>
              <td><?php echo $key['horaInicio']?></td>
              <td><?php echo $key['horaFin']?></td>
              <td>
                <?php 
                $dias= explode(',',$key['dias']);
                //En este auxiliar iremos guardando los dias y asi mostrar los correspondientes.
                $aux='';
                if(count($dias) == 7){
                  echo 'Todos los dias';
                }else{
                  for($i=0; $i < count($dias); $i++){
                    $d=$aux;
                    if($dias[$i] == "0")
                      $aux=$d.'Lunes ';
                    if($dias[$i] == "1")
                      $aux=$d.'Martes ';
                    if($dias[$i] == "2")
                      $aux=$d.'Miercoles ';
                    if($dias[$i] == "3")
                      $aux=$d.'Jueves ';
                    if($dias[$i] == "4")
                      $aux=$d.'Viernes ';
                    if($dias[$i] == "5")
                      $aux=$d.'Sabado ';
                    if($dias[$i] == "6")
                      $aux=$d.'Domingo ';
                  }
                  echo $aux;
                }   
                ?>
              </td>
              <td>
                <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                data-toggle="modal" data-target="#modal2" onclick="carga_ajax2('modal','<?php echo $idHorario?>','editar');">
                Editar 
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
              </td>
              <td>
                <form action="?controlador=Recinto&accion=eliminarHorario" method="post">
                  <input name="idHorario" value="<?php echo $idHorario?>" hidden>
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
                <h4 class="modal-title" id="myModalLabel">Agrega un nuevo horario</h4>
            </div>
            <div class="modal-body">     
              <form action="?controlador=Recinto&accion=agregarHorario" method="post">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>

                <div class="form-group">
                  <label for="horaInicio">Hora inicio</label>
                  <input type="time" name="horaInicio" placeholder="Hora" class="form-control" id="horaInicio" required="required" min="09:00:00" max="23:00:00" step="3600">
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>

                <div class="form-group">
                  <label for="horaFin">Hora fin</label>
                  <input type="time" name="horaFin" placeholder="Hora" class="form-control" id="horaFin" required="required" min="09:00:00" max="23:00:00" step="3600">
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>


                <div class="form-group">
                  <label for="dias">Días</label>

                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="0" name="listaDias[]"> Lunes
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" name="listaDias[]"> Martes
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="2" name="listaDias[]"> Miércoles
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="3" name="listaDias[]"> Jueves
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="4" name="listaDias[]"> Viernes
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="5" name="listaDias[]"> Sábado
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="6" name="listaDias[]"> Domingo
                      </label>
                    </div>
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
 
function carga_ajax2(div, id, tipo){

  if (tipo == 'editar'){
    $.post(
      '?controlador=Recinto&accion=editarHorario&idHorario='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }


  
}
</script>