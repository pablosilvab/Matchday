

<?php 


require_once('controllers/JSON.php');


        include('layout/headerJugador.php');






//Toda la informacion de partida la vamos a manejar via variable de session desde aqui, similiar a lo que hace un "carrito de compras jaja"

$_SESSION['fecha'] = $vars['fecha'];
$_SESSION['hora'] = $vars['hora'];
$_SESSION['cantidad'] = $vars['cantidad'];
$_SESSION['color']  = $vars['color'];
$_SESSION['idHorario'] = $vars['idHorario'];
if(isset($vars['color2'])){
  $_SESSION['color2'] =$vars['color2'];
}

// Si quiero 10 jugadores, pero tengo solo 4 contactos, deberia notificar un partido a los demás jugadores.

$numeroContactos = count($vars['contactos']);
$jugadoresPartido = $_SESSION['cantidad'];

    
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
    width: 80px; height: 70px; padding:; float: left; float: ; margin: 0 10px 48px 0; font-size: 0.9em; color: white; text-align: center;
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
     
         if(elem.data("numsoltar")==maximo-1){
         
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
  
  function setValue(tercer){
    //arv= arrayJugador.join(","); //Funciona
    //Se toma el tipo de partido que se esta agendando para ir a esa funcion.
    var tercerTiempo = tercer;
    var tipoPartido =<?php echo $_SESSION['tipoPartido'];?>;
    var agendar = "";

    var jObject={};

    //FOR con los input

    
    //correos de prueba

 

    for(i in arrayJugador){
      jObject[i] = arrayJugador[i];
    }

    if(tipoPartido == "2"){
      agendar="agendarPartido";

    }
    if(tipoPartido == "1"){
      agendar="agendarPartidoRevuelta";
    }
    if(tipoPartido == "3"){
      agendar="agendarPartidoAB";
    }

      jObject=JSON.stringify(jObject);
      correosInvitados = JSON.stringify(correosInvitados);
      /*$.post(
          "?controlador=Partido&accion="+agendar,
          {jObject:jObject, correosInvitados:correosInvitados});
      */

      //CUANDO NO SE AGENDA UN TERCER TIEMPO
      var form = document.createElement("form");
      form.method = 'post';
      form.action = "?controlador=Partido&accion="+agendar;
      var input = document.createElement('input');
      input.type = "text";
      input.name = "jObject";
      input.value = jObject;
      var input2 = document.createElement('input');
      input2.type = "text";
      input2.name = "correosInvitados";
      input2.value = correosInvitados;
      var input3 = document.createElement('input');
      input3.type = "text";
      input3.name = "tercer";
      input3.value = tercerTiempo;
      form.appendChild(input);
      form.appendChild(input2);
      form.appendChild(input3);
      form.submit();

   




    }




  </script>

<!-- Aqui empieza la pagina -->
<div class="row">
  <div id="contact-us" class="parallax">
    <div class="container">

	<div class="row" id="contenedorJugadores">


	      <div class="heading-a text-center">

        <h2>Elige a los jugadores</h2>
        <h3>Mueve tus jugadores al terreno de juego.</h3>
<?php  foreach ($vars['recintoSeleccionado'] as $key ) {?>
        <h4>Recinto: <?php echo $key['nombre'];?></h4>
        <?php } ?>
      </div>
		<div class="col-md-6"><!-- Jugadores y buscador-->
		<p>Contactos:</p>

    <div class="com-md-6">
    <input style="color: #ffffff" type="text" class="form-control" id="filter" name="filter" placeholder="Buscar Jugador...">
     <button class="btn btn-primary cp" href="#" data-toggle="modal" data-target="#modalInvitados">
     Invitar jugadores fuera de Matchday
     </button> 

    </div>

    <br/>
    <?php if ($faltanJugadores) { 
      $estado = "pendiente";
      ?>
    <div class="alert alert-danger fade in">
        <strong>Importante!</strong> Tu lista de contactos no posee el número de jugadores que seleccionaste para el partido. 
        Para invitar a los jugadores de MatchDay haz click en invitar jugadores fuera de Matchday.

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
		<div id="snaptarget" class="ui-widget-header arreglo">
     </div>
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
<div class="modal fade" id="modalInvitados" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invita a los jugadores fuera del sistema</h4>
      </div>
      <div class="modal-body">

        <div>
            
           <form id="formCorreos" onsubmit="return false;" >
               <label class="label-partido" for="color">Invitados</label>
               <div id="Correos">

               </div>
               <button type="submit" id="submitHidden" hidden="true"></button>
         </form>
        </div>
  
        </div>
      </div>
      <div class="modal-footer">
            <h4></h4>
      </div>
    </div>
  </div>
  </div>


  <div class="container">
    
    <div class="modal fade" id="modal-1">
      <div class="modal-dialog modal-lg">

   
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Todo listo, solo un paso mas!</h3>
           </div>
           <div class="modal-body">

            <!--Resumen Partido-->
            <form  method="post" onsubmit="return false;" class="design-form" > <!-- Falta definir  la accion -->
       
              <div class="container">  
  
    
              <div class="row">
                  <div class="col-sm-8">

          
                      <div class="form-group">
                        <h2 class="center">¿Deseas agendar un tercer tiempo?<h2>
                  
                        <button class="btn-submit" type="submit" onClick="setValue(1)" >Si</button>
                       
                        <button type="submit" class="btn-submit" onClick="setValue(2)" >No</button>
                        
                      </div>
                


                    </div>

              </form>   
              </div>
           </div>
  
           <div class="modal-footer">
       
           </div>
        </div>
      </div>

    </div>





    
</body>

</html>


<script type="text/javascript">

          var faltantes;
          var correosInvitados ={};
          $('.cp').click(function (e){
            e.preventDefault();
            var div = document.getElementById("Correos");
             faltantes = <?php echo $_SESSION['cantidad']; ?> - 1 - arrayJugador.length;
        for (var i = 0; i < faltantes; i++) {
              var divForm = document.createElement("div");
              divForm.setAttribute("class", "form-group");
              var input = document.createElement("input");
              input.setAttribute("name","correo"+i);
              input.setAttribute("class","form-control partido emails");
              input.setAttribute("required","true");
              input.setAttribute("placeholder","Ingresa el correo del jugador a invitar");
              input.setAttribute("type","email");
              //input.validate();
              //input.rules("add",{ notEqualToGroup:['.emails'] });
              
              //Creamos un campo de error pequeño
              var small = document.createElement("small");
              small.setAttribute("id","alerta"+i);
              small.setAttribute("class", "form-text text-muted");
              small.setAttribute("style","color:red");
              small.setAttribute("hidden","true");
              small.innerHTML="El jugador ya se encuentra en Matchday";
              
              divForm.appendChild(input);
              divForm.appendChild(small);
              div.appendChild(divForm);  
               
        }
        if(faltantes > 0){
          var boton = document.createElement("button");
          boton.setAttribute("type","button");
          boton.setAttribute("class","btn btn-primary bc");
         //boton.setAttribute("href","#");
          boton.setAttribute("data-target","#modal-1");
          boton.setAttribute("data-toogle","modal");
          boton.setAttribute("id","botonCorreos");

          
           var inputHide = document.createElement("input");
           inputHide.setAttribute("hidden","true");
           inputHide.setAttribute("value",faltantes);
           divForm.appendChild(inputHide);
           div.appendChild(divForm);  
         if(faltantes == 1){
            boton.innerHTML = "Invitar Jugador";
          }else{
            boton.innerHTML = "Invitar Jugadores";
          }
           div.appendChild(boton);

        }
        });


      //Se debe hacer de esta manera debido a que el elemento es generado dinamicamente
    $(document).on('click','.bc' ,function(e){
      e.preventDefault();
      var cont=0;
        //realizamos una validacion a los correos ingresados
        var myForm = document.getElementById("formCorreos");

        for (var i = 0; i < faltantes; i++) {

            if ( myForm[i].value == null ||  (/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/.test(myForm[i].value))!=1 ) {

                document.getElementById("alerta"+i).innerHTML="Correo mal escrito";
                document.getElementById("alerta"+i).removeAttribute("hidden");
                cont++;
                }

            var comprobarMail = verificacionEmail(myForm[i].value);
            if(comprobarMail == 1){
              cont++;
              document.getElementById("alerta"+i).innerHTML="El jugador ya se encuentra en Matchday";
              document.getElementById("alerta"+i).removeAttribute("hidden");

            }


                // if (!myForm[i].checkValidity()) {
                  //    cont++;
              //}

        }
        if(cont != 0){
           document.getElementById("submitHidden").click();
         }else{
            //formulario con los correos valido
            //document.getElementById("submitHidden").click();
            for (var i = 0; i < faltantes; i++) {
              correosInvitados[i] = myForm[i].value;
            }
            //ahora que esta todo listo debemos abrir el modal de costumbre
            $("#modal-1").modal("toggle");

         }

    });





function verificacionEmail(comprueba_mail) {
var comprueba_mail;
if (window.XMLHttpRequest) {
ajax_email=new XMLHttpRequest();
} else {
ajax_email=new ActiveXObject("Microsoft.XMLHTTP");
}
ajax_email.onreadystatechange=function() {
if (ajax_email.readyState==4) {
comprobarMail=ajax_email.responseText;
}
}
ajax_email.open("GET","?controlador=Usuario&accion=existeCorreo&mail="+comprueba_mail, false);
ajax_email.send();
return comprobarMail;
}






        //modals
$(document).on('show.bs.modal', '.modal', function () {
    var zIndex = Math.max.apply(null, Array.prototype.map.call(document.querySelectorAll('*'), function(el) {
  return +el.style.zIndex;
})) + 10;
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});
$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});

$("#modalInvitados").on('hidden.bs.modal', function () {
   $("#Correos").empty();
});

$("#modal-1").on('hidden.bs.modal', function () {
   correosInvitados = {};
});


</script>

