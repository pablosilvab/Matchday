
<?php

include('layout/headerJugador.php'); 

// Se obtiene la lista de equipos del usuario.
//if (isset($vars['listaContactos'])){
$equipos = $vars['listaEquipos'];
$contactos = $vars['listaContactos'];

$nroContactos = count($contactos);

//}
?>



<link href="assets/css/profile.css" rel="stylesheet">














  <div id="contact-us" class="parallax">
    <div class="container">
      <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Equipos</li>
    </ol>

    <?php
      if (isset($vars['accion'])){
        if ($vars['accion'] == 1){
        ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu equipo ha sido creado exitosamente
        </div>
        <?php
        }
        if ($vars['accion'] == 2){
        ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> Tu equipo ha sido actualizado exitosamente
        </div>
        <?php
        }
      }
      ?>

    <?php


      if (count($equipos)==0){          // CASO 1: NO TENER EQUIPOS COMO CAPITAN
        ?>

        <div class="page-header">
          <h2> Mis equipos al mando <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
        </div>

      <p class="centered">No eres capitán de ningún equipo. Para crear un equipo haz click
        <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >aquí 
          <i class="fa fa-plus-circle"></i>
        </button>
      </p>



      <?php
      } else {                        // CASO 2: TENER EQUIPOS COMO CAPITAN
        ?>
        <div class="page-header">
          <h2> Mis equipos al mando <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
        </div>
      
            <p class="centered">A continuación puedes ver los equipos de los cuales eres capitán. Para crear un nuevo equipo haz click
                <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >aquí 
                <i class="fa fa-plus-circle"></i>
              </button>
              . Puedes modificar los datos y jugadores de uno de tus equipos haciendo click en el botón "Gestionar"
            </p>



        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr id="color-encabezado">
                    <th id="encabezado-especial">#</th>
                    <th id="encabezado-especial">Nombre</th>
                    <th id="encabezado-especial">Color</th>
                    <th id="encabezado-especial">Edad promedio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  $i = 1;
                  foreach ($equipos as $item) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $i?>
                    </td>
                    <td>
                      <?php echo $item['nombre']?>
                    </td>
                    <td>
                      <?php echo $item['color']?>
                    </td>
                    <td>
                      <?php echo $item['edadPromedio']?>
                    </td>
                    <td class="centered">
                      <form action="?controlador=Equipo&accion=gestionarEquipo" method="post">
                        <input name="idEquipo" value="<?php echo $item['idEquipo']?>" hidden/> 
                        <button class="btn btn-md btn-success" type="submit">Gestionar</button>
                      </form>
                    </td>
                </tr>
                  <?php
                  $i++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
            </div>
            </div>









      <?php
      }

      $equiposMiembro = $vars['listaEquiposMiembro'];
      
      if (count($equiposMiembro)==0){               // CASO 3: NO SER PARTE DE NINGÚN EQUIPO 
      ?>

      <div class="container">
        <div class="alert alert-warning fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Lo sentimos!</strong> No te han agregado a ningún equipo.
        </div>
      </div>

          </div>
        </div>
      </div>

      <?php
      } else {                                      // CASO 4: SER PARTE DE ALGUN EQUIPO, COMO MIEMBRO
      ?>

      <!--h2> Mis equipos <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2-->
            <p class="centered">Además, perteneces a los siguientes equipos. Haz click en el nombre de alguno para ver a tus compañeros de equipo.</p>
            <?php
            foreach ($equiposMiembro as $item) {
            ?>
            <div class="panel-group">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse<?php echo $item['idEquipo']?>">
                  <h4 class="panel-title">
                    <?php echo $item['nombre']?>
                  </h4></a>
                </div>
                <div id="collapse<?php echo $item['idEquipo']?>" class="panel-collapse collapse">
                  <div class="container">
                    <div class="col-sm-12">
                      <!-- MOSTRAR JUGADORES -->
                      <div class="row">
                        <br>
                          <?php
                          $miembrosEquipo = $vars['listaMiembrosEquipo'.$item['idEquipo']];
                          foreach($miembrosEquipo as $key){
                          ?>
                          <div class="col-md-3 profile-userpic">
                            <img class="img-responsive" style="width: 150px; height: 150px;" src="assets/images/usuarios/<?php echo $key['fotografia']?>">
                            <div class="profile-usertitle">
                              <div class="profile-usertitle-name">
                                <?php  echo $key['nombre']." ".$key['apellido']; ?>
                              </div>
                            </div>
                            <br>
                          </div>
                          <?php
                          }
                          ?>
                      </div>
                      
                    </div>                    
                  </div>
                  
                </div>
              </div>
            </div>


            <?php
            }
            ?>







          </div>
        </div>
    



      <?php
      }
      include('layout/footer.php'); 
      ?>
     

<!-- Script Graficos -->


<!-- Modal -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="assets/js/jquery.bootstrap-duallistbox-modal.js"></script>

<div class="modal fade" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php
      if ( count($contactos)<4  ){        // 1. No hay contactos para agregar en el equipo.
      ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Atención <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
        </div>
        <div class="modal-body">
          <form id="demoform" action="?controlador=Contacto&accion=listaContactos" method="post">
          <h5 class="texto-modal-negro"><?php echo $nombre?>, no tienes suficientes contactos para crear tu equipo. 
            Te recomendamos acceder a la sección de contactos e intentarlo nuevamente.
          </h5>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Ir a Contactos <i class="fa fa-users" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
      </form>
      <?php
      } else {                        //  2.  Hay contactos para agregar en el equipo.
      ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crea tu equipo</h4>
      </div>
      <div class="modal-body">
        <h5 class="texto-modal-negro">Ingresa los datos de tu futuro equipo, del cual serás capitán.</h5>
        <form id="demoform" action="?controlador=Equipo&accion=crearEquipo" method="post" >
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="nombre">Nombre: </label>
                  <input id="text-black" type="text" name="nombre" placeholder="Ingresa un nombre para tu equipo..." class="form-control partido" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="color">Color: </label>
                  <input id="text-black" type="text" name="color" placeholder="Ingresa un color de vestimenta para tu equipo..." class="form-control partido" required="required" >
                </div>
              </div>
            </div>
            <!-- GESTION DEL NUEVO EQUIPO -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <select multiple="multiple" size="<?php count($contactos)?>" name="arrayContactos[]" >
                        <?php
                        foreach($contactos as $item){
                        ?>
                        <option  value="<?php echo $item['idUsuario']?>" class="texto-modal-negro">
                            <?php echo $item['nombre']." ".$item['apellido']?>
                        </option>
                        <?php
                        }
                        ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
          <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
        </div>
        </form>

        <script>
            var demo1 = $('select[name="arrayContactos[]"]').bootstrapDualListbox({
              selectorMinimalHeight:'100'
            });

        </script>

      </div>
      <?php
      }
      ?>

      
    </div>
  </div>
</div>

