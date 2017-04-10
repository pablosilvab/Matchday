


<?php
include('layout/headerAdmin.php');


$recintos = $vars['recintos'];

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
                    <h1 class="page-header">Recintos  

                        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
                            Nuevo recinto
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>

                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

                <?php
                if (isset($vars['recintoAdmin'])){
                  if ($vars['recintoAdmin'] == 1){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El recinto ha sido desactivado.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 2){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El recinto ha sido activado.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 3){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> La información del recinto ha sido actualizada.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 4){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El recinto ha sido agregado exitosamente. Para activarlo agrega un horario en el botón 
                      <button type="button" class="btn btn-primary btn-sm " >
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </button>
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 5){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El horario del recinto ha sido agregado exitosamente.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 6){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El horario del recinto ha sido eliminado exitosamente.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 7){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El horario del recinto ha sido actualizado exitosamente.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 8){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El implemento del recinto ha sido agregado exitosamente.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 9){
                    ?>
                    <div class="alert alert-warning  alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El implemento del recinto ha sido eliminado exitosamente.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 10){
                    ?>
                    <div class="alert alert-warning  alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El implemento ha sido actualizado exitosamente.
                    </div>
                    <?php
                  }

                } 
                ?>

                <p><strong>Instrucciones: </strong>Para agregar un recinto, debes hacer click en botón <button type="button" class="btn btn-success btn-xs" >
                            Nuevo recinto
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>. Para agregar el horario de un recinto, debes hacer click en el botón 
                        <button type="button" class="btn btn-primary btn-xs" >
                                               
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </button>. Es importante que todo recinto que se agregue cuente con al menos un horario asociado.</p>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre </th>
                                        <th>Tipo</th>
                                        <th>Superficie</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($recintos as $key) {
                                        $idRecinto = $key['idRecinto'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombre']?></td>
                                        <td ><?php echo $key['tipo']?></td>
                                        <td ><?php echo $key['superficie']?></td>
                                        <td class="centrado">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <span class="label label-success col-xs-12">Activo</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 4){
                                                ?>
                                                <span class="label label-primary col-xs-12">¡Nuevo!</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 2 && $key['idUsuario'] != $idUsuario){
                                                ?>
                                                <span class="label label-warning col-xs-12">Notificado</span>
                                                <?php
                                            } else {
                                              if ($key['estado'] == 2){
                                                ?>
                                                <span class="label label-danger col-xs-12">Inactivo</span>
                                                <?php
                                            }

                                            }
                                            
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <form action="?controlador=Recinto&accion=cambiarEstadoRecinto" method="post">
                                                    <input name="idRecinto" value="<?php echo $idRecinto?>" hidden>
                                                    <input name="estado" value="2" hidden>
                                                    <button type="submit" class="btn btn-warning btn-sm col-xs-12"> 
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <form action="?controlador=Recinto&accion=cambiarEstadoRecinto" method="post">
                                                    <input name="idRecinto" value="<?php echo $idRecinto?>" hidden>
                                                    <input name="estado" value="1" hidden>
                                                    <button type="submit" class="btn btn-success btn-sm col-xs-12"> 
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                <?php
                                            }
                                            
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idRecinto?>','editar');">
                                                 
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idRecinto?>','horarios');">
                                               
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td  class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idRecinto?>','implementos');">
                                            
                                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
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
                <h4 class="modal-title" id="myModalLabel">Agrega un nuevo recinto</h4>
            </div>
            <div class="modal-body">     
              <form action="?controlador=Recinto&accion=agregarRecinto" method="post" enctype="multipart/form-data">
              <!--form  method="post" enctype="multipart/form-data" id="nuevoRecinto"-->
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                  <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small-->
                </div>
                <div class="form-group">
                  <label for="tipo">Tipo de recinto</label>
                  <select class="form-control" id="tipo" name="tipo" required>
                    <option value="" selected disabled>Selecciona el tipo de cancha</option>
                    <option value="Baby-futbol">Baby-fútbol</option>
                    <option value="Futbolito">Futbolito</option>
                    <option value="Futbol">Fútbol</option>
                  </select>
                  <small id="emailHelp" class="form-text text-muted">Selecciona si es una cancha de fútbol, futbolito o baby-fútbol</small>
                </div>
                <div class="form-group">
                  <label for="superficie">Superficie</label>
                  <input type="text" class="form-control" id="superficie" name="superficie" placeholder="Ejemplo: Pasto sintético, cemento, etc." required>
                </div>
                <div class="form-group">
                  <label for="direccion">Dirección</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                  <label for="fotografia">Fotografía</label>
                  <input type="file" class="form-control-file" id="imagen" name="imagen" aria-describedby="fileHelp" required>
                </div>


                <!--div class="form-group">
                  <label for="tipo">Estado inicial</label>
                  <select class="form-control" id="estado" name="estado" required>
                    <option value="" selected disabled>Selecciona el estado inicial de la cancha</option>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                  <small id="emailHelp" class="form-text text-muted">Si seleccionas estado activo, quedará visible para todos los jugadores de MatchDay, de
                    lo contrario, podrás activarlo más adelante.</small>
                </div-->
                <small id="emailHelp" class="form-text text-muted">Este recinto se inicializará como inactivo,
                  luego de ingresar un horario podrás activar el recinto para ser visto por los 
                  usuarios de MatchDay.</small>
                <div class="row modal-footer">
                  <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary col-xs-12">Siguiente <i class="fa fa-plus-circle fa-1x" aria-hidden="true"></i></button>
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





<script type="text/javascript">
  
  $(document).ready(function () {

    $('#openBtn').click(function () {
        $('#myModal').modal({
            show: true
        })
    });

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });


});
</script>






<script>
 
function carga_ajax(div, id, tipo){

  if (tipo == 'editar'){
    $.post(
      '?controlador=Recinto&accion=editarRecinto&idRecinto='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }


  if (tipo == 'implementos'){
    $.post(
      '?controlador=Recinto&accion=verImplementos&idRecinto='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }

  if (tipo == 'horarios'){
    $.post(
      '?controlador=Recinto&accion=verHorarios&idRecinto='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
  }



}
</script>


