
<?php

include('layout/headerJugador.php'); 

// Se obtiene la lista de contactos del usuario.
//if (isset($vars['listaContactos'])){
$contactos = $vars['listaContactos'];
$equipos = $vars['listaEquipos'];
//}




?>
<link href="assets/css/profile.css" rel="stylesheet">


<!-- DATATABLE -->
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>

<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/dataTables.responsive.min.js"></script>





<!--MODAL IMPLEMENTOS-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando...</h4>
      </div>
      <div class="modal-body">
        <h1></h1>
      </div>
      <div class="modal-footer">
            <h4></h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->






  <div id="contact-us" class="parallax">
    <div class="container">

      <br/>
      <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Contactos</li>
      </ol>

      <?php 

      if (count($contactos)==0){ ?>
      <div class="page-header">
          <h2> No tienes contactos <i class="fa fa-frown-o" aria-hidden="true"></i>  </h2>
      </div>
      <p class="centered">Para agregar un nuevo contacto haz click 
        <button href="#" data-toggle="modal" data-target="#modal-1" type="button" class="btn btn-md btn-primary" action="">aquí <i class="fa fa-plus-circle"></i></button>.
      </p>
    </div>
  </div>






      <?php
      include('layout/footer.php'); 
      } 
      else {
      ?>

      <?php
      if (isset($vars['accion'])){
        if ($vars['accion'] == 1){
        ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu contacto ha sido agregado exitosamente.
        </div>
        <?php
        }
          if ($vars['accion'] == 2){
        ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu contacto ha sido agregado al equipo exitosamente.
        </div>
        <?php
        }
      }
      ?>
      <div class="page-header">
          <h2> Mis contactos <i class="fa fa-users" aria-hidden="true"></i> </h2>
      </div>

      <p class="centered">Para agregar un nuevo contacto haz click 
        <button href="#" data-toggle="modal" data-target="#modal-1" type="button" class="btn btn-md btn-primary" action="">aquí <i class="fa fa-plus-circle"></i></button>
        . Para agregar a uno de tus contactos a un equipo, haz click en el botón "Agregar" </p>


      <br/>



          <table id="example" class="table table-striped table-hover display responsive nowrap" cellspacing="0" width="100%" >
                <thead id ="position-table">
                    <tr id="color-encabezado">
                        <th id="encabezado-especial" width='20%'></th>
                        <th id="encabezado-especial" width='20%'>Nombre</th>
                        <th id="encabezado-especial" width='20%'>Mail</th>
                        <th id="encabezado-especial" width='10%'>Edad</th>
                        <th id="encabezado-especial" width='20%'>Teléfono</th>
                        <th id="encabezado-especial" width='10%'></th>
                    </tr>
                </thead>
                <!--tfoot>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Mail</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                        <th></th>
                    </tr>
                </tfoot-->
                <tbody id="texto-contactos" class="center">
                  <?php
                      foreach ($contactos as $item) {
                        $idContacto = $item['idUsuario'];
                        $nombreContacto = $item['nombre'];
                      ?>
                    <tr>
                      
                      <td width='10%'>
                        <center><img style="-webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;" 
                        height="64" 
                        width="64" 
                         src="assets/images/usuarios/<?php echo $item['fotografia']?>"></center>
                      </td>
                      <td><?php echo $nombreContacto." ".$item['apellido']?></td>
                      <td><?php echo $item['mail']?></td>
                      <td><?php echo $vars['edadContacto'.$item['idUsuario']]?></td>
                      <td><?php echo $item['telefono']?></td>
                      
                      <td>

                        <?php
                        if (count($equipos) != 0){
                          ?>

                          <!--a href="#" class="btn btn-success btn-xs fa fa-plus-circle" onclick="setValue(<?php echo $idContacto.",'$nombreContacto'";?>)" title="Agregar"-->
                          <button type="button" class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" 
                          data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idContacto?>');">Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i></button>

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

        <script type="text/javascript">
          $(document).ready(function() {
            $('#example').DataTable({
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
        } );
        </script>


  





    </div>
  </div>

</div>


<?php
include('layout/footer.php'); 
}

?>
<!-- /Aqui termina la pagina -->





<div class="container">
  <div class="modal fade" id="modal-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Búsqueda de jugadores</h4>
        </div>
        <div class="modal-body">
           <h5 class="texto-modal-negro">Para agregar un contacto, búscalo ingresando su nickname.</h5>
           <br/>
          <form action="?controlador=Usuario&accion=busquedaJugador" method="POST">
            <input id="text-black" type="text" class="form-control partido" placeholder="Ingresa un nickname..." name="search" required="required"/>

              <div class="row">
                <br/>
                    <table class="table">
                      <tr>
                        <th style="border-top:transparent; text-align:center;">
                          <button type="submit" class="btn btn-lg btn-primary">Buscar
                            <i class="fa fa-search" aria-hidden="true"></i>
                          </button>
                        </th>
                      </tr>
                    </table>

                 
              </div> 

          </form>
          <hr/>

          <?php
          $search = '';
          $cont = 0;
          if (isset($_GET['search'])){
            $search = $_GET['search'];
          }
          if ($search!=''){
            ?>
          
          <h3>Resultados</h3>
          <hr/>
          <?php 
          }
          ?>

          <div class="col-sm-6">
            <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="folio-image">
                <!--img class="img-responsive" src="images/usuarios/<?php //echo  $key->getRutaFotografia(); ?>" alt=""-->
              </div>
              <div class="overlay">
                <div class="overlay-content">
                  <div class="overlay-text">
                    <div class="folio-info">
                      <h3>Añadir a <?php //echo $nickname?></h3>
                      <p><?php //echo $nombre?> <?php //echo $apellido?></p>
                    </div>
                    <div class="folio-overview">
                      <!--span class="folio-link"><a class="folio-read-more" href="#" data-single_url="agregarContacto.php?id_contacto=<?php //echo $idUsuario ?>" ><i class="fa fa-plus"></i></a></span-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>



<?php
//$equipos = $vars['listaEquipos'];
$miembrosEquiposJugador = $vars['listaMiembrosEquiposJugador'];
$arrayEquipos = array();
$arrayEquipos2 = array();
$arrayEquiposMiembro = array();

foreach ($equipos as $equipo) {
  $arrayEquipos[] = "".$equipo['nombre'];
}


foreach ($equipos as $equipo ) {
  $arrayEquipos2[$equipo['idEquipo']] = $equipo['nombre'];
}





?>




<div class="container">
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <?php $contactoActual = $_GET['idContact']; ?>
          <h4 class="modal-title" id="myModalLabelContact"></h4>
        </div>
        <div class="modal-body">



          <form  action="?controlador=Contacto&accion=agregarMiembro" method="POST">
              <select class="form-control" id="equipo" name="equipo" title="Selecciona uno de los equipos que administras..">
                <?php

                foreach ($miembrosEquiposJugador as $miembrosEquipos) {
                  if ($miembrosEquipos['idUsuario'] == $contactoActual){
                    $equipoUsuario = $miembrosEquipos['nombre'];
                    $arrayEquiposMiembro[$miembrosEquipos['idEquipo']] = $miembrosEquipos['nombre'];
                  }
                }
                $resultado = array_diff($arrayEquipos2, $arrayEquiposMiembro);


                if (count($resultado)==0){
                  ?>
                  <option id="text-black" ><?php echo "El jugador está en todos tus equipos."?></option>
                  <?php
                } else {


                foreach ($resultado as $key => $value ) {
                 
                ?>
                  <option id="text-black" value="<?php echo $key?>"><?php echo $value?></option>
                <?php
                }
                }
                ?>






                </select>   
                <input type="text" id="id_contacto" name="contacto" hidden/>
              <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
          </div>
          </form>
        </div>
      </div>

      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>







<script>
function carga_ajax(div, id){
  $.post(
    '?controlador=Contacto&accion=nuevoMiembro&idContacto='+id,
    function(resp){
      $("#"+div+"").html(resp);
    }
    );
}
</script>