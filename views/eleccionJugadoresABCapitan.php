<?php 


require_once('controllers/JSON.php');


        include('layout/headerJugador.php');


//Toda la informacion de partida la vamos a manejar via variable de session desde aqui, similiar a lo que hace un "carrito de compras jaja"
//Información del Partido
$_SESSION['fecha'] = $vars['fecha'];
$_SESSION['hora'] = $vars['hora'];
//Manejamos la cantidad, debemos dividir en 2 
$_SESSION['cantidad'] = ($vars['cantidad']/2);
$_SESSION['cantidadTotal']= $vars['cantidad'];
$_SESSION['color']  = $vars['color'];
$_SESSION['color2'] = $vars['color2'];
$_SESSION['equipoCapitan'] = $vars['equipoCapitan'];
$_SESSION['idHorario'] = $vars['idHorario'];


//Sesetea el mensaje de la pantalla de eleccion de jugadores del equipo
$mensaje= "Elige a los jugadores del Equipo ";
if($_SESSION['equipoCapitan'] == "A"){
  $mensaje= $mensaje."A";
}else{
  $mensaje= $mensaje."B";
}


// Si quiero 10 jugadores, pero tengo solo 4 contactos, deberia notificar un partido a los demás jugadores.

$numeroContactos = count($vars['contactos']);
$jugadoresPartido = $_SESSION['cantidadTotal'];

    
$faltanJugadores=false;
if ($numeroContactos < $jugadoresPartido-1) {
  $faltanJugadores = true;
  $jugadoresFaltantes = $jugadoresPartido-$numeroContactos; // Este es el minimo de jugadores que pueden faltar. 
}
$_SESSION['estadoPartido']=$faltanJugadores;

$json = new Services_JSON();
 ?> 

  <style>
  .draggable { 
    width: 80px; height: 70px; padding:; float: left; float: ; margin: 0 10px 10px 0; font-size: 0.9em; color: white; text-align: center;
    background-color: transparent;
    border-radius: 0.3em;
  }
  .ui-widget-header p{color: black; text-align: center; margin-top: 25px; margin-right: 25px;}, .ui-widget-content p { margin-top: 25px; margin-right: 25px; color: white; text-align: center; }
  #snaptarget { height: 520px; width: 400px; float: right; color: black; text-align: center;
    background-image: url("assets/images/cancha.jpg");
    background-size: 100%;
    padding: 0;
    margin: 0; 
    

      }
  .arreglo {
    left: 10px;
    top: 20px;
    z-index: 1;
}
.stroke {
-webkit-text-fill-color: white;
-webkit-text-stroke: 0.7px black;
font-size: 15px;
}
  </style>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
$(function(){

    $('#filter').keyup(function () {  
       
        // create a pattern to match against, in this one
        // we're only matching words which start with the 
        // value in #filter, case-insensitive

        var pattern = new RegExp('^' + this.value.replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1"), 'i');
        
        // hide all h4's within div.media, then filter
        $('div.media1 div.jugador div.draggable').hide().filter(function() {
    
            // only return h4's which match our pattern
            return !!$(this).text().match(pattern);
    
        }).show(); // show h4's which matched the pattern

    });
});//]]> 

  var arrayJugador = new Array();
  var maximo = 2;
  maximo = <?php echo $_SESSION["cantidad"];?>

  $(function(){
     $( "#sig" ).click(function() {
      });


    $( "#draggable" ).draggable({ snap: true 
    });

    $("#snaptarget").data("numsoltar",0);//variable que guarda el num de jugadores
    $("#snaptarget").data("max",maximo);
    $("#snaptarget").droppable({
      drop: function( event, ui ) { //Aqui entra
      if (!ui.draggable.data("jugador")){
         ui.draggable.data("jugador", true);
         var elem = $(this);
         var elem1 = $(this);
         
         elem.data("numsoltar", elem.data("numsoltar") + 1);
         elem.html("" + elem.data("numsoltar") + " jugadores elegidos");
         var idjugador= ui.draggable.data("id");  
         arrayJugador[elem.data("numsoltar")-1]=(ui.draggable.data("id"));

         //alert(""+ arrayJugador+""); NO BORRAR SIRVE PARA DEBUGGEAR 
         //jugadoresEquipoCap
         if(elem.data("numsoltar")==maximo-1){
          document.getElementById("jugadoresEquipoCap").setAttribute("value", arrayJugador);
          $("#sig").click();
         }
      }

   },
   out: function( event, ui ) { //Aqui sale
      if (ui.draggable.data("jugador")){
         ui.draggable.data("jugador", false);
         var elem = $(this);
         var elem1 = $(this);
         var arrAux= new Array();
         for (var i = 0; i < arrayJugador.length-1; i++) {
           if(ui.draggable.data("id")!=arrayJugador[i]){
              arrAux[i]= arrayJugador[i];
           }else{
            arrAux[i]=arrayJugador[i+1];
           }


         };
         arrayJugador=arrAux;
         elem.data("numsoltar", elem.data("numsoltar") - 1);
         elem1.html("" + ui.draggable.data("id") + " Jugador Salio");

      }
   }

});

   
   <?php 
   foreach ($vars['contactos'] as $Contacto) {
    ?>
    $( "#draggable<?php echo $Contacto['idUsuario'];?>" ).draggable({ 
      snap: ".ui-widget-header",
      containment: "#contenedorJugadores",
      scroll: false,
      create: function(event, $Contacto){}
      });
    $("#draggable<?php echo $Contacto['idUsuario'];?>").data("jugador",false);
    $("#draggable<?php echo $Contacto['idUsuario'];?>").data("id","<?php echo $Contacto['idUsuario'];?>");

      <?php  
    }//fin foreach
      ?> 
      });


  </script>

<!-- Aqui empieza la pagina -->
<div class="row">
  <div id="contact-us" class="parallax">
    <div class="container">

	<div class="row" id="contenedorJugadores">

	      <div class="heading-a text-center">

        <h2><?php echo $mensaje;?></h2>
        <h3>Mueve tus jugadores al terreno de juego.</h3>
<?php  foreach ($vars['recintoSeleccionado'] as $key ) {?>
        <h4>Recinto: <?php echo $key['nombre'];?></h4>
        <?php } ?>
      </div>
       
		<div class="col-md-6"><!-- Jugadores y buscador-->
		<p>Contactos:</p>

    <div class="com-md-6">
    <input type="text" class="form-control" id="filter" name="filter" placeholder="Buscar Jugador...">

    </div>

    <br/>
    <?php if ($faltanJugadores) { 
      $estado = "pendiente";
      ?>
    <div class="alert alert-danger fade in">
        <strong>Importante!</strong> Tu lista de contactos no posee el número de jugadores que seleccionaste para el partido. 
        Para invitar a los jugadores de MatchDay haz click <a href="#" data-toggle="modal" data-target="#modal-1">aqui</a>.

    </div>
    <?php } else {

    }?>

		<!--<img id="draggable1" class="img-responsive center ui-widget-content arreglo draggable" src="images/usuarios/cris.jpg" width="60" alt="hola" > -->
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<?php

foreach ($vars['contactos'] as $Contacto) { 

?>
  <div class="media1">
      <div class="jugador">
    <div id="draggable<?php echo $Contacto['idUsuario'];?>" class="ui-widget-content arreglo draggable"><p class="hide"><?php echo $Contacto['nombre'];?></p>
    <img  class="img-responsive-resize" src="assets/images/usuarios/<?php echo $Contacto['fotografia'];?>" width="80"/>
    <p class="stroke" ><strong><?php echo $Contacto['nombre'];?></strong></p> 
    </div>
    </div>
    </div>
<?php
} //fin foreach
?>


		</div>
    <button href="#" data-toggle="modal" data-target="#modal-1" class="hide" id="sig"></button>
		<div class="col-md-6" ><!--cancha-->
		<div id="snaptarget" class="ui-widget-header arreglo"></div>
		</div>

	</div>
   


	</div>
	
	





    </div>
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

 



  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="assets/js/wow.min.js"></script>
  <script type="text/javascript" src="assets/js/mousescroll.js"></script>
  <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
  <script type="text/javascript" src="assets/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
  <script type="text/javascript" src="assets/js/main.js"></script>

  <script type="text/javascript" src="assets/js/fileinput.min.js"></script>


  <div class="container">
    
    <div class="modal fade" id="modal-1">
      <div class="modal-dialog modal-lg">
        <?php
        if ($faltanJugadores){
          ?>
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Tranquilo, puedes completar el partido aún!</h3>
           </div>
           <div class="modal-body">

            <form  method="post" action="inicioJugador.php?estado=pendiente" class="design-form" > <!-- Falta definir  la accion -->
       
              <div class="container">  
  
    
              <div class="row">
                  <div class="col-sm-8">

          
                      <div class="form-group">
                        <h2 class="center">¿Deseas invitar a otros jugadores de MatchDay?<h2>
                       
                        <button class="btn-submit" type="submit" onClick="setValue()">Si</button>
                       
                        <button type="submit" class="btn-submit" onClick="setValue()" >No</button>
                        
                      </div>
                


                    </div>

              </form>   
              </div>
           </div>
          <?php
        } else {
        ?>
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Todo listo, solo un paso mas!</h3>
           </div>
           <div class="modal-body">

            <!--Resumen Partido-->
            <!-- Falta definir  la accion -->
       
              <div class="container">  
  
    
              <div class="row">
                  <div class="col-sm-8">

                    <form method="POST" action="?controlador=Partido&accion=equipoCapitanAB">
                      <div class="form-group">
                        <h2 class="center">Equipo seleccionado ¿Continuar?<h2>
                          <input id="jugadoresEquipoCap" hidden name="jugadoresEquipoCap" value="">
                        <button  type="submit" class="btn-submit" >Si</button>
                       
                        <button  class="btn-submit"  data-dismiss="modal" >No</button>
                        
                      </div>
                
                    </form>

                    </div>
  
              </div>
           </div>
           <?php }?>
           <div class="modal-footer">
       
           </div>
        </div>
      </div>

    </div>





    
</body>

</html>