<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Implementos</h4>
      </div>
      <div class="modal-body">
      <?php     if(count($vars['implementos'])!=0){ ?>
      <table id="implementos" class="table bootstrap-datatable table-striped label-partido">
    <thead>
        <tr id="color-encabezado">
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
    <?php
     foreach($vars['implementos'] as $implemento){ ?>
        <tr>
            <td><?php 
            echo $implemento['nombre'];

            ?></td>
            <td><?php 
			setlocale(LC_MONETARY, 'es_CL');
			echo money_format('%.0n', $implemento['precio']) . "\n";

            ?></td>
        </tr>
    <?php }


     ?>
    </tbody>
</table>
	<?php }else{
	?>
	<h2 class="label-partido">No existen implementos</h2>
	<?php }

	?>
      </div>
      
    </div>
  </div>

        <script type="text/javascript">
          $(document).ready(function() {
            $('#implementos').DataTable();
        } );
        </script>