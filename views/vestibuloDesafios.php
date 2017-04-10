
<?php

include('layout/headerJugador.php');
$_SESSION['idEncuentro']=NULL;

?>


<!-- DATATABLE -->
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>







<!--DETALLE DESAFIO   - DESAFIO DE OTROS-->
<div class="modal fade" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">



      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detalle del desafío</h4>
      </div>

      <div class="modal-body">
          <h5 class="texto-modal-negro">Para aceptar este desafío, haz click en el botón "Desafiar". 
          </h5>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Desafiar <i class="fa fa-check" aria-hidden="true"></i></button>
      </div>



    </div>
  </div>
</div>


<!--MODAL IMPLEMENTOS-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando</h4>
      </div>
      <div class="modal-body">
        <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
<!--Modal-->




<link href="assets/css/profile.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/slider.css">





<div id="contact-us" class="parallax">
  <div class="container">
    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item"><a href="?controlador=Desafio&accion=listaDesafios"> <i class="fa fa-futbol-o" aria-hidden="true"></i> Desafios</a></li>
      <li class="breadcrumb-item active">Vestibulo de desafíos<li>
    </ol>

      <div class="page-header">
        <h2> Vestibulo de desafios <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
      </div>

      <?php

      if ($vars['nroDesafios'] != 0 ){

        ?>

        <p class="centered"><?php echo $nombre?>, estos son los desafíos Matchday que puedes responder.</p>


      <div class="row">
        <div class="col-md-8 col-md-offset-2">


            <table id="example" class="table table-striped table-hover display responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr id="color-encabezado">
                  <th id="encabezado-especial">#</th>
                  <th id="encabezado-especial">Equipo</th>
                  <th id="encabezado-especial">Fecha</th>
                  <th id="encabezado-especial">Recinto</th>
                  <th id="encabezado-especial">Estado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="texto-contactos" class="center">
                <?php
                $nroDesafios = $vars['nroDesafios'];
                $j = 0;
                for ($i=1; $i <= $nroDesafios; $i++) {
                  $desafio = $vars['listaDesafiosSistema'.$i];
                  
                foreach ($desafio as $item) {
                  $j++;
                  $idDesafio = $item['idDesafio'];
                  $idEquipo = $item['idEquipo'];
                  if ($item['estadoDesafio']!=2){
                ?>
                <tr>
                  <td>
                    <?php echo $j?>
                  </td>
                  <td id="nombre-equipo">
                    <?php echo $item['nombreEquipo']?>
                  </td>
                  <td>
                    <?php echo $item['fechaPartido']?>
                  </td>
                  <td>
                    <?php 
                    
                    $tipo = $item['tipoPartido'];
                    echo $tipo;
                    
                    ?>
                  </td>
                  <td>
                    <?php 
                    if ($item['estadoDesafio']==0){
                      ?>
                      <span class="label label-warning">Esperando respuestas <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                      <?php
                    }
                    if ($item['estadoDesafio']==1){
                      ?>
                      <span class="label label-success">Con respuestas <i class="fa fa-bell" aria-hidden="true"></i></span>
                      <?php
                    }
                    ?>
                  </td>

                  <input type="text" id="id_desafio" value="<?php echo $idDesafio?>" hidden/>
                  <td>

                    <!--a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#modal-4" onclick="carga_ajax('<?php echo $idDesafio?>','modal-4','views/detalleDesafio.php');"><i class="fa fa-search-plus" aria-hidden="true"></i></a-->



                    <!--a href="#" class="btn btn-primary fa fa-search-plus"  data-placement="right" data-toggle="tooltip" title="Ver detalles"></a-->

                    <button type="button" class="btn btn-primary fa fa-search-plus" href="javascript:void(0);" data-toggle="modal" 
                    data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idDesafio?>');"></button>

                    <script>
                      $(document).ready(function(){
                          $('[data-toggle="tooltip"]').tooltip(); 
                      });
                    </script>



                  </td>
                </tr>
                  <?php
                }
                    }
                  }
                  ?>
                </tbody>
              </table>
          </div>
        </div>
        <br>

         <script type="text/javascript">
          $(document).ready(function() {
            $('#example').DataTable({
              responsive: true
            });
        } );
        </script>




        <?php

      } else {

        ?>

        <p class="centered"><?php echo $nombre?>, en estos momentos no hay desafíos disponibles para tu equipo.
          Por favor, inténtalo más tarde.</p>

          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <table class="table">
                <tr>
                  <th style="border-top:transparent; text-align:center;">
                    <a href="?controlador=Desafio&accion=listaDesafios">
                      <button type="button" class="btn btn-md btn-primary">Volver
                        <i class="fa fa-arrow-circle-left"></i>
                      </button>
                    </a>
                  </th>
                </tr>
              </table>
            </div>
          </div>

        <?php




      }
      ?>


      









    </div>
</div>




<?php
include('layout/footer.php'); 

?>




<!-- Modal -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script-->
<script src="assets/js/jquery.bootstrap-duallistbox-modal.js"></script>







<script src="assets/js/funciones/funciones.js"></script>





<script src="assets/js/bootstrap-slider.js"></script>
<script type="text/javascript">
  $('#ex2').slider({
    min:15,
    max:60,
    step:1,
    precision:0,
    tooltip:'show',
    handle: 'round'
  });
</script>



        <script>
            /*
            $('#modalImplementos').on('show.bs.modal', function(){
                alert("Hola");
                //$('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                $('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                 
            })
            */
            function carga_ajax(div, id){
                     $.post(
                    '?controlador=Desafio&accion=detalleDesafio&idDesafio='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    ); 


            }

            
        </script>