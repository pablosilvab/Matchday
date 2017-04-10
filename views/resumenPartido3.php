
<!--Variables -->
<?php

include('layout/headerJugador.php');



$partido = $vars['partido'];
foreach ($partido as $key ) {
  $idPartido = $key['idPartido'];
  $fecha = $key['fechaPartido'];
  $hora = $key['horaPartido'];
  $cuota = $key['cuota'];
  $estado = $key['estado'];
  $idRecinto = $key['idRecinto'];
  $nombreRecinto = $key['nombre'];
  $tipoPartido = $key['tipo'];
  $fotografia = $key['fotografia'];
  $nombreCap = $key['nombreCap'];
  $apellidoCap = $key['apellidoCap'];
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
          <img src="assets/images/recintos/<?php echo $key['fotografia']; ?>" alt="project 2">
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
                  <td id="texto-blanco"><?php echo $nombreCap." ".$apellidoCap?></td>
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
                  <td id="texto-blanco"><?php echo $tipoPartido;?></td>
                </tr>
                <tr>
                  <th><span>Cuota</span></th>
                  <td id="texto-blanco"><?php echo '$ '.$cuota;?></td>
                </tr>
                <tr>
                  <th><span>Invitados</span></th>
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

        <table class="table">
          <tr>
            <th style="border-top:transparent; text-align:center;" colspan="2"><h4>¿Deseas aceptar la invitación?</h4></th>
          </tr>
          <tr>
            <th style="border-top:transparent; text-align:center;">

              <form action="?controlador=Partido&accion=cancelarInvitacion" method="post">
                <input name="idPartido" value="<?php echo $idPartido?>" hidden>
                <input name="idUsuario" value="<?php echo $_SESSION['login_user_id']?>" hidden>
                <button type="submit" class="btn btn-md btn-warning btn-lg col-xs-12">No
                  <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                </button>
              </form>


            </th>
            <th style="border-top:transparent; text-align:center;">


              <form action="?controlador=Partido&accion=aceptarInvitacion" method="post">
                <input name="idPartido" value="<?php echo $idPartido?>" hidden>
                <input name="idUsuario" value="<?php echo $_SESSION['login_user_id']?>" hidden>
                <button type="submit" class="btn btn-md btn-primary btn-lg col-xs-12">Si
                  <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </button>
              </form>



            </th>
          </tr>
        </table>



      </div>
  



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