

<?php
include('layout/headerAdmin.php');

$_SESSION['estado1']=0;
$_SESSION['estado2']=0;
$_SESSION['estado3']=0;
$_SESSION['estado4']=0;
$_SESSION['estado5']=0;




?>


<!--MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cargando información</h4>
      </div>
      <div class="modal-body">
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--Modal-->
<!--Contenido de la pagina-->
<div id="page-wrapper">
      <style>
      #calendar1 {
        max-width: 800px;
        margin: 0 auto;
      }

      .fc td.fc-today{
        background: bisque;
      }


      </style>
      <br/>

      <div id="calendar1" class="progress">
          
           
               <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                </div>
          
      </div>

             
      <div class="container">          
      <div class ="row">   
      <div class="col-lg-8">
    
        </br>
        <div class="panel panel-default">
        <div class="panel-body">
      <table width="50%" class="table table-striped table-bordered table-hover" >
        <thead>
            <th>Estado</th>
            <th>Cantidad</th>

        </thead>
        <tr>
            <td width="50%"><span class="label label-primary">Activo</span></td>
            <td width="50%"><span id="estado1"></span></td>   
        </tr>
        <tr>
            <td><span class="label label-success">Jugado</span></td>
            <td><span id="estado2"></span></td> 
            
        </tr>
        <tr>
            <td><span class="label label-danger">Cancelado</span></td>
            <td><span id="estado3"></span></td> 
            
        </tr>
        <tr>
            <td><span class="label label-default">Pendiente</span></td>
            <td><span id="estado4"></span></td> 
            
        </tr>
        <tr> 
            <td><span class="label label-warning">Matchday</span></td>
            <td><span id="estado5"></span></td> 
        </tr>

     </table>
     </div>
     </div>
      </div>
      </div>
      </div>
</div>

<!--Contenido de la pagina-->




<?php
include('layout/footerAdmin.php');

?>

<!--Calendario-->
<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='assets/js/moment.min.js'></script>


<script src='assets/js/fullcalendar.min.js'></script>
<script src='assets/js/lang-all.js'></script>
<script src="assets/js/locale/es.js"></script>



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
        lang: 'es',
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
      <?php foreach ($vars['partidosSistema'] as $key ) {
        ?>
        {
          title: '<?php echo $key['tipo']?>',
          start: '<?php echo $key['fecha']?>',
          color: '<?php
                //activo naranjo
                if($key['estado']==1){
                    echo "#337ab7"; 
                    $_SESSION['estado1']++;
                }
                //jugado Verde
                if($key['estado']==2){
                    echo "#5cb85c";
                    $_SESSION['estado2']++;
                }
                //cancelado Rojo
                if($key['estado']==3){
                    echo "#d9534f";
                    $_SESSION['estado3']++;
                }
                //pendiente Plomo
                if($key['estado']==4){
                    echo "#777";
                    $_SESSION['estado4']++;
                }
                //matchday Amarillo
                if($key['estado']==5){
                    echo "#f0ad4e";
                    $_SESSION['estado5']++;
                }

           ?>',
        },
        <?php }?>
        ]
      });

    document.getElementById('calendar1').setAttribute("class","fc fc-ltr fc-unthemed");
    document.getElementById('estado1').innerHTML="<?php echo $_SESSION['estado1']?>";
    document.getElementById('estado2').innerHTML="<?php echo $_SESSION['estado2']?>";
    document.getElementById('estado3').innerHTML="<?php echo $_SESSION['estado3']?>";
    document.getElementById('estado4').innerHTML="<?php echo $_SESSION['estado4']?>";
    document.getElementById('estado5').innerHTML="<?php echo $_SESSION['estado5']?>";




  });
</script>

<!--/Calendario -->

   
