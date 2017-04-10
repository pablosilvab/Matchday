


<?php
include('layout/headerAdmin.php');


$locales = $vars['locales'];

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
                    <h1 class="page-header">Locales 
                        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
                            Nuevo local
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

                <?php
                if (isset($vars['localAdmin'])){
                  if ($vars['localAdmin'] == 1){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El local ha sido dessactivado.
                    </div>
                    <?php
                  }
                  if ($vars['localAdmin'] == 2){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El local ha sido activado.
                    </div>
                    <?php
                  }
                  if ($vars['localAdmin'] == 3){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> La información del local ha sido actualizada.
                    </div>
                    <?php
                  }
                  if ($vars['localAdmin'] == 4){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El local ha sido agregado exitosamente.
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
                                        <th>Descripción</th>
                                        <th>Dirección</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($locales as $key) {
                                        $idLocal = $key['idLocal'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombre']?></td>
                                        <td><?php echo $key['descripcion']?></td>
                                        <td><?php echo $key['direccion']?></td>
                                        <td class="centrado">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <span class="label label-success col-xs-12">Activo</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <span class="label label-danger col-xs-12">Inactivo</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <form action="?controlador=Local&accion=cambiarEstadoLocal" method="post">
                                                    <input name="idLocal" value="<?php echo $idLocal?>" hidden>
                                                    <input name="estado" value="2" hidden>
                                                    <button type="submit" class="btn btn-warning btn-sm col-xs-12">Desactivar 
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <form action="?controlador=Local&accion=cambiarEstadoLocal" method="post">
                                                    <input name="idLocal" value="<?php echo $idLocal?>" hidden>
                                                    <input name="estado" value="1" hidden>
                                                    <button type="submit" class="btn btn-success btn-sm col-xs-12">Activar 
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idLocal?>','editar');">
                                                Editar
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agrega un nuevo local</h4>
            </div>
            <div class="modal-body">     
              <form action="?controlador=Local&accion=agregarLocal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>
                <div class="form-group">
                  <label for="superficie">Descripción</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                  <small id="emailHelp" class="form-text text-muted">Indica si el local es un pub, restaurante, restobar, etc.</small>
                </div>
                <div class="form-group">
                  <label for="direccion">Dirección</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                  <label for="fotografia">Fotografía</label>
                  <input type="file" class="form-control-file" id="imagen" name="imagen" aria-describedby="fileHelp" required>
                </div>
                <div class="form-group">
                  <label for="tipo">Estado inicial</label>
                  <select class="form-control" id="estado" name="estado" required>
                    <option value="" selected disabled>Selecciona el estado inicial del local</option>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                  <small id="emailHelp" class="form-text text-muted">Si seleccionas estado activo, quedará visible para todos los jugadores de MatchDay, de
                    lo contrario, podrás activarlo más adelante.</small>
                </div>

                <div class="row modal-footer">
                  <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary col-xs-12">Agregar <i class="fa fa-plus-circle fa-1x" aria-hidden="true"></i></button>
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
 
function carga_ajax(div, id, tipo){

  if (tipo == 'editar'){
    $.post(
      '?controlador=Local&accion=editarLocal&idLocal='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }
}
</script>