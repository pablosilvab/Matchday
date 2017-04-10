
<?php

include('layout/headerJugador.php');
if (isset($vars['usuarios'])){
  $resultados = $vars['usuarios'];
}







if (count($resultados)==0){   // NO SE HAN ENCONTRADO RESULTADOS
?>


<link href="assets/css/profile.css" rel="stylesheet">




<div id="contact-us" class="parallax">
  <div class="container">
    <div class="page-header">
      <h2> Lo sentimos, no se han encontrado resultados <i class="fa fa-frown-o" aria-hidden="true"></i>  </h2>
    </div>

    <h4>Recuerda que en MatchDay, debes tener el nickname tu amigo para añadirlo a tu lista, verifícalo e intenta nuevamente.</h4>
    <div class="row">
    	<div class="col-md-4">
    	</div>
    	<div class="col-md-4">
    		<a href="?controlador=Contacto&accion=listaContactos"><button type="submit" class="btn-submit">Volver</button></a>

    	</div>
    	<div class="col-md-4">
    	</div>
    </div>
    </div>
</div>

<!-- /Aqui termina la pagina -->

<?php
include('layout/footer.php'); 

} else {        // SI ESTA EL NICKNAME EN LA BASE DE DATOS
?>


<link href="assets/css/profile.css" rel="stylesheet">

  <div id="contact-us" class="parallax">
  	<div class="container">
      <div class="page-header">
          <h2> Resultados </h2>
      </div>
      <?php
      foreach ($resultados as $item) {   

        $respuesta = $vars['respuesta'];
        $nick = $item['nickname'];
        /*
        1: Se puede agregar
        2: Ya esta agregar
        3: Es el mismo
        */

        $msg1 = "Para agregar a ".$nick." a tu lista, haz click en el botón 'Agregar'";
        $msg2 = "Ya tienes a ".$nick." en tu lista de contactos";
        $msg3 = "No te puedes agregar a ti mismo, sin embargo, así te ven tus amigos cuando desean agregarte.";
        ?>



        <p class="centered"> 

          <?php
          if ($respuesta == 3){
            echo $msg3;
          }
          if ($respuesta == 2){
            echo $msg2;
          }
          if ($respuesta == 1){
            echo $msg1;
          }
          ?>


        </p>

        <div class="row profile">
          <div class="col-md-4 col-offset-6 centered">
            <div class="profile-sidebar">

              <!-- SIDEBAR USERPIC -->
              <div class="profile-userpic">
                <img src="assets/images/usuarios/<?php echo $item['fotografia']; ?>" class="img-responsive" alt="">
              </div>
              <!-- END SIDEBAR USERPIC -->

              <!-- SIDEBAR USER TITLE -->
              <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                  <?php

                    echo $item['nombre']." ".$item['apellido'];
                  
                  ?>
                </div>

              </div>
              <!-- END SIDEBAR USER TITLE -->
              

              <!-- SIDEBAR BUTTONS -->
              <div class="profile-userbuttons">

                <div class="row">
                  <?php
                    if ($respuesta == 1){
                      ?>
                      <div class="col-xs-6">
                        <form action="?controlador=Contacto&accion=agregarContacto" method="post">
                          <input name="idJugador" value="<?php echo $item['idUsuario']?>" hidden>

                          <button type="submit" class="btn btn-success btn-sm"> Agregar <i class="fa fa-plus-circle"></i> </button>
                          
                        </form>
                      </div>
                      <div class="col-xs-6">
                        <a href="?controlador=Contacto&accion=listaContactos">
                          <button type="button" class="btn btn-sm btn-primary btn-sm ">Volver
                            <i class="fa fa-arrow-circle-left"></i>
                          </button>
                        </a>
                      </div>
                      <?php
                    } else {
                      ?>
                      <div class="col-xs-12">
                        <a href="?controlador=Contacto&accion=listaContactos">
                          <button type="button" class="btn btn-sm btn-primary btn-sm ">Volver
                            <i class="fa fa-arrow-circle-left"></i>
                          </button>
                        </a>
                      </div>
                      <?php
                    }
                    ?>
                  
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

include('layout/footer.php'); 
}
?>