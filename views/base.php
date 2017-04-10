
<?php

include('layout/headerJugador.php');


?>



<link href="assets/css/profile.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/slider.css">





<div id="contact-us" class="parallax">
  <div class="container">
    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Desafios</li>
    </ol>

      <div class="page-header">
        <h2> Desafios <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
      </div>

      <p class="centered">No has realizado desafíos en MatchDay. Puedes crear un nuevo desafío o
              visitar el vestíbulo de desafíos de MatchDay, para enfrentarte a otros equipos.
      </p>


      <br>

    </div>
</div>

<?php
include('layout/footer.php'); 

?>




<!-- Modal -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="assets/js/jquery.bootstrap-duallistbox-modal.js"></script>



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