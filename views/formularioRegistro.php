<?php 
include('layout/header.php');
?>

<style type="text/css">
  .cropit-preview {
  /* You can specify preview size in CSS */
  width: 960px;
  height: 540px;
}
</style>

<link rel="stylesheet" href="assets/css/style-f.css">


<!--  jQuery -->
<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.css"/>



<script type="text/javascript" src="assets/js/cropbox.js"></script>

<script type="text/javascript" src="assets/js/cropbox-min.js"></script>



              <script>
                  $(document).ready(function(){
                    var date_input=$('input[name="date"]'); //our date input has the name "date"
                    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                    var options={
                      format: 'dd-mm-yyyy',
                      container: container,
                      todayHighlight: true,
                      autoclose: true,
                      startView: 2,
                      endDate: "01-01-1998",
                    };
                    date_input.datepicker(options);
                  })
              </script>




<!-- Aqui empieza la pagina -->

<div id="contact-us" class="parallax">
  <div class="container">

    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=inicio"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Regístrate</li>
    </ol>

    <div class="row">
      <div class="page-header">
          <h2> Únete a MatchDay </h2>
      </div>
      <center><h4>En MatchDay, podrás agendar tus partidos, comentar tus canchas favoritas y agendar un tercer tiempo con tus amigos. Únete a la
        mejor comunidad futbolera de Chile.</h4></center>
    </div>


    <?php
    $aux = 0;
    if (isset($vars['error'])){
      if ($vars['error'] == 0){
        ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Debes ingresar solo archivos con formato de imágenes, éstas deben pesar menos de 5Mb.
        </div>
        <?php
      }
      if ($vars['error'] == 1){
        ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> El email o el nickname ingresados ya existen. Intenta nuevamente. 
        </div>
        <?php
      }
      if ($vars['error'] == 2){
        $aux = 1;
        ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ups!</strong> Algunos datos ingresados no cumplen con los requerimientos: 
          <br>
          <?php echo $vars['msg']?> 
        </div>
        <?php
      }
    }
    ?>


    <input value="<?php echo $aux?>" id="aux" hidden>







    <?php
    if ($aux == 0){

    ?>


    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 form-box">
        <form role="form" action="?controlador=Usuario&accion=registrarUsuario" method="post" class="registration-form" enctype="multipart/form-data">
          <fieldset>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 1 / 3</h3>
                <p>Ingresa tu información personal:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-user"></i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group">
                <label class="sr-only" for="form-first-name">Nombre</label>
                <input type="text" name="nombre" placeholder="Ingresa tu nombre" class="form-first-name form-control" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Apellido</label>
                <input type="text" name="apellido" placeholder="Ingresa tu apellido" class="form-last-name form-control" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Fecha de nacimiento</label>
                <!--input type="date" name="fechaNacimiento" class="form-last-name form-control" required-->
                <input class="form-control" id="date" name="date" placeholder="Ingresa fecha de nacimiento" type="text"  required/>
              </div>

              <div class="form-group">
                <label class="sr-only" for="form-last-name">Teléfono</label>
                <input type="number" name="telefono" placeholder="Ingresa tu teléfono" class="form-last-name form-control" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-about-yourself">Selecciona tu sexo</label>
                <select class="form-last-name form-control" name="sexo" required>
                        <option value="" selected disabled>Selecciona sexo</option>
                        <option id="text-black" value="M">Masculino</option>
                        <option id="text-black" value="F">Femenino</option>
                </select>  
              </div>
            </div>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 2 / 3</h3>
                <p>Ingresa los datos de tu cuenta:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-key"></i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group">
                <label class="sr-only" for="form-email">Mail</label>
                <input type="email" name="mail" placeholder="Ingresa tu mail" class="form-email form-control" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password">Password</label>
                <input type="password" name="password" placeholder="Ingresa tu password" class="form-password form-control" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-first-name">Nickname</label>
                <input type="text" name="nickname" placeholder="Elige un nickname" class="form-first-name form-control" required>
              </div>
            </div>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 3 / 3</h3>
                <p>Selecciona una foto de perfil:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-camera"></i>
              </div>
            </div>
            <div class="form-bottom">


              <div class="form-group">
                <label class="sr-only" for="imagen"></label>
                <input type="file" id="imagen" name="imagen" required="required"  class="file" >
              </div>

              <button type="submit" class="btn btn-primary">Finalizar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>

          </fieldset>
        </form>
      </div>
    </div>


    <?php
    } else {
      ?>

      <input id="divs" value="<?php echo $vars['divs']?>" hidden/>



    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 form-box">

        <form role="form" action="?controlador=Usuario&accion=registrarUsuario" method="post" class="registration-form" enctype="multipart/form-data">
          <fieldset>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 1 / 3</h3>
                <p>Ingresa tu información personal:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-user"></i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group" id="inputNombre">
                <label class="sr-only" for="form-first-name">Nombre</label>
                <input type="text" name="nombre" id="textoNombre" placeholder="Ingresa tu nombre" class="form-control"  required>
              </div>
              <div class="form-group" id="inputApellido">
                <label class="sr-only" for="form-last-name">Apellido</label>
                <input type="text" name="apellido" id="textoApellido" placeholder="Ingresa tu apellido" class="form-control"  required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Fecha de nacimiento</label>
                <!--input type="date" name="fechaNacimiento" class="form-last-name form-control" required-->
                <input class="form-control" id="date" name="date" placeholder="Ingresa fecha de nacimiento" type="text" value="<?php echo $vars['fechaNacimiento']?>" required/>
              </div>

              <div class="form-group">
                <label class="sr-only" for="form-last-name">Teléfono</label>
                <input type="number" name="telefono" placeholder="Ingresa tu teléfono" class="form-control" value="<?php echo $vars['telefono']?>" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-about-yourself">Selecciona tu sexo</label>
                <select class="form-control" name="sexo" required>
                  <?php
                  if ($vars['sexo']=="M"){
                  ?>
                  <option id="text-black" value="<?php echo $vars['sexo']?>" selected>Masculino</option>
                  <option id="text-black" value="F">Femenino</option>
                  <?php                    
                  } 
                  if ($vars['sexo']=="F"){
                  ?>
                  <option id="text-black" value="<?php echo $vars['sexo']?>" selected>Femenino</option>
                  <option id="text-black" value="M">Masculino</option>
                  <?php                    
                  } 
                  ?>
                </select>  
              </div>
            </div>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 2 / 3</h3>
                <p>Ingresa los datos de tu cuenta:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-key"></i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group">
                <label class="sr-only" for="form-email">Mail</label>
                <input type="email" name="mail" placeholder="Ingresa tu mail" class="form-email form-control" value="<?php echo $vars['mail']?>" required>
              </div>
              <div class="form-group"  id="inputPassword">
                <label class="sr-only" for="form-password">Password</label>
                <input type="password" name="password" placeholder="Ingresa tu password" class="form-password form-control" required>
              </div>
              <div class="form-group"  id="inputNickname">
                <label class="sr-only" for="form-first-name">Nickname</label>
                <input type="text" name="nickname" id="textoNickname" placeholder="Elige un nickname" class="form-control"   required>
              </div>
            </div>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 3 / 3</h3>
                <p>Selecciona una foto de perfil:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-camera"></i>
              </div>
            </div>
            <div class="form-bottom">


              <div class="form-group">
                <label class="sr-only" for="imagen"></label>
                <input type="file" id="imagen" name="imagen" required="required"  class="file" >
              </div>

              <button type="submit" class="btn btn-primary">Finalizar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>

          </fieldset>
        </form>
      </div>
    </div>



      <?php
    }
    ?>





      
 </div>








</div>
         

<!-- /Aqui termina la pagina -->

<script>
  document.getElementById("sexo").setAttibute("required","true");
</script>

<script >
$(document).ready(function(){
  var aux = document.getElementById("aux").value;
  if (aux == 1){
      var x = document.getElementById("divs").value;
  var result = x.split(",");
  for (var i = 0 ; i < result.length-1; i++) {
    if (result[i] == 0){
      $( '#inputNombre' ).addClass( "has-error has-feedback" );
      document.getElementById("textoNombre").placeholder = "Ingresa tu nombre correctamente...";
    }
    if (result[i] == 1){
      $( '#inputApellido' ).addClass( "has-error has-feedback" );
      document.getElementById("textoApellido").placeholder = "Ingresa tu apellido correctamente...";
    }
    if (result[i] == 2){
      $( '#inputNickname' ).addClass( "has-error has-feedback" );
      document.getElementById("textoNickname").placeholder = "Ingresa tu nickname correctamente...";
    }
    if (result[i] == 3){
      $( '#inputPassword' ).addClass( "has-error has-feedback" );
    }
    if (result[i] == 4){
      $( '#inputPassword' ).addClass( "has-error has-feedback" );
    }
  };
  }

});
</script>



  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="?controlador=Index&accion=indexJugador"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
        </div>

        <p>Proyecto de título realizado por Carlos Mora Roa y Pablo Silva Bravo </p>
      </div>
    </div>
  </footer>

  



  <!--script src="assets/js/jquery.js"></script-->
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.inview.min.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/mousescroll.js"></script>
  <script src="assets/js/smoothscroll.js"></script>
  <script src="assets/js/jquery.countTo.js"></script>
  <script src="assets/js/lightbox.min.js"></script>


</body>
</html>





<script src="assets/js/fileinput.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/retina-1.1.0.min.js"></script>
<script src="assets/js/scripts.js"></script>

