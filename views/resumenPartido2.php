
<!--Variables -->
<?php

include('layout/headerJugador.php');





if (isset($vars['tipoPartido'])) {

  // Desafios
  $tipo="";
  if ($vars['tipoPartido'] == 4) { 
    $tipoPartido = $vars['tipoPartido'];
    $fecha = $vars['fecha'];
    $hora = $vars['hora'];
    $mensaje = "Se ha enviado una notificación a los jugadores de ambos equipos con la información del partido.";
    $idRecinto= $vars['idRecinto'];
    $idPartido = $vars['idPartido'];
    $cuota =    $vars['cuota']." por equipo";
    $tipo="Desafio";

  } else {
    $partido = end($vars['partido']);
    $idPartido= $partido['idPartido'];
    $idUsuario= $_SESSION['login_user_id'];
    $idRecinto= $partido['idRecinto']; //Recinto seleccionado
    $cantidad = $partido['nroJugadores']; //Cantidad de jugadores seleccionados
    $fecha =    $partido['fecha'];
    $hora =     $partido['hora'];
    $cuota =    $partido['cuota'];
    $idTipo = $partido['tipo'];
    $tipo = "";
    if($idTipo == 1){
        $tipo="Revuelta";
    }
    if($idTipo == 2){
      $tipo="Equipo Propio";
    }
    if($idTipo == 3){
      $tipo="A v/s B";
    }

    //Variables Correo
    $_SESSION['idPartido']=$idPartido;
    $_SESSION['idUsuario']=$idUsuario;
    $_SESSION['idRecinto']=$idRecinto;
    $_SESSION['cantidad'] =$cantidad;

  }


}



foreach ($vars['recinto'] as $key ) {
    $nombreRecinto = $key['nombre'];
    $direccionRecinto = $key['direccion'];
    $fotoRecinto = $key['fotografia'];
}



if (isset($vars['tercerTiempo'])){
  // Variable local
  $tercerTiempo= end($vars['tercerTiempo']);
  $_SESSION['idTercerTiempo']= $tercerTiempo['idTercerTiempo'];
  $local = $tercerTiempo['idLocal'];
  $vectorLocales = $vars['local'];
  $vectorTercerTiempo = $vars['tercerTiempo'];

  foreach ($vectorTercerTiempo as $key ) {
    $horaTercer = $key['hora'];
    $descripcion = $key['comentario'];
  }

  foreach ($vectorLocales as $key ) {
    $idLocal = $key['idLocal'];
    $nombreLocal = $key['nombre'];
    $direccionLocal= $key['direccion'];
  }

}





?>

<link href="assets/css/profile.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/slider.css">


<!---->

<!--MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando ...</h4>
      </div>
      <div class="modal-body">
        <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
            <h4>Espere por favor ... </h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->



<!--MODAL -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando ...</h4>
      </div>
      <div class="modal-body">
        <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
            <h4>Espere por favor ... </h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->



<!-- Aqui empieza la pagina -->
<div id="contact-us" class="parallax">
  <div class="container">

    <div class="row">

      <div class="page-header">
        <h2> Resumen del partido <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
      </div>

      <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
        <div class="span4">
          <img src="assets/images/recintos/<?php echo $fotoRecinto; ?>" alt="project 2">
          <button type="button" class="btn btn-primary btn-md center-block col-md-12" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idRecinto;?>' ,'mapaRecinto');">
            ¿Cómo llegar? <i class="fa fa-map-marker" aria-hidden="true"></i>
          </button>
        </div>
        <div class="span8">
          <div class="project-description">
            <div class="project-title clearfix">
              <h3>Información del partido</h3>
            </div>
            <div class="project-info">
              <table>
                <tr>
                  <th width='25%'><span>Cancha</span></th>
                  <td id="texto-blanco" width='25%'><?php echo $nombreRecinto;?></td>
                </tr>
                <tr>
                  <th><span>Organizador</span></th>
                  <td id="texto-blanco"><?php echo $_SESSION['login_user_name']?></td>
                </tr>
                <tr>
                  <th><span>Fecha</span></th>
                  <td id="texto-blanco"><?php echo $fecha;?></td>
                </tr>
                <tr>
                  <th><span>Hora</span></th>
                  <td id="texto-blanco"><?php echo $hora;?></td>
                </tr>
                <tr>
                  <th><span>Tipo</span></th>
                  <td id="texto-blanco"><?php echo $tipo;?></td>
                </tr>
                <tr>
                  <th><span>Cuota</span></th>
                  <td id="texto-blanco"><?php echo '$'.$cuota;?></td>
                </tr>
                <tr>
                  <th><span>Jugadores</span></th>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm " href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax2('modal','<?php echo $idPartido?>','jugadores');">
                      Ver aquí <i class="fa fa-users" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>


      <?php
      // Tercer Tiempo
      if (isset($vars['tercerTiempo'])){ 
        ?>

      <div class="alert alert-info">
        <strong>¡Atención!</strong> El capitán del partido ha agendado un tercer tiempo.
      </div>


      <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
        <div class="span4">
          <img src="assets/images/locales/1.jpg" alt="project 2">
          <button type="button" class="btn btn-primary btn-md center-block col-md-12" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idLocal;?>' ,'mapaLocal');">
            ¿Cómo llegar? <i class="fa fa-map-marker" aria-hidden="true"></i>
          </button>
        </div>
        <div class="span8">
          <div class="project-description">
            <div class="project-title clearfix">
              <h3>Información del tercer tiempo</h3>
            </div>
            <div class="project-info">
              <table>
                <tr>
                  <th width='25%'><span>Local </span></th>
                  <td id="texto-blanco" width='25%'><?php echo $nombreLocal;?></td>
                </tr>
                <tr>
                  <th><span>Hora</span></th>
                  <td id="texto-blanco"><?php echo $horaTercer;?></td>
                </tr>
                <tr>
                  <th><span>Dirección</span></th>
                  <td id="texto-blanco"><?php echo $direccionLocal;?></td>
                </tr>
                <tr>
                  <th><span>Comentario</span></th>
                  <td id="texto-blanco"><?php echo $descripcion;?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php
      }
      ?>

      <div class="alert alert-success">
        <strong>¡Listo!</strong>
        <?php
        if (isset($tipoPartido)){
          if ($tipoPartido == 4) {
            echo $mensaje;
          } else {
            echo "Se ha enviado una invitación a los participantes del partido.";
          }
        } else {
          echo "Se ha enviado una invitación a los participantes del partido.";
        }
        ?>
      </div>

   

        <table class="table">
          <tr>
            <th style="border-top:transparent; text-align:center;">
              <a href="?controlador=Index&accion=indexJugador">
                <button type="submit" class="btn btn-md btn-primary btn-lg col-md-12">Volver al inicio
                <i class="fa fa-home" aria-hidden="true"></i>
              </button>
              </a>
              
            </th>
          </tr>
        </table>

    </div>

  </div>
</div>













 





<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
<script type="text/javascript" src="assets/js/jquerypp.custom.js"></script>
<script type="text/javascript" src="assets/js/jquery.elastislide.js"></script>


<script>     

    //Creo que hay un error en este script.


if (<?php echo $vars['tipoPartido']?> != 4){

$(document).ready(function() {     
  $.ajax({
    type:'post',
    cache:false,
    url:"?controlador=Partido&accion=enviarInvitaciones"
  });
});

}
</script>

<!-- /Aqui termina la pagina -->

<?php
include('layout/footer.php'); 

?>






<script>
function carga_ajax(div, id, tipo){
  if (tipo == 'mapaRecinto'){
    $.post(
      '?controlador=Recinto&accion=verMapaRecinto&idRecinto='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
  }

  if (tipo == 'mapaLocal'){
    $.post(
      '?controlador=Local&accion=verMapaLocal&idLocal='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
  }
}


function carga_ajax2(div, id, tipo){
  if (tipo == 'jugadores'){
    $.post(
      '?controlador=Partido&accion=getJugadoresPartido&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
  }
}
</script>





<script>
$(window).load(function(){
    var accion = "<?php echo $vars['accion']?>";
    if (accion == "3"){
      //alert("text: ");
      $.ajax({
        type: 'post',
        cache: false,
        url: "?controlador=Partido&accion=enviarCorreo"
      });
    }
    

});

</script>