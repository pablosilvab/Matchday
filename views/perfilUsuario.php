
<?php 

include('layout/headerJugador.php'); 

// Traer usuario desde el controlador.

$usuario = $vars['perfilUsuario'];




?>



<!-- Aqui empieza la pagina -->
<link href="assets/css/profile.css" rel="stylesheet">




  <div id="contact-us" class="parallax">
    <div class="container">
      <br/>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Perfil</li>
    </ol>

    <?php 
    if (isset($vars['accion'])){
      if ($vars['accion'] == 1){
        ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Listo!</strong> La información de tu perfil se ha actualizado exitosamente.
        </div>
        <?php
      }
    }
    ?>

    <div class="page-header">
          <h2> Mi perfil <i class="fa fa-user" aria-hidden="true"></i> </h2>
        </div>
      <div class="row profile">
        <div class="col-md-4 col-offset-6 centered">
          <div class="profile-sidebar">

            <?php 
            foreach ($usuario as $key) {
              
            ?>

            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <img src="assets/images/usuarios/<?php echo $key['fotografia']; ?>"  class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->

            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php
                  echo $key['nombre']." ".$key['apellido'];
                
                ?>
              </div>

            </div>
            <!-- END SIDEBAR USER TITLE -->
            
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
              <a href="?controlador=Usuario&accion=modificarPerfil">
                <button type="button" class="btn btn-success btn-sm ">Mi información 
                  <i class="fa fa-pencil"></i>

                </button>
              </a>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
              <ul class="nav">
                <li >
                  <a href="?controlador=Equipo&accion=listaEquipos">
                  <i class="fa fa-users"></i>
                  
                  Ver mis equipos</a>
                </li>
                <li>
                  <a href="?controlador=Sesion&accion=logout">
                  <i class="fa fa-sign-out"></i>
                  Cerrar sesión </a>
                </li>
              </ul>
            </div>
            <!-- END MENU -->

            <?php
            }
            ?>


          </div>
        </div>

      </div>
    </div>

  </div>




  
<!-- /Aqui termina la pagina -->



<?php include('layout/footer.php'); ?>