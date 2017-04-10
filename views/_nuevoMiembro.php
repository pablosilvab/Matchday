<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <?php 
        $equipos = $vars['equipos'];
        ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar jugador</h4>
      </div>
      
      <div class="modal-body">
        <h4 class="modal-title">
          <?php
          if (empty($equipos)){
            echo "Este jugador está en todos tu equipos.";
          } else {
            echo "Elige uno de tus equipos para agregar al jugador.";
          
          ?>
        </h4>
        <br/>
        <div class="container-fluid">
            <form id="demoform" action="?controlador=Contacto&accion=agregarMiembro" method="post">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="texto-modal-negro" for="equipo">Equipo : </label>
                      <select class="form-control" name="equipo" required>
                            <option value="" selected disabled>Selecciona uno de tus equipos</option>
                            <?php
                            foreach($equipos as $item){
                            ?>
                            <option  value="<?php echo $item['idEquipo']?>" class="texto-modal-negro">
                                <?php echo $item['nombre']?>
                            </option>
                            <?php
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check-circle" aria-hidden="true"></i></button>
              </form>
            </div>
        </div>


      <?php
      }
      if (empty($equipos)){
        ?>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
        </div>
        <?php
      }
      ?>
      </div>
    </div>
  </div>