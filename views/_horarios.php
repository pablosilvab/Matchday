<div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Horarios y tarifas</h4>
      </div>
      <div class="modal-body">
      <?php     if(count($vars['horarios'])!=0){ ?>
      <table id="tablaHorarios"  class="table bootstrap-datatable table-striped label-partido">
<thead>
		<tr id="color-encabezado">
			<th>Nombre</th>
			<th>Horas</th>
			<th>Dias</th>
			<th>Precio</th>
			<?php
				if(isset($vars['form'])){ ?>
				<th></th>
			<?php }
			?>
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
			<td><?php 

			setlocale(LC_MONETARY, 'es_CL');
			echo money_format('%.0n', $horario['precio']) . "\n";
			
			?></td>
			<?php
				if(isset($vars['form'])){ ?>
			<td><button data-dismiss="modal" data-inicio="<?php echo $horario['HI']?>" data-final="<?php echo $horario['HF']?>" data-nombre="<?php echo $horario['nombre']?>" data-id="<?php echo $horario['idHorario']?>" class="btn btn-primary btn-sm selHorario"  data-m="<?php echo $vars['form']?>">Elegir</button></td>

			<?php }	?>		
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
         <script type="text/javascript">

         $('.selHorario').click(function (e){
            e.preventDefault();
            var idHorario;
            var nombre;
            var modal;
            var inicio;
            var final;
            idHorario = $(this).data('id');
            nombre = $(this).data('nombre');
            modal = $(this).data('m');
            inicio = $(this).data('inicio');
            final = $(this).data('final');
            document.getElementById("horario"+modal).setAttribute("value", idHorario);
            document.getElementById("horario"+modal).innerHTML=nombre;
            document.getElementById('horario'+modal).selectedIndex = 0;
			document.getElementById("horaPartido"+modal).setAttribute("min", inicio);
			document.getElementById("horaPartido"+modal).setAttribute("max", final);

           




  


        });
        </script>
