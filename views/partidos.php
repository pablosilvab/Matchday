
<?php

include('layout/headerJugador.php');



?>



<link href="assets/css/profile.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/slider.css">



<?php

// Recibir información de los partidos Pendientes como organizador
/*
$partidosPendientes = $vars['partidosPendientes'];
$nroPartidosPendientes = count($partidosPendientes);
*/


$partidosUsuario = $vars['partidosUsuario'];
$nroPartidosUsuario = count($partidosUsuario);


$partidosSistema = $vars['partidosSistema'];
$nroPartidosSistema = count($partidosSistema);


$partidosInvitado = $vars['partidosInvitado'];
$nroPartidosInvitado = count($partidosInvitado);

$proximosPartidos = $vars['proximosPartidosUsuario'];


?>







<!--Calendario-->
<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='assets/js/moment.min.js'></script>
<script src='assets/js/fullcalendar.min.js'></script>
<script src="assets/lang-all.js"></script>
<script src="assets/js/es.js"></script>



<script>
  $(document).ready(function() {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1; //hoy es 0!
    var yyyy = hoy.getFullYear();

    if(dd<10) {
      dd='0'+dd
    }

    if(mm<10) {
      mm='0'+mm
    }

    hoy = mm+'-'+dd+'-'+yyyy;

    $('#calendar1').fullCalendar({
      lang: 'es',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },

      defaultDate: hoy,
      editable: false,
      eventLimit: true, // allow "more" link when too many events

      // Partidos
      events: [
      <?php foreach ($proximosPartidos as $key ) {
        ?>
        {
          title: '<?php echo $key['nombreRecinto']." ".$key['horaPartido']?>',
          start: '<?php echo $key['fecha']?>',
          description: '<?php echo $key['idPartido']?>',
          id: '<?php echo $key['estadoInvitacion']?>',
          <?php
          if ($key['estadoPartido'] == 1){
            ?>
            backgroundColor: '#449d44'
            <?php
          }
          if ($key['estadoPartido'] == 4){
            ?>
            backgroundColor: '#c9302c'
            <?php
          }
          if ($key['estadoPartido'] == 5){
            ?>
            backgroundColor: '#ec971f'
            <?php
          }
          ?>
        },
        <?php 

      }
      ?>
      ],


      eventClick:  function(event, jsEvent, view) {

        $.post(
          '?controlador=Partido&accion=verResumenProximoPartido&idPartido='+event.description+'&invitacion='+event.id,
          function(resp){
            $("#modal").html(resp);
            $("#modal").modal("toggle");
          }
          ); 
          //carga_ajax7('modal', event.description);

          /*
            $('#modalTitle').html(event.title);
            $('#modalBody').html(event.description);
            $('#eventUrl').attr('href',event.url);
            $('#fullCalModal').modal();
            */
            //alert(event.id);
          }



        });
  });
</script>


<!--script type="text/javascript">
     $(document).on('click','.fc-event-container' ,function(e){
        e.preventDefault();
        alert("hice click");
        var contenido = this.lastChild.lastChild.lastChild.innerHTML;
        alert(contenido);
        //pasar contenido a array y tomar lo primero
});
</script-->

<!--/Calendario -->









<!-- DATATABLE -->
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>

<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/dataTables.responsive.min.js"></script>



<div id="fullCalModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        <h4 id="modalTitle" class="modal-title"></h4>
      </div>
      <div id="modalBody" class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>
      </div>
    </div>
  </div>
</div>


<!--MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando ...</h4>
      </div>
      <div class="modal-body" id="modalBody">
        <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
        <h4>Espere por favor ... </h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->










<div class="modal fade" id="modalCancelar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">¡Atención!</h4>
      </div>
      <div class="modal-body" id="modalBody">
      <div class="alert alert-danger">
                <strong>Error!</strong> No puedes cancelar un partido proveniente  de un desafío.
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
</div>







<!-- Inicio Pagina -->


<div id="contact-us" class="parallax">
  <div class="container">

    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Partidos</li>
    </ol>


    <div class="page-header">
      <h2> Partidos <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
    </div>

    <?php
    if (isset($vars['accion'])){
      if ($vars['accion'] == 9){
        ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Bien hecho!</strong> Tu solicitud ha sido enviada al capitán.
        </div>
        <?php
      }
      if ($vars['accion'] == 1){
        ?>
        <div class="alert alert-warning alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu partido ha sido cancelado.
        </div>
        <?php
      }
      if ($vars['accion'] == 2){
        ?>
        <div class="alert alert-info alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Excelente!</strong> Tienes un partido MatchDay, los jugadores podrán solicitar unirse a tu partido.
        </div>
        <?php
      }
      if ($vars['accion'] == 4){
        ?>
        <div class="alert alert-info alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu respuesta ha sido enviada al jugador exitosamente. 
        </div>
        <?php
      }
      if ($vars['accion'] == 5){
        ?>
        <div class="alert alert-warning alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu respuesta ha sido enviada al organizador del partido. 
        </div>
        <?php
      }
      if ($vars['accion'] == 6){
        ?>
        <div class="alert alert-info alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu respuesta ha sido enviada al organizador del partido. 
        </div>
        <?php
      }
    }
    ?>

    <div class="container">

      <ul class="nav nav-tabs nav-justified">
        <li><a data-toggle="tab" href="#menu1">Partidos Matchday <span class="label label-success"><?php echo $nroPartidosSistema?></span></a></li>
        <li  class="active"><a data-toggle="tab" href="#menu2">Mis partidos <span class="label label-info"><?php echo $nroPartidosUsuario?></span></a></li>
        <li><a data-toggle="tab" href="#menu3">Invitaciones <span class="label label-warning"><?php echo $nroPartidosInvitado?></span> </a></li>
      </ul>

      <div class="tab-content">







        <div id="menu1" class="tab-pane fade ">

          <?php
          if ( $nroPartidosSistema == 0){
            ?>
            <br>
            <div class="alert alert-warning">
              <strong>Lo sentimos!</strong> Actualmente no hay partidos disponibles en MatchDay. Inténtalo más tarde.
            </div>
            <?php
          } else {
            if ($nroPartidosSistema == 1){
              $msg1 = "partido disponible";
            } else {
              $msg1 = "partidos disponibles";
            }
            ?>
            <!-- TABLA DE Partidos Sistema -->
            <br>
            <div class="alert alert-success">
              <strong>Atención!</strong> Hay <?php echo $nroPartidosSistema." ".$msg1 ?> para ti.
              Puedes enviar una solicitud para unirte a un partido haciendo click en el botón
              <button type="button" class="btn btn-primary btn-xs">Unirse <i class="fa fa-exclamation-circle" aria-hidden="true"></i></button>.
            </div>
            <div class="col-md-12">
              <!--div class="table-responsive"-->
              <table id="example2" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">

                    <th id="encabezado-especial">Organizador</th>
                    <th id="encabezado-especial">Fecha</th>
                    <th id="encabezado-especial">Hora</th>
                    <th id="encabezado-especial">Recinto</th>
                    <th id="encabezado-especial">Estado</th>
                    <th id="encabezado-especial"></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($partidosSistema as $item) {
                    $idPartidoSistema = $item['idPartido1'];
                    $estadoSolicitud = $item['estadoSolicitud'];
                    ?>
                    <tr>
                      <td>
                        <?php
                        echo $item['nombreCap']." ".$item['apellidoCap'];
                        ?>
                      </td>
                      <td>
                        <?php 
                        echo $item['fechaPartido']?>
                      </td>
                      <td>
                        <?php echo $item['horaPartido']?>
                      </td>
                      <td>
                        <?php echo $item['nombre']?>
                      </td>
                      <td>
                       <?php
                       if ($estadoSolicitud == 1){
                        ?>
                        <span class="label label-success">Solicitud aceptada <i class="fa fa-smile-o" aria-hidden="true"></i></span>   
                        <?php
                      }
                      if ($estadoSolicitud == 2){
                        ?>
                        <span class="label label-warning">Esperando respuesta capitán <i class="fa fa-clock-o" aria-hidden="true"></i></span>   
                        <?php
                      }
                      if ($estadoSolicitud == null){
                       ?>
                       <span class="label label-primary">¡Únete a este partido! <i class="fa fa-reply" aria-hidden="true"></i></span>   
                       <?php
                     }
                     if ($estadoSolicitud == 3){
                       ?>
                       <span class="label label-danger">Solicitd rechazada <i class="fa fa-reply" aria-hidden="true"></i></span>   
                       <?php
                     }
                     ?>
                   </td>
                   <td>
                    <?php
                    if ($estadoSolicitud == 1){
                      ?>
                      <button type="button" class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                      onclick="carga_ajax1('modal','<?php echo $idPartidoSistema?>','resumen');">
                      Ver resumen 
                      <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </button>   
                    <?php
                  }
                  if ($estadoSolicitud == 2){
                    ?>
                    <button type="button" class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                    onclick="carga_ajax1('modal','<?php echo $idPartidoSistema?>','resumen');">
                    Ver resumen 
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                  </button>   
                  <?php
                }
                if ($estadoSolicitud == null){
                 ?>
                 <button type="button" class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                 onclick="carga_ajax1('modal','<?php echo $idPartidoSistema; ?>','solicitud');">
                 Unirse 
                 <i class="fa fa-paper-plane" aria-hidden="true"></i>
               </button>  
               <?php
             }
             if ($estadoSolicitud == 3){
               ?>
               <button type="button" class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
               onclick="carga_ajax1('modal','<?php echo $idPartidoSistema; ?>','solicitud');">
               Reintentar
               <i class="fa fa-paper-plane" aria-hidden="true"></i>
             </button>  
             <?php
           }
           ?>

         </td>
       </tr>
       <?php
     }
     ?>
   </tbody>
 </table>
 <!--/div-->
</div>
<!-- /TABLA DE PARTIDOS Sistema -->



<script type="text/javascript">
  $(document).ready(function() {
    $('#example2').DataTable({
      responsive: true,
      "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_",
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


<?php
}
?>
</div>







<div id="menu2" class="tab-pane fade in active">

  <?php
  if ($nroPartidosUsuario == 0){
    ?>
    <br>
    <div class="alert alert-danger">
      <strong>Atención!</strong> No tienes partidos en MatchDay. Accede a la opción "Jugar" y disfruta de esta experiencia.
    </div>
    <?php
  } else {
    ?>
    <!-- TABLA DE Partidos Pendientes -->
    <br>

    <div class="col-md-12">
      <!--div class="table-responsive"-->
      <table id="example" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
        <thead id ="position-table">
          <tr id="color-encabezado">

            <th id="encabezado-especial">Fecha</th>
            <th id="encabezado-especial">Hora</th>
            <th id="encabezado-especial">Recinto</th>
            <th id="encabezado-especial">Estado</th>
            <th id="encabezado-especial"></th>
            <th id="encabezado-especial"></th>
            <th id="encabezado-especial"></th>
          </tr>
        </thead>
        <tbody id="texto-contactos" class="center">
          <?php
          foreach ($partidosUsuario as $item) {
            $idPartido = $item['idPartido'];
            $fecha = $item['fechaPartido'];
            $hora = $item['horaPartido'];
            $recinto = $item['nombre'];
            $estado = $item['estado'];
            $tipoPartido = $item['tipoPartido'];
            ?>
            <tr>

              <td width='15%'>
                <?php echo $fecha?>
              </td>
              <td width='15%'>
                <?php echo $hora?>
              </td>
              <td width='15%'>
                <?php echo $recinto?>
              </td>
              <td width='15%'>
                <?php
                if ($estado == 1){
                  ?>
                  <span class="label label-info">Activo <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                  <?php
                }
                ?>
                <?php
                if ($estado == 4){
                  ?>
                  <span class="label label-danger">Pendiente <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>                        
                  <?php
                }
                ?>
                <?php
                if ($estado == 5){
                  ?>
                  <span class="label label-warning">MatchDay <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                  <?php
                }
                ?>
              </td>
              <?php
              if ($estado == 1){
                ?>
                <td>
                  <?php
                  if ($tipoPartido == 4){
                    ?>
                    <!--a href="#" data-toggle="tooltip" data-placement="top" title="No puedes cancelar un desafio agendado!">
                      <button type="button" class="btn btn-danger">
                        Cancelar 
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                      </button>  
                    </a-->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCancelar" >Cancelar</button>
                    
                    <?php
                  } else {
                    ?>
                    <button type="button" class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                    onclick="carga_ajax2('modal','<?php echo $idPartido?>','cancelar');">
                    Cancelar 
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                  </button>
                  <?php
                }
              
              ?>
            </td>
            <td>
              <button type="button" class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
              onclick="carga_ajax1('modal','<?php echo $idPartido?>','resumen');">
              Ver resumen 
              <i class="fa fa-info-circle" aria-hidden="true"></i>
            </button>
          </td>

          <?php
        }
        ?>
        <?php
        if ($estado == 4){
          ?>
          <td>
            <button type="button" class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
            onclick="carga_ajax2('modal','<?php echo $idPartido?>','cancelar');">
            Cancelar 
            <i class="fa fa-times-circle" aria-hidden="true"></i>
          </button>
        </td>
        <td>
          <button type="button" class="btn btn-success" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
          onclick="carga_ajax3('modal','<?php echo $idPartido?>','notificar');">
          Notificar 
          <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
        </button>
      </td>

      <?php
    }
    ?>
    <?php
    if ($estado == 5){
      ?>
      <td>
        <button type="button" class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
        onclick="carga_ajax2('modal','<?php echo $idPartido?>','cancelar');">
        Cancelar 
        <i class="fa fa-times-circle" aria-hidden="true"></i>
      </button>
    </td>
    <td>
      <button type="button" class="btn btn-warning" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
      onclick="carga_ajax4('modal','<?php echo $idPartido?>','respuestas');">
      Ver respuestas 
      <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
    </button>
  </td>


  <?php
}
?>

<td>
  <button type="button" class="btn btn-info" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
  onclick="carga_ajax5('modal','<?php echo $idPartido?>');">
  <i class="fa fa-users" aria-hidden="true"></i>
</button>
</td>

</tr>
<?php
}
?>
</tbody>
</table>
<!--/div-->
</div>
<!-- /TABLA DE PARTIDOS Pendientes -->



<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable({
      responsive: true,
      "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_ ",
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
  } );


</script>
<?php
}
?>


</div>


<div id="menu3" class="tab-pane fade">


  <?php
  if ($nroPartidosInvitado == 0){
    ?>
    <br>
    <div class="alert alert-danger">
      <strong>Lo sentimos!</strong> No te han invitado a ningún partido <i class="fa fa-frown-o" aria-hidden="true"></i>.
      Accede a la opción "Jugar" y disfruta de esta experiencia.
    </div>
    <?php
  } else {
    ?>
    <!-- TABLA DE Partidos Pendientes -->
    <br>

    <div class="col-md-12">
      <!--div class="table-responsive"-->
      <table id="example3" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
        <thead id ="position-table">
          <tr id="color-encabezado">

            <th id="encabezado-especial">Capitan</th>
            <th id="encabezado-especial">Fecha</th>
            <th id="encabezado-especial">Hora</th>
            <th id="encabezado-especial">Recinto</th>
            <th id="encabezado-especial">Tu respuesta</th>
          </tr>
        </thead>
        <tbody id="texto-contactos" class="center">
          <?php
          foreach ($partidosInvitado as $item) {
            $idPartido = $item['idPartido'];
            $fecha = $item['fecha'];
            $hora = $item['horaPartido'];
            $recinto = $item['nombreRecinto'];
            $estado = $item['estadoInvitacion'];
            $capitan = $item['nombreCap']." ".$item['apellidoCap'];
            ?>
            <tr>

              <td>
                <?php echo $capitan?>
              </td>
              <td>
                <?php echo $fecha?>
              </td>
              <td>
                <?php echo $hora?>
              </td>
              <td>
                <?php echo $recinto?>
              </td>
              <td>
                <?php
                if ($estado == 0){
                  ?>
                  <button type="button" class="btn btn-warning btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                  onclick="carga_ajax6('modal','<?php echo $idPartido?>');">
                  Aún no respondes
                  <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                </button>  
                <?php
              }
              if ($estado == 1){
                ?>
                <button type="button" class="btn btn-success btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                onclick="carga_ajax7('modal','<?php echo $idPartido?>');">
                Confirmado
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
              </button>     
              <?php
            }
            if ($estado == 2){
              ?>
              <button type="button" class="btn btn-danger btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
              onclick="carga_ajax7('modal','<?php echo $idPartido?>');">
              Descartado
              <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </button>  
            <?php
          }
          ?>
        </td>                    

      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<!--/div-->
</div>
<!-- /TABLA DE PARTIDOS Pendientes -->



<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      responsive: true,
      "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_ ",
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
  } );


</script>
<?php
}
?>

</div>





</div>
</div>



<div class="page-header">
  <h3> Próximos partidos <i class="fa fa-futbol-o" aria-hidden="true"></i> </h3>
</div>

<div class="container">
  <style>
    #calendar1 {
      max-width: 800px;
      margin: 0 auto;
      color: #000;
      font-size: 14px;
    }

    .fc-unthemed .fc-today{
      background-color: #a4c5f9;
    }
  </style>
  <br/>

  <div class="jumbotron my-back">
    <div id="calendar1"></div>  

    <hr/>
    <table class="table table-striped table-hover display responsive nowrap">
      <thead id ="position-table">
        <tr id="color-encabezado">
          <th id="encabezado-especial">Estado</th>
          <th id="encabezado-especial"></th>
        </tr>
      </thead>
      <tbody id="texto-contactos" class="center">
        <tr>
          <td><span class="label label-success">Cancha - Hora</span> </td>
          <td>Partido activo</td>
        </tr>
        <tr>
          <td><span class="label label-warning">Cancha - Hora</span> </td>
          <td>Partido MatchDay</td>
        </tr>
        <tr>
          <td><span class="label label-danger">Cancha - Hora</span> </td>
          <td>Partido pendiente</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>




</div>
</div>


<!-- Fin Pagina -->


<!-- DATEPICKER-->
<script>
  $(document).ready(function(){
var date_input=$('input[name="date"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
var options={
  format: 'dd-mm-yyyy',
  container: container,
  todayHighlight: true,
  autoclose: true,
  startDate: "<?php echo "d-m-Y"?>",
};
date_input.datepicker(options);
})
</script>



<?php
include('layout/footer.php'); 
?>





<script>

  function carga_ajax1(div, id, tipo){

    /* Acceder al resumen de un partido disponible en el sistema */
    if (tipo == 'solicitud'){
      $.post(
        '?controlador=Partido&accion=detallePartido&idPartido='+id,
        function(resp){
          $("#"+div+"").html(resp);
        }
        ); 
    }

    if (tipo == 'resumen'){
      $.post(
        '?controlador=Partido&accion=resumenCapitan&idPartido='+id,
        function(resp){
          $("#"+div+"").html(resp);
        }
        ); 
    }



  }



  function carga_ajax2(div, id, tipo){


    /* Acceder al resumen de un partido pendiente y cancelarlo */
    if (tipo == 'cancelar'){
      $.post(
        '?controlador=Partido&accion=cancelarPartido&idPartido='+id,
        function(resp){
          $("#"+div+"").html(resp);
        }
        ); 
    }



  }


  function carga_ajax3(div, id, tipo){


    /* Acceder al resumen de un partido pendiente y notificarlo */
    if (tipo == 'notificar'){
      $.post(
        '?controlador=Partido&accion=notificarPartido&idPartido='+id,
        function(resp){
          $("#"+div+"").html(resp);
        }
        ); 
    }




  }


  function carga_ajax4(div, id, tipo){


    $.post(
      '?controlador=Partido&accion=verSolicitudes&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 


  }


  function carga_ajax5(div, id, tipo){


    $.post(
      '?controlador=Partido&accion=estadoInvitaciones&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 


  }



  function carga_ajax6(div, id, tipo){


    $.post(
      '?controlador=Partido&accion=responderInvitacion&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 


  }



  function carga_ajax7(div, id){


    $.post(
      '?controlador=Partido&accion=verResumen&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 


  }

  



  $('#modal').modal('hide');
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();







</script>   



