


<?php
include('layout/headerAdmin.php');

$desafios = $vars['desafios'];


?>



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



<!-- DataTables CSS -->
<link href="assets/assetsAdmin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="assets/assetsAdmin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">


        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Desafíos 
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width='15%'>Equipo </th>
                                        <th width='15%'>Recinto</th>
                                        <th width='50%'>Comentario</th>
                                        <th width='10%'>Estado</th>
                                        <th width='10%'></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($desafios as $key) {
                                        $idDesafio = $key['idDesafio'];
                                        $estado = $key['estado'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombreEquipo']?></td>
                                        <td><?php echo $key['nombreRecinto']?></td>
                                        <td><?php echo $key['comentario']?></td>
                                        <td class="centrado">
                                            <?php
                                            if ($estado == 0){
                                                ?>
                                                <span class="label label-danger col-xs-12">Esperando respuestas</span>
                                                <?php
                                            } 
                                            if ($estado == 1){
                                                ?>
                                                <span class="label label-warning col-xs-12">Con respuestas</span>
                                                <?php
                                            }
                                            if ($estado == 2){
                                                ?>
                                                <span class="label label-success col-xs-12">Aceptado</span>
                                                <?php
                                            }
                                            if ($estado == 3){
                                                ?>
                                                <span class="label label-info col-xs-12">Agendado</span>
                                                <?php
                                            }
                                            if ($estado == 4){
                                                ?>
                                                <span class="label label-default col-xs-12">No contestado</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idDesafio?>','<?php echo $estado?>');">
                                            Más información 
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->



<?php
include('layout/footerAdmin.php');

?>

    <!-- DataTables JavaScript -->
    <script src="assets/assetsAdmin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/assetsAdmin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="assets/assetsAdmin/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
                          "language": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }


              }
        });
    });
    </script>


<script>
 
function carga_ajax(div, id, tipo){

  //if (tipo == "0"){
    $.post(
      '?controlador=Desafio&accion=detalleDesafioAdmin&idDesafio='+id+'&estado='+tipo,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  //}


}
</script>