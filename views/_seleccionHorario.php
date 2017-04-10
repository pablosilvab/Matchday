<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Horarios y tarifas</h4>
      </div>
      <div class="modal-body">
      <?php     if(count($vars['horarios'])!=0){ ?>
      <table id="tablaHorarios" class="table bootstrap-datatable table-striped label-partido">
<thead>
        <tr>
            <th>Nombre</th>
            <th>Horas</th>
            <th>Dias</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($vars['horarios'] as $horario){?>
        <tr>
            <td><?php echo $horario['nombre']?></td>
            <td><?php echo $horario['horaInicio']."-".$horario['horaFin'];?></td>
            <!-- Para los dias hay que hacer una especie de if para que los vaya sumado y los vaya mostrando-->
            <td><?php
                $dias= explode(',',$horario['dias']);
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

            ?></td>
            <!-- Habria que ver la forma de mostrar el dinero el "formato"-->
            <td><?php echo $horario['precio']?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    <?php }else{
    ?>
    <h2 class="label-partido">No existen Horarios asociados</h2>
    <?php }

    ?>
      </div>
      
    </div>
 </div>