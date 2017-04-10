<?php 

include('layout/headerJugador.php'); 

//  Contactos que están en el equipo.
$listaMiembrosEquipo = $vars['listaMiembrosEquipo'];
$nroJugadores = count($listaMiembrosEquipo);

//  Contactos que no estan en el equipo.
$listaContactos = $vars['listaContactos'];

//  Información del equipo
$equipo = $vars['equipo'];


// Desafios del equipo
$desafios = $vars['listaDesafios'];


?>


<!--link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"-->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="assets/js/jquery.bootstrap-duallistbox.js"></script>

<link href="assets/css/profile.css" rel="stylesheet">

<div id="contact-us" class="parallax">
    <div class="container">

        <?php 
        foreach ($equipo as $key) {
            $partidosDisputados = $key['partidosDisputados'];
            $partidosCancelados = $key['partidosCancelados'];
            $partidos = $partidosDisputados + $partidosCancelados;
            $idEquipo = $key['idEquipo'];
            $nombreEquipo = $key['nombre'];
            $colorEquipo = $key['color'];
            $_SESSION['idEquipo'] = $idEquipo;
            ?>
        </br>
        <ol class="breadcrumb transparent">
          <li class="breadcrumb-item"><a href="?controlador=Equipo&accion=listaEquipos"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Equipos</a></li>
          <li class="breadcrumb-item active"><?php echo $key['nombre']?></li>
      </ol>

      <div class="page-header">
          <h2> Equipo <?php echo $key['nombre']?> <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
      </div>

      <div class="row">
        <p class="centered">En esta sección puedes ver toda la información respecto al equipo <?php echo $key['nombre']?>. Para modificar información
            haz click <button href="#" data-toggle="modal" data-target="#modal-1" type="button" class="btn btn-md btn-primary" action="">aquí <i class="fa fa-pencil-square-o"></i></button>
        </div>




        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Jugadores de <?php echo $nombreEquipo?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <!-- MOSTRAR JUGADORES -->
                        <div class="row">
                            <br/>
                            <?php
                            $miembrosEquipo = $vars['listaMiembrosEquipo'];
                            foreach($miembrosEquipo as $key){
                              ?>
                              <div class="col-md-3 profile-userpic">
                                <img class="img-responsive" style="width: 150px; height: 150px;" src="assets/images/usuarios/<?php echo $key['fotografia']?>">
                                <div class="profile-usertitle">
                                  <div class="profile-usertitle-name">
                                    <?php  echo $key['nombre']." ".$key['apellido']; ?>
                                </div>
                            </div>
                            <br>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<br/>

<div class="row">




    <?php
    if (count($desafios) == 0){
        ?>
        <p class="centered"></p>
        <?php
    } else {
        if (count($desafios) > 0){
            $baby = 0;
            $futbol = 0;
            $futbolito = 0;
            foreach ($desafios as $key) {
                $tipoRecinto = $key['tipo'];
                if ($tipoRecinto == "Futbolito"){
                    $futbolito++;
                } 
                if ($tipoRecinto == "Baby-futbol"){
                    $baby++;
                }
                if ($tipoRecinto == "Fútbol"){
                    $futbol++;
                }
            }
        }


        ?>
        <!--div class="container">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><strong>Desafíos</strong></h3>
                    </div>
                    <div class="panel-equipo">
                        <div class="panel-body">
                            <div class="sample-chart-wrapper">
                                <canvas id="pie-chart-sample"></canvas>

                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div-->
        <?php
    }
    ?>

</div>


<?php
}
?>
</div>
</div>







<?php 
include('layout/footer.php'); 
?>





<script type="text/javascript" src="assets/js/chartjs/chart.min.js"></script>



<script type="text/javascript">


    var PieDoughnutChartSampleData = [
    {
        value: <?php echo $futbol?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Fútbol"
    },
    {
        value: <?php echo $futbolito?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Futbolito"
    },
    {
        value: <?php echo $baby?>,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Baby-fútbol"
    }
    ]

        /*
        var PieDoughnutChartSampleData4 = [
        {
            value: <?php echo $partidosDisputados?>,
            color:"#2196f3",
            highlight: "#82b1ff",
            label: "Partidos Disputados"
        },
        {
            value: <?php echo $partidosCancelados?>,
            color:"#f44336",
            highlight: "#ff8a80",
            label: "Partidos Cancelados"
        }
        ]*/



        window.onload = function() {
/*
            window.PieChartSample = new Chart(document.getElementById("pie-chart-sample4").getContext("2d")).Pie(PieDoughnutChartSampleData4,{
                responsive:true
            });
            */
            window.PieChartSample = new Chart(document.getElementById("pie-chart-sample").getContext("2d")).Pie(PieDoughnutChartSampleData,{
                responsive:true
            });

        };










    </script>










    <!-- Modal -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/js/jquery.bootstrap-duallistbox-modal.js"></script>

    <div class="modal fade" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Gestión</h4>
        </div>
        <div class="modal-body">
            <h5 class="texto-modal-negro">Modifica la información de tu equipo</h5>
            <form id="demoform" action="?controlador=Equipo&accion=updateEquipo" method="post">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="texto-modal-negro" for="nombre">Nombre: </label>
                      <input id="text-black" type="text" name="nombre" value="<?php echo $nombreEquipo?>" class="form-control partido" required="required" >
                  </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="color">Color: </label>
                  <input id="text-black" type="text" name="color" value="<?php echo $colorEquipo?>" class="form-control partido" required="required" >
              </div>
          </div>
      </div>
      <!-- GESTION DEL NUEVO EQUIPO -->
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">


              <select multiple="multiple" size="<?php count($listaContactos)?>" name="arrayContactos[]" class="demo2">
                <?php
                foreach($listaContactos as $contactos){
                    ?>
                    <option id="no-miembro-equipo" value="<?php echo $contactos['idUsuario']?>">
                        <?php echo $contactos['nombre']." ".$contactos['apellido']?>
                    </option>
                    <?php
                }
                foreach ($listaMiembrosEquipo as $miembros) {
                    ?>
                    <option id="miembro-equipo" value="<?php echo $miembros['idUsuario']?>" disabled selected="selected"> <!-- Estos se van a la segunda lista -->
                        <?php echo $miembros['nombre']." ".$miembros['apellido']?>
                    </option>

                    <?php
                }
                ?>
            </select>


        </div>
    </div>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
  <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
</div>
</form>

<script>
    var demo1 = $('select[name="arrayContactos[]"]').bootstrapDualListbox();

</script>

</div>



</div>
</div>
</div>