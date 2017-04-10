  
<?php
$horario = $vars['horario'];

?>

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <?php
      foreach ($horario as $key ) {
        $idHorario = $key['idHorario'];
      ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo "Horario ".$key['nombre']?></h4>
      </div>
      <div class="modal-body">
              <form action="?controlador=Recinto&accion=actualizarHorario" method="post">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $key['nombre']?>"  required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>

                <div class="form-group">
                  <label for="horaInicio">Hora inicio</label>
                  <input type="time" name="horaInicio" placeholder="Hora" class="form-control" id="horaInicio" required="required" min="09:00:00" max="23:00:00" step="3600" value="<?php echo $key['horaInicio']?>">
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>

                <div class="form-group">
                  <label for="horaFin">Hora fin</label>
                  <input type="time" name="horaFin" placeholder="Hora" class="form-control" id="horaFin" required="required" min="09:00:00" max="23:00:00" step="3600" value="<?php echo $key['horaFin']?>">
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>


                <div class="form-group">
                  <label for="dias">Días</label>
                  <?php
                  $dias= explode(',',$key['dias']);
                  $checkLunes = $checkMartes = $checkMiercoles = $checkJueves = $checkViernes = $checkSabado = $checkDomingo = false;
                  for($i=0; $i < count($dias); $i++){
                    if ($dias[$i] == 0) $checkLunes = true;
                    if ($dias[$i] == 1) $checkMartes = true;
                    if ($dias[$i] == 2) $checkMiercoles = true;
                    if ($dias[$i] == 3) $checkJueves = true;
                    if ($dias[$i] == 4) $checkViernes = true;
                    if ($dias[$i] == 5) $checkSabado = true;
                    if ($dias[$i] == 6) $checkDomingo = true;

                  }
                  ?>

                    <div class="form-check">
                      <label class="form-check-label">
                        <?php
                        if ($checkLunes){
                          ?>
                          <input class="form-check-input" type="checkbox" value="0" name="listaDias[]" checked> Lunes
                          <?php
                        } else{
                          ?>
                          <input class="form-check-input" type="checkbox" value="0" name="listaDias[]"> Lunes
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <?php
                        if ($checkMartes){
                          ?>
                          <input class="form-check-input" type="checkbox" value="1" name="listaDias[]" checked> Martes
                          <?php
                        } else{
                          ?>
                          <input class="form-check-input" type="checkbox" value="1" name="listaDias[]"> Martes
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <?php
                        if ($checkMiercoles){
                          ?>
                          <input class="form-check-input" type="checkbox" value="2" name="listaDias[]" checked> Miércoles
                          <?php
                        } else{
                          ?>
                          <input class="form-check-input" type="checkbox" value="2" name="listaDias[]"> Miércoles
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <?php
                        if ($checkJueves){
                          ?>
                          <input class="form-check-input" type="checkbox" value="3" name="listaDias[]" checked> Jueves
                          <?php
                        } else{
                          ?>
                          <input class="form-check-input" type="checkbox" value="3" name="listaDias[]"> Jueves
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <?php
                        if ($checkViernes){
                          ?>
                          <input class="form-check-input" type="checkbox" value="4" name="listaDias[]" checked> Viernes
                          <?php
                        } else{
                          ?>
                          <input class="form-check-input" type="checkbox" value="4" name="listaDias[]"> Viernes
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <?php
                        if ($checkSabado){
                          ?>
                          <input class="form-check-input" type="checkbox" value="5" name="listaDias[]" checked> Sábado
                          <?php
                        } else{
                          ?>
                          <input class="form-check-input" type="checkbox" value="5" name="listaDias[]"> Sábado
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <?php
                        if ($checkDomingo){
                          ?>
                          <input class="form-check-input" type="checkbox" value="6" name="listaDias[]" checked> Domingo
                          <?php
                        } else{
                          ?>
                          <input class="form-check-input" type="checkbox" value="6" name="listaDias[]"> Domingo
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                    
                </div>



                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $key['precio']?>" required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>

                <!--input name="idRecinto" value="<?php echo $idRecinto?>" hidden-->

                <input name="idHorario" value="<?php echo $idHorario?>" hidden>
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