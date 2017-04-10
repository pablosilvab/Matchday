<?php
ini_set('display_errors',1);
require("libs/PHPmailer/class.phpmailer.php");
require("libs/PHPmailer/class.smtp.php");

//https://www.google.com/settings/security/lesssecureapps
//http://phpmailer.worxware.com/


 function send($bodyMail,$listaMails, $subject)
{
	$mail = new PHPMailer() ;

		$body = $bodyMail;
		$lista = $listaMails;
					 				 
			$body .= "";

//		$mail->IsSMTP(); 

		//Sustituye (ServidorDeCorreoSMTP)  por el host de tu servidor de correo SMTP
 		$mail->Host = "smtp.gmail.com";		
		$mail->Port       = 465;  
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl"; 
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		
		//Sustituye  ( CuentaDeEnvio )  por la cuenta desde la que deseas enviar por ejem. prueba@domitienda.com  
		$mail->From     = "partidomatchday@gmail.com";
		$mail->FromName = "Equipo Matchday";

		$mail->Subject  = $subject;
		$mail->AltBody  = "Leer"; 
		$mail->MsgHTML($body);

		// Sustituye  (CuentaDestino )  por la cuenta a la que deseas enviar por ejem. usuario@destino.com  
		//Aqui agregar
		//$lista 	$mail->AddAddress($lista, ",");
		$arrayCorreos= explode(",", $lista);
		for ($i=0; $i < sizeof($arrayCorreos); $i++) { 
			$mail->AddAddress($arrayCorreos[$i]);
		}
		
		$mail->SMTPAuth = true;

		// Sustituye (CuentaDeEnvio )  por la misma cuenta que usaste en la parte superior en este caso  prueba@midominio.com  y sustituye (ContraseñaDeEnvio)  por la contraseña que tenga dicha cuenta 
		$mail->Username = "partidomatchday@gmail.com";
		$mail->Password = "matchdaycarrasco"; 
		if($mail->Send())
		{			
			echo "Mailer Error: " . $mail->ErrorInfo;
			return $body; 
		}else
		{
			return false;
			die();
		}
	}



//$html = send($_POST['correo'],$_POST['nombre'],$_POST['descripcion']);

