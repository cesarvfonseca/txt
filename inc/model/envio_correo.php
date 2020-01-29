<?php
	
	$correo_destinatario = $_REQUEST['correo_destinatario'];
	$nombre_destinatario = $_REQUEST['nombre_destinatario'];
	$employeeID = $_REQUEST['employeeID'];
	$tipo = $_REQUEST['tipo'];
	$nombre_empleado = $_REQUEST['nombre_empleado'];
	$razon = $_REQUEST['razon'];
	$fechaINI = $_REQUEST['fechaINI'];
	$fechaFIN = $_REQUEST['fechaFIN'];
	$detalle = $_REQUEST['detalle'];

	if ($tipo == 'txt') 
		$asunto = "Tiempo a Favor";
	else if ($tipo == 'txtc')
		$asunto = "Tiempo en contra";
	else if ($tipo == 'vacaciones')
		$asunto = "Vacaciones";
	else if ($tipo == 'pcg')
		$asunto = "Permiso con Goce";
	else if ($tipo == 'psg')
		$asunto = "Permiso sin Goce";
	
	$headers = 'Content-Type: text/html; charset=UTF-8';
	if ($tipo == 'vacaciones') {
		$contenido = 	'
						<html>
							<head>
								<meta charset="UTF-8">
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								<title>Solicitud de '.$asunto.'</title>
							</head>
							<body>
								<p>Hola '. $nombre_destinatario .'</p>
								<p>El empleado '. $nombre_empleado .' con numero de nomina '. $employeeID .' ha solicitado '. $asunto .' por el siguiente concepto</p>
								<p>Periodo: '. $fechaINI .' al '.$fechaFIN.'</p>
								<p>Razón: '. $razon .'</p>
								<p>En el siguiente link podra acceder al panel de Autorizacion de Incidencias Web</p>
								<a href="http://187.188.159.205:8090/Mexqintra/rh/inicio/txt/index.php?request=autorizar&emp='. $employeeID .'&fechaINI='. $fechaINI .'&fechaFIN='. $fechaFIN .'">Autorizacion de Incidencias Web</a>
							</body>
						</html>
						';
	} else {
		$contenido = 	'
						<html>
							<head>
								<meta charset="UTF-8">
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								<title>Solicitud de '.$asunto.'</title>
							</head>
							<body>
								<p>Hola '. $nombre_destinatario .'</p>
								<p>El empleado '. $nombre_empleado .' con numero de nomina '. $employeeID .' ha solicitado '. $asunto .' por el siguiente concepto</p>
								<p>Fecha: '. $fecha .'</p>
								<p>Horas: '. $detalle .'</p>
								<p>Razón: '. $razon .'</p>
								<p>En el siguiente link podra acceder al panel de Autorizacion de Incidencias Web</p>
								<a href="http://187.188.159.205:8090/Mexqintra/rh/inicio/txt/index.php?request=autorizar&emp='. $employeeID .'&fechaINI='. $fechaINI .'&fechaFIN='. $fechaFIN .'">Autorizacion de Incidencias Web</a>
							</body>
						</html>
						';
			}
		mail ($correo_destinatario, $asunto, $contenido, $headers, '-f contacto@mexq.com.mx');
	
	// $nombres=$_REQUEST["nombres"];
	// $apellidos=$_REQUEST["apellidos"];
	// $folio=$_REQUEST["folio"];
	// $correo=$_REQUEST["correo"];
	// $headers .= 'Correo generado automaticamente, favor de no responder';
	// $contenido="Te has postulado para una vacante en MEXQ con exito!\n".
	//  			$nombres." ".$apellidos." te confirmamos tu postulación a una vacante en MEXQ con el folio: ".$folio.
	//  			"\nCon este folio puedes consultar tu proceso PROXIMAMENTE, en 1 mes, no menos, como 5.";
	// mail($correo,"Postulante MEXQ ".$folio, $contenido,$header," -f contacto@mexq.com.mx");
	// header("Location: http://187.188.159.205:8090/vacantes");

	//  // multiple recipients
	// $to  = 'www.cavf.20@gmail.com' . ', '; // note the comma
	// // $to  = 'aidan@example.com' . ', '; // note the comma
	// $to .= 'wez@example.com';

	// // subject
	// $subject = 'Birthday Reminders for August';

	// // message
	// $contenido = '
	// <html>
	// <head>
	//   <title>Birthday Reminders for August</title>
	// </head>
	// <body>
	//   <p>Here are the birthdays upcoming in August!</p>
	//   <table>
	//     <tr>
	//       <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
	//     </tr>
	//     <tr>
	//       <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
	//     </tr>
	//     <tr>
	//       <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
	//     </tr>
	//   </table>
	// </body>
	// </html>
	// ';

	// // To send HTML mail, the Content-type header must be set
	// $headers  = 'MIME-Version: 1.0' . "\r\n";
	// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// // Additional headers
	// $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
	// $headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
	// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	// // Mail it
	// mail($to, $subject, $message, $headers);
?>