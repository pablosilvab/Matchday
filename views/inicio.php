<?php include('layout/header.php'); 


/* Se llega a esta pantalla:

1. Inicio de sesión fallida (jugador y admin).
2. Cerrar sesión.

*/


?>




<!-- Aqui empieza la pagina -->
<div id="contact-us-inicio" class="parallax">




  <div class="container">




    <div class="row">

      <?php

if (isset($vars['error_login'])){
  $inicio_sesion = $vars['error_login'];
  if ($inicio_sesion){
    ?>
    <div class="container">
      <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong> No has podido iniciar sesión, vuelve a intentarlo.
      </div>
    </div>
    <?php
  }
}


if (isset($vars['cerrar_sesion'])){
  $logout = $vars['cerrar_sesion'];
  if ($logout){
    ?>
    <div class="container">
      <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Listo!</strong> Te has desconectado del sistema.
      </div>
    </div>
    <?php
  }
}



if (isset($vars['nuevoUsuario'])){
  $nuevo = $vars['nuevoUsuario'];
  if ($nuevo){
    ?>
    <div class="container">
      <div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Listo!</strong> Tu cuenta se ha creado exitosamente.
      </div>
    </div>
    <?php
  }
}

?>
      <div class="col-md-12">
        <br/>
      <div class="jumbotron my-back">
        <h2 id="text-black">
          Bienvenido a MatchDay
        </h2> 
        <p id="black-center">
         En MatchDay, podrás organizar tus encuentros deportivos de una manera única e inigualable. Tendrás acceso a información de las canchas repartidas 
         por distintos sectores de Chillán. Además, existen muchas funcionalidades para hacer de un partido una experiencia inolvidable. 
         ¿Qué esperas? ¡Únete a MatchDay!
        </p>
        <h2><a class="btn btn-primary btn-lg" href="?controlador=Usuario&accion=formularioRegistro">Regístrarse</a></h2>
      </div>
    </div>

    


    
      <br/> <br/> <br/> 
    </div>
  </div>


</div>









<!-- /Aqui termina la pagina -->

<?php
include('layout/footer.php'); 
?>