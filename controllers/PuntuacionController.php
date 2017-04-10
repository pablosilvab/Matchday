<?php

require 'models/Puntuacion.php';
require 'models/Recinto.php';

class PuntuacionController{
		function __construct(){
        $this->view = new View();
        $this->Puntuacion = new Puntuacion();
        $this->Recinto  =   new Recinto();
    }

    public function index(){
    	$this->view->show("");
    }

    public function getPuntuaciones(){
    
    }

    public function setPuntuacion(){
        $idRecinto = $_POST['idRecinto'];
        $idUsuario = $_POST['idUsuario'];
        $valoracion = $_POST['valoracion'];

        if(isset($_POST['cambiar'])){
            $this->Puntuacion->deletePuntuacion($idRecinto, $idUsuario);
        }

        $this->Puntuacion->setPuntuacion($idRecinto, $idUsuario, $valoracion);
        $resultadoPuntuacion= $this->Puntuacion->getPuntuacionTotalRecinto($idRecinto);
        $puntuacion=end($resultadoPuntuacion)['puntuacion'];
        $this->Recinto->updatePuntuacionRecinto($idRecinto, $puntuacion);

        //Header provisorio
        header('Location: ?controlador=Recinto&accion=busquedaRecintos');
    }
}
?>