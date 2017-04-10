<?php 

include('layout/headerJugador.php'); 

// Traer usuario desde el controlador.

if (isset($vars['modificarPerfil']  )){
  $usuario = $vars['modificarPerfil'];
}





?>



<!-- Aqui empieza la pagina -->

<link href="assets/css/profile.css" rel="stylesheet">









<div id="contact-us" class="parallax">

  <div class="container">
    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item"><a href="?controlador=Usuario&accion=perfilUsuario"> <i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
      <li class="breadcrumb-item active">Modificar perfil</li>
    </ol>




    <div class="page-header">
      <h2> Modificar perfil <i class="fa fa-user" aria-hidden="true"></i> </h2>
    </div>

    <p class="centered">Los datos que puedes modificar son los siguientes
    </p>

    <div class="row profile">
      <div class="col-md-4 ">
        <div class="profile-sidebar">
          <?php
          foreach ($usuario as $key) {?>
          <!-- SIDEBAR USERPIC -->
          <div class="profile-userpic">
            <img src="assets/images/usuarios/<?php echo $key['fotografia']?>" class="img-responsive" alt="">
          </div>
          <!-- SIDEBAR USER TITLE -->
          <div class="profile-usertitle">
            <div class="profile-usertitle-name">
              <?php
              echo $key['nombre']." ".$key['apellido'];
              
              ?>
            </div>

          </div>
          <!-- END SIDEBAR USER TITLE -->
        </div>
        <!-- END SIDEBAR USERPIC -->
      </div>
      <div class="col-md-8">
        <div class="profile-sidebar col-offset-6 centered">
          <form role="form" action="?controlador=Usuario&accion=actualizarInformacion" method="post" enctype="multipart/form-data">
            <div class="table-responsive">
              <table class="table table-form">
               <tr>
                <th>Nombre: </th>
                <th><input class="profile-form-control" name="nombre" id="nombre" value="<?php echo $key['nombre']?>"></th>
              </tr>
              <tr>
                <th>Apellido: </th>
                <th><input class="profile-form-control" name="apellido" id="apellido" value="<?php echo $key['apellido']?>"></th>
              </tr>
              <tr>
                <th>Nickname: </th>
                <th><input class="profile-form-control" name="nickname" id="nickname" value="<?php echo $key['nickname']?>"></th>
              </tr>
              <tr>
                <th>Mail: </th>
                <th><input class="profile-form-control" type="email" name="mail" id="mail" value="<?php echo $key['mail']?>"></th>
              </tr>
              <tr>
                <th>Telefono: </th>
                <th><input class="profile-form-control" type="number" name="telefono" id="telefono" value="<?php echo $key['telefono']?>"></th>
              </tr>
              <tr>
                <th>Fotografía</th>
                <th> <input type="file" id="imagen" name="imagen" class="file"  data-min-file-count="1"></th>
              </tr>



            </table>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-md btn-primary col-md-12">Actualizar <i class="fa fa-paper-plane fa-1x"></i></button>
          </div>
          <div class="col-md-4">
            <button type="reset" class="btn btn-md btn-warning col-md-12">Reiniciar <i class="fa fa-eraser fa-1x"></i></button>
          </div>
          <?php
        }
        ?>
      </form>
      <div class="col-md-4">
        <a href="?controlador=Usuario&accion=perfilUsuario"><button class="btn btn-md btn-danger col-md-12">Volver <i class="fa fa-arrow-left fa-1x"></i></button></a>
      </div>
      <br/><br/>
    </div>
  </div>
</div>
</div>

</div>




<!-- /Aqui termina la pagina -->
<?php
include('layout/footer.php'); 
?>

<script src="assets/js/fileinput.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/retina-1.1.0.min.js"></script>
<script src="assets/js/scripts.js"></script>

