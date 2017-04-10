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
      <div class="col-sm-6 col-sm-offset-3 form-box">
        <form role="form" action="?controlador=Sesion&accion=resumenPartido" method="post" class="registration-form">
          <fieldset>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Inicia sesión</h3>
                <p>Ingresa los datos ingresados anteriormente para unirte al partido</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-user"></i>
              </div>
            </div>
            <div class="form-bottom">

              <div class="form-group">
                <label class="sr-only" for="form-email">Mail</label>
                <input type="email" name="mail" placeholder="Ingresa tu mail" class="form-email form-control"  required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password">Password</label>
                <input type="password" name="password" placeholder="Ingresa tu password" class="form-password form-control" required>
                <!--small id="emailHelp" class="form-text text-muted">.</small-->
              </div>

              <input name="invitado" value="1" hidden >


              <button type="submit" class="btn btn-primary col-xs-12">Ir al resumen <i class="fa fa-paper-plane" aria-hidden="true"></i></button>

              <br>

            </div>




          </fieldset>
        </form>
      </div>
    </div>

      
 </div>
</div>
         

<!-- /Aqui termina la pagina -->

<script>
  document.getElementById("sexo").setAttibute("required","true");
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

