<?php
include('layout/headerAdmin.php');


$recintos = $vars['recintos'];
$comentarios = $vars['comentarios'];
$desafios = $vars['desafios'];
$usuarios = $vars['usuarios'];



?>





        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reportes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-futbol-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $recintos?></div>
                                    <div>Recintos</div>
                                </div>
                            </div>
                        </div>
                        <a href="?controlador=Recinto&accion=adminRecintos">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $usuarios?></div>
                                    <div>Jugadores</div>
                                </div>
                            </div>
                        </div>
                        <a href="?controlador=Usuario&accion=adminJugadores">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-fw fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $comentarios?></div>
                                    <div>Comentarios</div>
                                </div>
                            </div>
                        </div>
                        <a href="?controlador=Comentario&accion=adminComentarios">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-flag fa-fw fa-5x" aria-hidden="true"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $desafios?></div>
                                    <div>Desafíos</div>
                                </div>
                            </div>
                        </div>
                        <a href="?controlador=Desafio&accion=adminDesafios">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gráficos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <div class="row">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" >
                        Jugadores</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                      <div class="panel-body" id="bodyJugadores">
                      <!--Aqui van los gráficos-->
                        <div id="graficosJugadores">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                              </div>
                        </div>
                      </div>



                      </div>
                    </div>
                 
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                        Recintos</a>
                      </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                      <div class="panel-body">
                          <div id="graficosRecintos">
                            <div class="progress">
                                 <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                 </div>
                             </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                       Partidos</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <div class="panel-body">
                             <div id="graficosPartidos">
                                    <div class="progress">
                                         <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                         </div>
                                     </div>
                              </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                       Equipos</a>
                      </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                      <div class="panel-body">
                          <div id="graficosEquipos">
                            <div class="progress">
                                 <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                 </div>
                             </div>
                      </div>                              
                      </div>
                    </div>
                  </div>
                </div>
            </div>
             </div>
        </div>
        <!-- /#page-wrapper -->



<?php
include('layout/footerAdmin.php');
?>

    <!-- Flot Charts JavaScript -->
    <script src="assets/assetsAdmin/vendor/flot/excanvas.min.js"></script>
    <script src="assets/assetsAdmin/vendor/flot/jquery.flot.js"></script>
    <script src="assets/assetsAdmin/vendor/flot/jquery.flot.pie.js"></script>
    <script src="assets/assetsAdmin/vendor/flot/jquery.flot.resize.js"></script>
    <script src="assets/assetsAdmin/vendor/flot/jquery.flot.time.js"></script>
    <script src="assets/assetsAdmin/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <script src="assets/assetsAdmin/data/flot-data.js"></script>
    <script src="assets/assetsAdmin/js/highcharts.js"></script>

    <script src="assets/assetsAdmin/js/modules/exporting.js"></script>
    <script>



    
        $("#collapse1").on('show.bs.collapse', function(){
               
            $('#graficosJugadores').load('?controlador=Usuario&accion=getGraficosJugadores');
        });

        $("#collapse2").on('show.bs.collapse', function(){
               
            $('#graficosRecintos').load('?controlador=Recinto&accion=getGraficosRecintos');

        });
         $("#collapse3").on('show.bs.collapse', function(){
               
            $('#graficosPartidos').load('?controlador=Partido&accion=getGraficosPartidos');
        });
        $("#collapse4").on('show.bs.collapse', function(){
            
            $('#graficosEquipos').load('?controlador=Equipo&accion=getGraficosEquipos');
        });

        //Cuando se cierre cada collapse

 

        



    </script>