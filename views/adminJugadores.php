


<?php
include('layout/headerAdmin.php');


$jugadores = $vars['jugadores'];
$arrayEdades = $vars['edades'];

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
                    <h1 class="page-header">Jugadores 

                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

                <?php
                if (isset($vars['accionAdmin'])){
                  if ($vars['accionAdmin'] == 1){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El jugador ha sido inhabilitado.
                    </div>
                    <?php
                  }
                  if ($vars['accionAdmin'] == 2){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El jugador ha sido habilitado.
                    </div>
                    <?php
                  }
                }
                ?>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre </th>
                                        <th>Mail</th>
                                        <th>Teléfono</th>
                                        <th>Edad</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($jugadores as $key) {
                                        $idJugador = $key['idUsuario'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombre']." ".$key['apellido']?></td>
                                        <td><?php echo $key['mail']?></td>
                                        <td><?php echo $key['telefono']?></td>
                                        <td>
                                            <?php
                                            echo $arrayEdades[$i];
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <span class="label label-success col-xs-12">Habilitado</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <span class="label label-danger col-xs-12">Deshabilitado</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 3){
                                                ?>
                                                <span class="label label-warning col-xs-12">Invitado</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <form action="?controlador=Usuario&accion=cambiarEstado" method="post">
                                                    <input name="idJugador" value="<?php echo $idJugador?>" hidden>
                                                    <input name="estado" value="2" hidden>
                                                    <button type="submit" class="btn btn-warning btn-sm col-xs-12">Inhabilitar 
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <form action="?controlador=Usuario&accion=cambiarEstado" method="post">
                                                    <input name="idJugador" value="<?php echo $idJugador?>" hidden>
                                                    <input name="estado" value="1" hidden>
                                                    <button type="submit" class="btn btn-success btn-sm col-xs-12">Habilitar 
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                <?php
                                            }
                                            if ($key['estado'] == 3){
                                                ?>
                                                <button type="button" class="btn btn-success btn-sm col-xs-12">Invitar</button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idJugador?>','jugador');">
                                            Ver información 
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
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

  if (tipo == 'jugador'){
    $.post(
      '?controlador=Usuario&accion=detalleJugador&idJugador='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }
}
</script>