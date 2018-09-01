<?php 	
	$accion = $_POST['accion'];

	if ($accion == 'consulta') 
	{
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		$employeeID = $_POST['employeeID'];
		// die(json_encode($_POST));
	include '../function/connection.php';
	$query = "SELECT
					employee,
					CASE
					 WHEN tipo = 1
						THEN 'TXT A FAVOR'
					 WHEN tipo = 2
						THEN 'TXT EN CONTRA'
					 WHEN tipo = 3
						THEN 'VACACIONES'
					 END AS tipo_incidencia,
					CASE
						WHEN jefe_autorizacion=0
							THEN 'Pendiente'
						WHEN jefe_autorizacion=1
							THEN 'Autorizado'
						ELSE 'No Autorizado'
					END as voboJefe,
					CASE
						WHEN rh_vobo=0
							THEN 'Pendiente'
						WHEN rh_vobo=1
							THEN 'Autorizado'
						ELSE 'No Autorizado'
					END as voboRH,
					 fecha,
					 id,
					 tipo,
					 horas,
					 dias,
					 emp_observaciones,
					 jefe_observaciones,
					 rh_observaciones
					FROM P1TXTVAC WHERE employee = ? AND fecha >= ? AND fecha <= ?";
		$params = array( $employeeID, $fechaINI, $fechaFIN );
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $con, $query, $params, $options );

		$result_num = sqlsrv_num_rows( $stmt ); 

		if ($result_num>0) {
			for($i = 0; $i < $result_num; $i++){
	            $data[] = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	        }

			$respuesta = array(
	            'estado' => 'correcto',
	            'informacion'  => $data
	        );
		} else {
			$respuesta = array(
	            'estado' => 'error',
	            'informacion'  => 'No hay informacion disponible.'
	        );
		}

		echo json_encode($respuesta);
	}

	if ($accion == 'consulta_jefe') 
	{
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		// $valorBuscado = $_POST['valorBuscado'];
		$employeeID = $_POST['employeeID'];
		// die(json_encode($_POST));
		include '../function/connection.php';
		$query = "SELECT 
						CASE
						 WHEN tipo = 1
							THEN 'TXT A FAVOR'
						 WHEN tipo = 2
							THEN 'TXT EN CONTRA'
						 WHEN tipo = 3
							THEN 'VACACIONES'
						 END AS tipo_incidencia,
						jefe_autorizacion,
							CASE
								WHEN jefe_autorizacion=0
									THEN 'Pendiente'
								WHEN jefe_autorizacion=1
									THEN 'Autorizado'	
								ELSE 'No Autorizado'
							END as voboJefe,
						rh_vobo,
							CASE
								WHEN rh_vobo=0
									THEN 'Pendiente'
								WHEN rh_vobo=1
									THEN 'Autorizado'
								ELSE 'No Autorizado'
							END as voboRH,
						txt.id,
						txt.jefe_autorizacion,
						txt.employee,
						txt.fecha,
						txt.tipo,
						txt.horas,
						txt.dias,
						txt.emp_observaciones,
						txt.jefe_observaciones,
						txt.rh_observaciones,
						pe.emp_name
						FROM P1TXTVAC txt
						INNER JOIN PJEMPLOY pe
						ON txt.employee = pe.employee
						WHERE pe.manager1= ? AND fecha >= ? AND fecha <= ?;";
		$params = array( $employeeID, $fechaINI, $fechaFIN );
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $con, $query, $params, $options );

		$result_num = sqlsrv_num_rows( $stmt ); 

		if ($result_num>0) {
			for($i = 0; $i < $result_num; $i++){
	            $data[] = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	        }

			$respuesta = array(
	            'estado' => 'correcto',
	            'informacion'  => $data
	        );
		} else {
			$respuesta = array(
	            'estado' => 'error',
	            'informacion'  => 'No hay informacion disponible.'
	        );
		}

		echo json_encode($respuesta);
	}
 	// CONSULTA RH
	if ( $accion == 'consulta_rh' ) 
	{
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		$valorBuscado = $_POST['valorBuscado'];
		// die(json_encode($_POST));
		include '../function/connection.php';
		$query = "SELECT 
						CASE
						 WHEN tipo = 1
							THEN 'TXT A FAVOR'
						 WHEN tipo = 2
							THEN 'TXT EN CONTRA'
						 WHEN tipo = 3
							THEN 'VACACIONES'
						 END AS tipo_incidencia,
						jefe_autorizacion,
							CASE
								WHEN jefe_autorizacion=0
									THEN 'Pendiente'
								WHEN jefe_autorizacion=1
									THEN 'Autorizado'	
								ELSE 'No Autorizado'
							END as voboJefe,
						rh_vobo,
							CASE
								WHEN rh_vobo=0
									THEN 'Pendiente'
								WHEN rh_vobo=1
									THEN 'Autorizado'
								ELSE 'No Autorizado'
							END as voboRH,
						txt.id,
						txt.jefe_autorizacion,
						txt.employee,
						txt.fecha,
						txt.tipo,
						txt.horas,
						txt.dias,
						txt.emp_observaciones,
						txt.jefe_observaciones,
						txt.rh_observaciones,
						txt.rh_vobo,
						pe.emp_name,
						d.deptname
						FROM P1TXTVAC txt
						INNER JOIN PJEMPLOY pe
						ON txt.employee = pe.employee
						INNER JOIN userinfo ui 
						ON txt.employee = ui.identitycard
						INNER JOIN departments d
						ON ui.defaultdeptid = d.deptid";
			if (empty($valorBuscado)){
				$query .=	" WHERE fecha >= ? AND fecha <= ? AND jefe_autorizacion<>0;";
				$params = array( $fechaINI, $fechaFIN );
			}
			else{
				$query .=	" WHERE fecha >= ? AND fecha <= ? AND jefe_autorizacion<>0 AND pe.emp_name LIKE '%' + CONVERT(NVARCHAR, ?) + '%';";
				$params = array( $fechaINI, $fechaFIN, $valorBuscado );
			}
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $con, $query, $params, $options );

		$result_num = sqlsrv_num_rows( $stmt ); 

		if ($result_num>0) {
			for($i = 0; $i < $result_num; $i++){
	            $data[] = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	        }

			$respuesta = array(
	            'estado' => 'correcto',
	            'informacion'  => $data
	        );
		} else {
			$respuesta = array(
	            'estado' => 'error',
	            'informacion'  => 'No hay informacion disponible.'
	        );
		}

		echo json_encode($respuesta);
	}	

 ?>