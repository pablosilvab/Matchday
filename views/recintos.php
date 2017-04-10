<?php 



$_SESSION['idRecinto']=NULL;



//Comprobamos que el usuario registrado siempre vea el header jugador

    if(isset($_SESSION['login_user_id'])){
        include('layout/headerJugador.php');
        $jugar=1;
    }else{
        include('layout/header.php');
        $jugar=0; 
    }
        
?>



<style>
  #redimensionar {
    width: 370px;
    height: 277.5px;
  }
</style>


        <!-- Portfolio section start -->
        <!--link rel="stylesheet" type="text/css" href="css/bootstrap.css" /-->
        <link href="assets/css/profile.css" rel="stylesheet">
    
        <div id="contact-us" class="parallax">
             <?php if(isset($_GET["nuevo"])){ 
                        if($_GET["nuevo"]==1){   ?>

                             <div class="container">
                             <div class="alert alert-success fade in">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <strong>Listo!</strong> Comentario agregado!
                            </div>
                             </div>


            <?php          }else{ ?>
                           <div class="container">
                             <div class="alert alert-success fade in">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <strong>Listo!</strong> Puntuacion agregada!
                            </div>
                             </div>

                               <?php     }

                        }
                ?>

            <div class="container">
                <br>
                <ol class="breadcrumb transparent">
                    <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
                    <li class="breadcrumb-item active">Recintos</li>
                </ol>
                    <?php 
                    if($jugar==1){  
                    ?>
                    <div class="page-header">
                      <h2> Elige la cancha para el partido <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
                    </div>
                    <?php    
                    } else {
                    ?>
                    <div class="page-header">
                      <h2> Busca tu cancha ideal <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
                    </div>
                    <?php           
                    }?>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="?controlador=Recinto&accion=busquedaRecintos" method="POST" >
                            <input type="text" class="form-control" placeholder="Busca tu cancha, por nombre, tipo o superficie" name="search" id="texto-input-white"/>

                            <!--Aqui como se "recarga" debemos seguir manteniendo la "seleccion de cancha"-->
                            <?php 
                            if($jugar==1){
                            ?>
                            <input  name="jugar" hidden value="1"/>
                            <?php } 
                            if(isset($_SESSION['login_user_id'])){
                            ?>
                            <input type="text" class="fomr-control" hidden name="tipo" value="1"/>
                            <?php }else{?>
                            <input type="text" class="fomr-control" hidden name="tipo" value="0"/>
                            <?php } ?>
                            
                                <div class="col-md-12">
                                    <br/>
                                    <button class="btn btn-primary btn-lg col-md-12 center-block" type="submit">
                                        Buscar
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>  
                                </div>    
                        </form>
                    </div><!-- /.col-lg-6 -->
                </div>


                <?php
                    $search = '';
                    $cont = 0;
                    if (isset($vars['search'])) {
                      $search = $vars['search'];
                    }
                    if ($search!=''){  // if search

                        // AHORA VIENEN LOS RESULTADOS
                        ?>
                        
             

                <ul class="nav nav-pills">
                    <li class="filter" data-filter="photo"></li>
                    <li class="filter" data-filter="identity"></li>
                </ul>
                <div id="single-project">

                    <?php
                    } // fin if search
                    foreach ($vars['recintos'] as $key) {   // foreach recintos
                        if($key['estado'] == 1){
                        $nombre = $key['nombre'];
                        $pos = strripos($nombre, $search);
                        $tipo = $key['tipo'];
                        $pos2 = strripos($tipo, $search);
                        $superficie = $key['superficie'];
                        $pos3 = strripos($superficie, $search);
                        $idRecinto = $key['idRecinto'];
                        if ($pos !== false  ||   $pos2!==false  || $pos3!==false )  {  // if filtro dentro de foreach recintos
                            
                    ?>



                    <div id="slidingDiv<?php echo $cont?>" class="toggleDiv row-fluid single-project">
                        <div class="span6"> 
                            <style>
                                .Flexible-container {
                                    position: relative;
                                    padding-bottom: 56.25%;
                                    padding-top: 80px;
                                    height: 0;
                                  /* overflow: hidden; */
                                }
                                .Flexible-container iframe,   
                                .Flexible-container object,  
                                .Flexible-container embed {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                }
                            </style>
                            <div class="Flexible-container">
                                <iframe
                                  width="600"   height="500"  frameborder="5" style="border:0"  maptype="satellite"
                                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDR2WyVnnd9GsSTKys5OEkowPu41kMpEUs
                                    &q=Chile + Chillan+ <?php echo $key['direccion'];?>" allowfullscreen>
                                </iframe>
                                <br>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3> <?php echo $nombre ?></h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i> 
                                    </span>

                                </div>



                                <div class="project-info">
                                <table width='100%'>
                                        <tr>
                                        <td width='50%'>
                                        <span>Implementos</span>
                                        </td>
                                        <td width='50%'>
                                        <button type="button" class="btn btn-primary btn-xs" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','implementos','<?php echo $idRecinto ?>');">Ver <i class="fa fa-eye"></i> </button>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                        <span>Teléfono</span> 
                                        </td>
                                        <td>
                                        <?php echo $key['telefono'];?>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                        <span>Dirección</span>
                                        </td>
                                        <td>
                                        <?php echo $key['direccion'];?>
                                        </td>
                                        </tr>                                  
                                    <!-- Aqui debe ir un boton para ver los horarios (Modal) -->
                                        <tr>
                                            <td><span>Horario y precios</span></td>
                                            <td><button type="button" class="btn btn-primary btn-xs" href="javascript:void(0);" data-toggle="modal" data-target="#modal" id="botonHorario" onclick="carga_ajax('modal','horarios', '<?php echo $idRecinto ?>');">Ver <i class="fa fa-eye"></i> </button></td>
                                        </tr>
                                        <tr>
                                            <td><span>Superficie</span></td>
                                            <td><?php echo $key['superficie'];?></td>
                                        </tr>
                                    
                                </table>
                                    <div>
                                    <table width='100%'>
                                        <tr>
                                            <td width='50%'><span>Puntuación</span></td>
                                        
                                        <?php 
                                        //Si la puntuacion del recinto es 0 significa que no ha recibido puntuaciones por lo tanto debemos mostrar un mensaje, y si es distnto de 0 se muestra la puntuacion
                                        if($key['puntuacion']== 0 ){?>
                                            <td width='50%'><?php echo "Este recinto no tiene puntuaciones";?></td>
                                        <?php }else{ ?>

                                       
                                            <td width='50%'><?php echo round($key['puntuacion'],1); ?></td>

                                
                                  <?php  }?>
                                    </tr>
                                </table>
                                    <br/>
                                    <?php
                                     //Con este if se comprueba que el jusgador tenga un estado activo y no haya comentado en este recinto
                                        if(isset($_SESSION['login_user_estado'])){
        
                                            $contadorPuntuacion=0;
                                            $contadorPartido = 0;

                                            foreach ($vars['partidos'] as $partido) {
                                                if($partido['idRecinto'] == $idRecinto){
                                                    $contadorPartido++;
                                                }
                                            }
                                            foreach ($vars['puntuaciones'] as $puntuacion) {

                                                if($puntuacion['idRecinto'] == $idRecinto){
                                                    $contadorPuntuacion++;
                                                    $puntuacionUsuario = $puntuacion['valoracion'];
                                                }
                                            }

                                                //Si el contador es 0 significa que no ha puntuado el recinto
                                                if($_SESSION['login_user_estado']==1){?>

                                    
                                  <?php 
                                  //Si ha jugado un partido en el recinto deportivo
                                  if($contadorPartido > 0 && $contadorPuntuacion == 0){ ?>
                                     <form method="post" action="?controlador=Puntuacion&accion=setPuntuacion" >
                                    <input  class ="with-gap" name="valoracion" type="radio" id="estrella1" value="1" />
                                    <label for="estrella1">1</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella2" value="2"/>
                                    <label for="estrella2">2</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella3" value="3" />
                                    <label for="estrella3">3</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella4"  value="4"/>
                                    <label for="estrella4">4</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella5" value="5" />
                                    <label for="estrella5">5</label>
                                    <input type="hidden" name="idUsuario" value="<?php  echo $_SESSION['login_user_id'] ?>" />
                                    <input type="hidden" name="idRecinto" value="<?php echo $key['idRecinto'] ?>" />
                                    <button class= "btn btn-success" type="submit" name="action">Puntuar</button>
                                    <?php ?>   

                               
                                    
                                </form>

                             <?php }else{

                                    if($contadorPuntuacion > 0){
                                            ?>

                            <form method="post" action="?controlador=Puntuacion&accion=setPuntuacion" >
                                    <input  class ="with-gap" name="valoracion" type="radio" id="estrella1"  value="1" <?php if($puntuacionUsuario==1){ echo "checked"; }?>/>
                                    <label for="estrella1">1</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella2" value="2" <?php if($puntuacionUsuario==2){ echo "checked"; }?>/>
                                    <label for="estrella2">2</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella3" value="3" <?php if($puntuacionUsuario==3){ echo "checked"; }?>/>
                                    <label for="estrella3">3</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella4"  value="4" <?php if($puntuacionUsuario==4){ echo "checked"; }?>/>
                                    <label for="estrella4">4</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella5" value="5" <?php if($puntuacionUsuario==5){ echo "checked"; }?>/>
                                    <label for="estrella5">5</label>
                                    <input type="hidden" name="idUsuario" value="<?php  echo $_SESSION['login_user_id'] ?>" />
                                    <input type="hidden" name="idRecinto" value="<?php echo $key['idRecinto'] ?>" />
                                    <input type="hidden" name="cambiar" value="1" >
                                    <button class= "btn btn-success" type="submit" name="action">Puntuar</button>

                                    
                               
                                </form>
                                     <?php  
                                 }
}
}
                                    } ?>
                                    </div>
                                    
                                    <br/>
                                    <!-- hasta aqui deberia quedar una tabla para abarcar lo de arriba -->
                                    <?php 
                                    if($jugar==1){ ?>
                                    <center>
                                        <button class="btn btn-primary btn-lg cp" href="#" data-toggle="modal" data-target="#modalTipoPartido" data-id="<?php echo $idRecinto ?>">
                                            Jugar Aqui
                                        </button> 
                                    </center>
                                    <?php  } ?>
                       
                                </div>

                                <p></p> <!--puede ir algo mas escrito aqui -->
                            </div>

                        </div>
                        <br/>

                        <!--        COMENTARIOS  -->
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    ¿Qué dicen los demás acerca de <?php echo $nombre?>?
                                </div>
                            </div>
                            <!--Comprobar si se puede comentar o no -->
                            <?php 
                            if(isset($_SESSION['login_user_estado'])){
                            if($_SESSION['login_user_estado']==1 ){


                            if($contadorPartido > 0){ 
                                ?>

                               <div id="comentarios<?php echo $key['idRecinto']; ?>">
                                </div>
                            <?php 
                            }else{?>
                         
                                
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Aviso</strong> Juega en este recinto para comentar y puntuar
                                </div>
                               

                           <?php }
                            }else{ //fin if estado 
                                if($_SESSION['login_user_estado']==2){ ?>

                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                   <strong>Aviso</strong> No puedes comentar, tu perfil se encuentra con restricciones.
                                </div>
                               <div id="comentariosLectura<?php echo $key['idRecinto']; ?>"></div>

                                <?php }
                               

                                if($jugar==0 && !(isset($_SESSION['login_user_id']))){ ?>
                                
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Aviso</strong> Inicia sesión para comentar
                                </div>
                                
                                <?php 
                                }
                                //Si el jugador no ha jugado en el recinto deportivo
                              if( $contadorPartido != 1){ ?>
                                
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Aviso</strong> Juega en este recinto para comentar y puntuar
                                </div>
                               
                                
                                <?php 
                                }
                            }?>
                             
                            <?php }
                            ?>
                            <br/>
                           
                           <?php if(!isset($_SESSION['login_user_id']) || !$contadorPartido>0){
                           ?>
                                <div id="comentariosLectura<?php echo $key['idRecinto']; ?>"></div>


                           <?php } ?>
                            <!--Comentarios antiguos aqui se hacia el foreach-->
                            
                        </div>
                        



                    </div> <!-- Fin Sliding Div-->

                    <?php 
                    $cont++;
                    }
                }  // fin if filtro dentro de foreach
            } // fin foreach recintos
            ?>




            <ul id="portfolio-grid" class="thumbnails row">
                <?php
                $cont = 0;
                foreach ($vars['recintos'] as $key) {   // foreach recintos
                    if($key['estado'] == 1){
                    $nombre = $key['nombre'];
                    $pos = strripos($nombre, $search);
                    $tipo = $key['tipo'];
                    $pos2 = strripos($tipo, $search);
                    $superficie = $key['superficie'];
                    $pos3 = strripos($superficie, $search);
                    $idRecinto = $key['idRecinto'];
                    if ($pos !== false  ||   $pos2!==false  || $pos3!==false )  {  // if filtro dentro de foreach recintos            
                    ?>
                <li class="span4 mix web">
                <div class="thumbnail">
                    <img id="redimensionar" src="assets/images/recintos/<?php echo $key['fotografia'];?>" height='640' width='400' alt="project 1">
                    <a onclick="comentarios(<?php echo $key['idRecinto'];?>);comentariosLectura(<?php echo $key['idRecinto'];?>)"   href="#single-project" class="more show_hide" rel="#slidingDiv<?php echo $cont?>">
                        <i class="icon-plus"></i>
                    </a>
                    <h3> <?php echo "$nombre" ?> </h3>
                    <p>Cancha de <?php echo $key['tipo']; ?></p>
                    <div class="mask"></div>
                </div>
                </li>
                <?php 
                    $cont++;
                }
                    }
                }
                ?>
            </ul>
            <?php if ($cont == 0 && isset($vars['search'])) {?>
                    <h3>No hay Resultados</h3>
            <?php } ?>



            
        </div>
    </div>
</div>

        <!-- MODALES-->
 <!-- MODAL HORARIOS-->
<div class="modal fade" id="modalHorario" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
       <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
            <h4></h4>
      </div>
    </div>
  </div>
</div>

<!--MODAL ADVERTENCIA A / V -->
<div class="modal fade" id="modalAdvertenciaAB" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">No puedes agendar un partido A v/s B</h4>
      </div>
      <div class="modal-body">
                             
                             <div class="alert alert-danger fade in">
                             Necesitas tener al menos 9 contactos para agendar este tipo de partidos
                            </div>
                             
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--MODAL IMPLEMENTOS-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
      <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
            <h4></h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->
<!-- MODAL IMPLEMENTOS-->
   
        <!--MODAL Tipo de partido-->
    <div class="modal fade" id="modalTipoPartido" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Elige el tipo de partido</h3>
                </div>
                <div class="modal-body">
                <h5 class="texto-modal-negro">Selecciona el tipo de partido que quieres organizar.</h5>    
                                        <br/>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4 class="center-block"><i class="fa fa-futbol-o fa-4x" aria-hidden="true"></i></h4>

                                                    <button type="button" class="btn btn-primary center-block col-xs-12" data-dismiss="modal" data-toggle="modal" data-target="#modalRevuelta">Revuelta</button>
                                                    <br><center><br><h4 class="texto-modal-negro " >Aquí podrás invitar a tus amigos,
                                                    indicandóles un recinto y las equipaciones que deben llevar, los equipos los definen
                                                    en el campo de juego. ¿No es increíble? </h4></center>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <h4 class="center-block"><i class="fa fa-user-plus fa-4x" aria-hidden="true"></i></h4> 
                                                    <button id=openEquipoPropio type="button" class="btn btn-primary center-block col-xs-12" data-dismiss="modal" data-toggle="modal" data-target="#modalEquipoPropio">Equipo Propio</button>
                                                    <br><center><br><h4 class="texto-modal-negro " >Aquí puedes organizarte con tu equipo 
                                                    para jugar un partido, no te preocupes si el equipo rival no está en MatchDay ¡Ellos
                                                    se lo pierden!</h4></center>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4 class="center-block"><i class="fa fa-users fa-4x" aria-hidden="true"></i></h4>
                                                <?php 
                                                //Se comprueba que el jugador tiene los contactos necesarios para acceder a esta opcion
                                                    if($vars['numeroContactos'] < 10){ ?>
                                                    <button type="button" class="btn btn-primary center-block col-xs-12"  data-toggle="modal" data-target="#modalAdvertenciaAB" >A v/s B</button>

                                                <?php }else{
                                                ?>
                                                    <button type="button" class="btn btn-primary center-block col-xs-12" data-dismiss="modal" data-toggle="modal" data-target="#modalAB" >A v/s B</button>
                                                <?php }  ?>
                                                <br><center><br><h4 class="texto-modal-negro " >¿Quieres jugar con tus amigos y tienes las alineaciones
                                                perfectas para el partido? Aquí puedes indicarles que equipación debe llevar cada uno.  </h4></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div> 
                </div>
            </div>
        </div>

    <div class="modal fade" id="modalEquipoPropio" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Define la hora, fecha y cantidad de jugadores</h3>
                </div>
                <div class="modal-body">
                    <form  method="post" action="?controlador=Partido&accion=partidoEquipoPropio" class="design-form" >
                        <div class="container">  
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="fecha">Fecha del partido</label>

                                        <!--input type="date" name="fecha" placeholder="Fecha del partido" class="form-control" id="equipo" required="required" -->
                                        <input class="form-control" id="date" name="date" placeholder="Fecha del partido" type="text"  required/>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               <!--Aqui van los horarios -->
                                <div class="col-sm-8">
                                    <div class="form-group">
                                      <label for="idHorario">Horario</label>
                                      <select   data-toggle="modal" data-target="#modalHorario" data-tipo="modalEquipoPropio" class="form-control hr" id="idHorariomodalEquipoPropio" name="idHorario" required="required"  >

                                      <option id="horariomodalEquipoPropio" type="number2" ></option>

                                      </select>
                                    </div>
                                </div>
                            </div>                           
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="hora">Hora</label>
                                        <input id="horaPartidomodalEquipoPropio" type="time" name="hora" placeholder="Hora" class="form-control partido" id="equipo" required="required" min="09:00:00" max="23:00:00" step="3600">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="jugadores">Numero de jugadores totales de tu equipo</label>
                                        <input type="number" name="cantidad"  class="form-control partido" id="equipo" required="required" title="Solo puede ingresar hasta 22 jugadores" placeholder="Ingresa número de jugadores..." pattern="^[0|1]\d{1}$|[0-9]|2+[0|1|2]" min="2">
                                    </div>
                                </div>
                            </div>
                            <input id="idRecintoPartidoPropio" type="number" name="idRecinto"  value="" hidden />
                            
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color">Color</label>
                                        <input type="text" name="color"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalTipoPartido">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL Revuelta-->
<div class="container">
    <div class="modal fade" id="modalRevuelta">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Define la hora, fecha y cantidad de jugadores</h3>
                </div>
                <div class="modal-body">
                    <form  method="post" action="?controlador=Partido&accion=partidoRevuelta" class="design-form" >
                        <div class="container">  
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="fecha">Fecha del partido</label>
                                        <!--input type="date" name="fecha" placeholder="Fecha del partido" class="form-control" id="equipo" required="required" -->
                                        <input class="form-control" id="date" name="date" placeholder="Fecha del partido" type="text"  required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               <!--Aqui van los horarios -->
                                <div class="col-sm-8">
                                    <div class="form-group">
                                      <label for="idHorario">Horario</label>
                                      <select  data-toggle="modal" data-target="#modalHorario" data-tipo="modalRevuelta" class="form-control hr" id="idHorariomodalRevuelta" name="idHorario" required="required"  >

                                      <option id="horariomodalRevuelta" type="number2" ></option>

                                      </select>
                                    </div>
                                </div>
                            </div> 
                        <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="hora">Hora</label>
                                        <input id="horaPartidomodalRevuelta" type="time" name="hora" placeholder="Hora" class="form-control partido" required="required" min="09:00:00" max="23:00:00" step="3600">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="jugadores">Numero de jugadores totales del partido</label>
                                        <input type="int" name="cantidad"  class="form-control partido" id="equipo" required="required" title="Solo puede ingresar hasta 22 jugadores" placeholder="Ingresa número de jugadores totales..." pattern="^[0|1]\d{1}$|[0-9]|2+[0|1|2]">
                                    </div>
                                </div>
                            </div>
                            <input  id="idRecintoPartidoRevuelta" type="number" name="idRecinto" value="" hidden />
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color">Color 1</label>
                                        <input type="text" name="color"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo A...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color2">Color 2</label>
                                        <input type="text" name="color2"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo B...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalTipoPartido">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL A VS B-->
<div class="container">
    <div class="modal fade" id="modalAB">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Define la hora, fecha y cantidad de jugadores</h3>
                </div>
                <div class="modal-body">
                    <form  method="post" action="?controlador=Partido&accion=partidoAB" class="design-form" >
                        <div class="container">  
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="fecha">Fecha del partido</label>
                                        <!--input type="date" name="fecha" placeholder="Fecha del partido" class="form-control" id="equipo" required="required" -->
                                        <input class="form-control" id="date" name="date" placeholder="Fecha del partido" type="text"  required/>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                               <!--Aqui van los horarios -->
                                <div class="col-sm-8">
                                    <div class="form-group">
                                      <label for="idHorario">Horario</label>
                                      <select  data-toggle="modal" data-target="#modalHorario" data-tipo="modalAB" class="form-control hr" id="idHorarioAB" name="idHorario" required="required"  >

                                      <option id="horariomodalAB" type="number2" ></option>

                                      </select>
                                    </div>
                                </div>
                            </div> 
                        <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="hora">Hora</label>
                                        <input id="horaPartidomodalAB" type="time" name="hora" placeholder="Hora" class="form-control partido" id="equipo" required="required" min="09:00:00" max="23:00:00" step="3600">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                      <label for="cantidad">Cantidad total de jugadores</label>
                                      <select  class="form-control"  name="cantidad" required="required">
                                        <?php if($vars['numeroContactos'] >= 9 ){ ?>
                                            <option type="number" value="10" >10</option>
                                        <?php    if($vars['numeroContactos'] >= 11){ ?>
                                            <option type="number" value="12" >12</option>
                                        <?php        if($vars['numeroContactos'] >= 13){ ?>
                                            <option type="number" value="14" >14</option>
                                        <?php            if($vars['numeroContactos'] >=21){ ?>
                                            <option type="number" value="10" >22</option>
                                        <?php            }
                                                }
                                            }
                                         } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="equipo">Selecciona tu equipo</label>
                                         <select  class="form-control"  name="equipo" required="required" >
                                            <option  value="A" >A</option>
                                            <option  value="B" >B</option>
                                        </select>
                                        <small id="emailHelp" class="form-text text-muted">El equipo elegido es en el que jugarás</small>
                                    </div>
                                </div>
                            </div>
                            <input  id="idRecintoPartidoAB" type="number" name="idRecinto" value="" hidden />
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color">Color Equipo A</label>
                                        <input type="text" name="color"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo A...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color2">Color Equipo B</label>
                                        <input type="text" name="color2"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo B...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalTipoPartido">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modales -->

        <!-- ScrollUp button end -->
        <!-- Include javascript -->


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


        <!--script type="text/javascript" src="assets/js/jquery.js"></script-->
        <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
        <script type="text/javascript" src="assets/js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="assets/js/jquery.cslider.js"></script>
        <script type="text/javascript" src="assets/js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="assets/js/jquery.inview.min.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script>
           



</body>
</html>


        <script type="text/javascript">



            function comentarios(idRecinto){
                var id = idRecinto;
                var div;
                div = "comentarios"+id;
               // $("#"+div+"").load('?controlador=Comentario&accion=mostrarComentarios&idRecinto='+id);
                 $.post(
                    '?controlador=Comentario&accion=mostrarComentarios&idRecinto='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    );   
            }


            function comentariosLectura(idRecinto){
                var id = idRecinto;
                var div;
                div = "comentariosLectura"+id;
               // $("#"+div+"").load('?controlador=Comentario&accion=mostrarComentarios&idRecinto='+id);
                 $.post(
                    '?controlador=Comentario&accion=mostrarComentariosLectura&idRecinto='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    );   
            }
        </script>
        <script src="http://maps.googleapis.com/maps/api/js"></script>
        <script>


        function initialize() {
          var mapProp = {
            center:new google.maps.LatLng(-36.602459, -72.077014),
            zoom:14,
            mapTypeId:google.maps.MapTypeId.ROADMAP
          };
          var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }


        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(
            window,
            'load',
            function () {
                 //1000 milliseconds == 1 second,
                 //play with this til find a happy minimum delay amount
                window.setTimeout(initialize, 1000);
            }
        );
        </script>

        <script>
            /*
            $('#modalImplementos').on('show.bs.modal', function(){
                alert("Hola");
                //$('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                $('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                 
            })
            */
            function carga_ajax(div, tipo, id){
                if(tipo == 'implementos'){
                     $.post(
                    '?controlador=Recinto&accion=implementosRecinto&id='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    ); 
                }
                if(tipo == 'horarios'){
                    $.post(
                        '?controlador=Recinto&accion=horariosRecinto&id='+id,
                        function(resp){
                            $("#"+div+"").html(resp);
                        }
                    ); 
                }

            }

            
        </script>
        <script type="text/javascript">
        function clean(e){
        var textfield = document.getElementById(e);
        var groserias = ["puta", "puto","marica","mierda","wn","weon","hueon","huevon","ctm", "conchetumadre", "conchatumadre", "conchesumadre","conshasumadre","concha","pico","raja","culo","culia","culiao","qlo","qla","chucha","shusha","ahueonado","ahueonao","maraca","aweonao","huevon","malparidos","maricon","mrd","xuxa"]
        //var regex ="["mierda"]"/gi;
        for(var i=0; i<groserias.length; i++){
        var regex= new RegExp("(^|\\s)"+groserias[i]+"($|(?=\\s))","gi")
        textfield.value = textfield.value.replace(regex, function($0, $1){return $1 + ""});
                                            }   
        }
        </script>        
        <script type="text/javascript">
        var idRecinto;

        $('.cp').click(function (e){
            e.preventDefault();
            idRecinto = $(this).data('id');
            document.getElementById("idRecintoPartidoPropio").setAttribute("value", idRecinto);
            document.getElementById("idRecintoPartidoRevuelta").setAttribute("value", idRecinto);
            document.getElementById("idRecintoPartidoAB").setAttribute("value", idRecinto);
        });         
        

        $('.hr').click(function (e){
            e.preventDefault();
            var div;
            var tipo;
            var id;
            div = 'modalHorario';
            nombreModal = $(this).data('tipo');
            id = document.getElementById("idRecintoPartidoPropio").getAttribute("value");

                    $.post(
                    '?controlador=Recinto&accion=getHorarios&id='+id+'&form='+nombreModal,
                   function(resp){
                        $("#"+div+"").html(resp);
                    }
                    ); 
                

            
        });

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
</script>                          


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
                      format: 'yyyy-mm-dd',
                      container: container,
                      todayHighlight: true,
                      autoclose: true,
                      startDate: "<?php echo "Y-m-d"?>",
                    };
                    date_input.datepicker(options);
                  })
              </script>