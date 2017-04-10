<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>MatchDay | A jugar!</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/animate.min.css" rel="stylesheet"> 
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/lightbox.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link id="css-preset" href="assets/css/presets/preset1.css" rel="stylesheet">
  <link href="assets/css/responsive.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="assets/images/soccer.ico">
</head><!--/head-->

<body>

  <!--.preloader-->
  <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->

  <header id="home">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(assets/images/slider/1.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Bienvenido a <span>MatchDay</span></h1>
            <p class="animated fadeInRightBig">Organiza tu partido</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="?controlador=Index&accion=inicio">Empezar</a>
          </div>
        </div>
        <div class="item" style="background-image: url(assets/images/slider/2.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">¿No encuentras tu <span>cancha</span> favorita?</h1>
            <p class="animated fadeInRightBig">En MatchDay tenemos información de todas</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="?controlador=Index&accion=inicio">Empezar</a>
          </div>
        </div>
        <div class="item" style="background-image: url(assets/images/slider/3.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Organiza un <span>Tercer Tiempo</span></h1>
            <p class="animated fadeInRightBig">¿Celebrar el triunfo? ¿Olvidar la derrota? 
              <br/>Da igual el motivo! En MatchDay te recomendamos los mejores lugares</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="?controlador=Index&accion=inicio">Empezar</a>
          </div>
        </div>
      </div>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

      <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>

    </div><!--/#home-slider-->

  </header><!--/#home-->



  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="?controlador=Index&accion=indexJugador"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
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
  <script type="text/javascript" src="assets/js/main.js"></script>

</body>
</html>