<?php 
include('layout/headerJugador.php');
?>



<!-- Aqui empieza la pagina -->

<div id="contact-us" class="parallax">
  <div class="container">

    <script>
    $(document).ready(function() {
      var hoy = new Date();
      var dd = hoy.getDate();
      var mm = hoy.getMonth()+1; //hoy es 0!
      var yyyy = hoy.getFullYear();

      if(dd<10) {
        dd='0'+dd
      }

      if(mm<10) {
        mm='0'+mm
      } 

      hoy = mm+'-'+dd+'-'+yyyy;

      $('#calendar1').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
        },
        defaultDate: hoy,
        editable: false,
        eventLimit: true, // allow "more" link when too many events

        // Partidos
        events: [
        <?php //foreach ($vectorPartidos as $key ) {
        ?>
          {
            title: 'hola',
            url: 'http://google.com/',
            start: '2016-09-12T10:30:00',
          },
        <?php
         // }
        ?>
        ]
      });
    });
    </script>

    <style>
#calendar1 {
    max-width: 800px;
    margin: 0 auto;
}
</style>
    <hr>
    <div id='calendar1'></div>


  
 </div>
</div>
         

<!-- /Aqui termina la pagina -->



  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li> 
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; 2016 Oxygen Theme.</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>



  
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="assets/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="assets/js/wow.min.js"></script>
  <script type="text/javascript" src="assets/js/mousescroll.js"></script>
  <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
  <script type="text/javascript" src="assets/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="assets/js/lightbox.min.js"></script>



  

  <script src="assets/js/fileinput.min.js" type="text/javascript"></script>

</body>
</html>