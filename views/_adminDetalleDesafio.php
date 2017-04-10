<?php
$idDesafio = $vars['idDesafio'];
$estado = $vars['estado'];
?>
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title">Detalle del desafío</h3>
    </div>
    <?php
    $desafio = $vars['desafio'];
    foreach ($desafio as $key) {
    ?>
    <div class="modal-body">
      <table class="table">
        <tr>
          <th width='20%'>Enviado por: </th>
          <td><?php echo $key['nombreEquipo']?></td>
        </tr>
        <tr>
          <th>Capitán: </th>
          <td><?php echo $key['nombre']." ".$key['apellido']?></td>
        </tr>
        <tr>
          <th>Recinto: </th>
          <td><?php echo $key['nombreRecinto']?></td>
        </tr>
        <tr>
          <th>Comentario: </th>
          <td><?php echo $key['comentario']?></td>
        </tr>
        <tr>
          <th>Fecha: </th>
          <td><?php echo $key['fechaPartido']?></td>
        </tr>
        <tr>
          <th>Estado: </th>
          <td>
            <?php 
            if ($estado == 0){
              echo "Sin respuestas";
            }
            if ($estado == 1){
              echo "Con respuestas";
            }
            if ($estado == 2){
              echo "Aceptado";
            }
            if ($estado == 3){
              echo "Agendado";
            }
            if ($estado == 4){
              echo "No contestado";
            }
            ?>
          </td>
        </tr>
        <?php
        if ($estado == 3){
          $encuentro = $vars['encuentro'];
          foreach ($encuentro as $item) {
            ?>
            <tr>
              <th>Rival</th>
              <td><?php echo $item['nombreEquipo2']?></td>
            </tr>
            <?php
          }
        }
        ?>
      </table>
    </div>
    <?php
    }
    ?>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
    </div>
  </div>
</div>