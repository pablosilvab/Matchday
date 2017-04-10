<style type="text/css">
  .izquierda{
    text-align: left; 
  }
</style>


<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">¡Encuentro acordado!</h4>
      </div>
      <?php
      $encuentro = $vars['encuentro'];
      $horarios = $vars['horarios'];
      ?>
      <div class="modal-body">
          <?php
            foreach ($encuentro as $item) {
              $idRecinto = $item['idRecinto'];
              $idEncuentro = $item['idEncuentro'];
              $idCapitan = $item['idOrganizador'];
              $idEquipo1 = $item['idEquipo1'];
              $idEquipo2 = $item['idEquipo2'];
              $idDesafio = $item['idDesafio'];
            ?>
        <h4 class="modal-title"><?php echo $item['equipo2']." v/s ".$item['equipo1']?></h4>
        <br/>
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <h6 class="texto-modal-negro">Cancha: <?php echo $item['nombreRecinto']?></h6>
              <img style="-webkit-border-radius: 21px; -moz-border-radius: 21px; border-radius: 21px;" 
              src="assets/images/recintos/<?php echo $item['fotoRecinto'];?>"  class="img-responsive" alt="">
            </div>
            <div class="col-xs-12 col-sm-8">
              <div class="table-responsive">

                <table class="table">
                  <tr>
                    <th width='25%'>Fecha</th>
                    <td width='75%'><?php echo $item['fechaPartido']?></td>
                  </tr>
                  <tr>
                    <th>Tipo de partido</th>
                    <td><?php 
                    $tipoPartido = $item['tipoPartido'];
                    echo $tipoPartido;
                    ?></td>
                  </tr>
                  <tr>
                    <th>Tu comentario</th>
                    <td><?php echo $item['comentario']?></td>
                  </tr>
                  <tr>
                    <th>Comentario del rival:</th>
                    <td><?php echo $item['respuesta']?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
      </div>


      <div class="modal-body">
        <h6 class="texto-modal-negro">Para agendar el partido, completa los siguientes campos. A veces los comentarios de los 
          rivales son de vital importancia para agendar el partido.</h6>
          <form id="demoform" action="?controlador=Partido&accion=agendarDesafio" method="post" class="design-form">
            <input type="text" name="idUsuario" value="<?php echo $idCapitan?>" hidden/>
            <input type="text" name="desafio" value="<?php echo $idDesafio?>" hidden/>
            <input type="text" name="rival" value="<?php echo $idEquipo1?>" hidden/>
            <input type="text" name="idEncuentro" value="<?php echo $idEncuentro?>" hidden/>


            <div class="form-group">
              <label class="texto-modal-negro izquierda" for="idHorario">Horario</label>
              <select  class="form-control"  onchange="cargarInput(this);">
                <option selected disabled value="">Selecciona un horario</option>
                <?php
                foreach ($horarios as $key ) {
                  ?>
                  <option value="<?php echo $key['idHorario']."-".$key['HI']."-".$key['HF']?>" >
                    <?php echo "<b>".$key['nombre']."</b>: ".$key['horaInicio']." - ".$key['horaFin']?>
                  </option>
                  <?php
                  }
                  ?>
              </select>
            </div>
            <div class="form-group">
              <label class="texto-modal-negro izquierda" for="hora">Selecciona la hora : </label>
              <input disabled="disabled" id="horas" type="time" name="hora" placeholder="Hora" class="form-control" required step="3600">
              <input id="idHorario" name="idHorario" hidden>
              <small>Solo podrás seleccionar horarios dentro del bloque seleccionado</small>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
              <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </form>
    </div>
  </div>
</dvi>

<script>
var cargarInput = function(x){
  $('#horas').removeAttr('disabled');
  var resp = x.value;
  var del = resp.split("-");
  var input = document.getElementById("horas");
  input.setAttribute("min", del[1]);
  input.setAttribute("max", del[2]);
  var input2 = document.getElementById("idHorario");
  input2.setAttribute("value",del[0]);

  /*
  alert(del[1]);
  alert(del[2]);
  //document.getElementById("demo").innerHTML = res;
  //$('$horas').setAttribute("min", this.value);
  alert("El valor: "+x.value+" y el texto: "+x.options[x.selectedIndex].text);*/
}
</script>