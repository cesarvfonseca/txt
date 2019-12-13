<?php 	
	$accion = $_POST['accion'];

	if ($accion == 'consulta') 
	{
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		$employeeID = $_POST['employeeID'];
		// die(json_encode($_POST));
	include '../function/connection.php';
	//$query = "EXEC p1solicitudEmpleado @numero_nomina = ?, @fecha_ini = ?, @fecha_fin = ?";
	$query = "EXEC p1solicitudEmpleado ?,?,?";
	$params = array($employeeID,$fechaINI, $fechaFIN);

	$stmt = sqlsrv_query( $con, $query, $params);

	$result = array();

	if( $stmt === false) {
		die( print_r( sqlsrv_errors(), true) );
		$respuesta = array(
			'estado' => 'error',
			'tipo' => 'error',
			'informacion' => 'No existe informacion',
			'mensaje' => 'No hay datos en la BD'                
		);
	} else {
		do {
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
			$result[] = $row; 
			}
		} while (sqlsrv_next_result($stmt));
		$respuesta = array(
			'estado' => 'correcto',
			'tipo' => 'success',
			'informacion' => $result,
			'mensaje' => 'Informacion obtenida de buscar'                
		);
	}


	echo json_encode($respuesta);
	sqlsrv_free_stmt( $stmt);
	sqlsrv_close( $con );
	}

	if ($accion == 'consulta_jefe') 
	{
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		$emp_aut = $_POST['empleado_aut'];
		$employeeID = $_POST['employeeID'];
		// die(json_encode($_POST));
		include '../function/connection.php';
		$query = "EXEC p1solicitudJefe ?,?,?";
			$params = array( $emp_aut, $fechaINI, $fechaFIN );
		
			$stmt = sqlsrv_query( $con, $query, $params);

			$result = array();
		
			if( $stmt === false) {
				die( print_r( sqlsrv_errors(), true) );
				$respuesta = array(
					'estado' => 'error',
					'tipo' => 'error',
					'informacion' => 'No existe informacion',
					'mensaje' => 'No hay datos en la BD'                
				);
			} else {
				do {
					while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
					$result[] = $row; 
					}
				} while (sqlsrv_next_result($stmt));
				$respuesta = array(
					'estado' => 'correcto',
					'tipo' => 'success',
					'informacion' => $result,
					'mensaje' => 'Informacion obtenida de buscar'                
				);
			}
		
		
			echo json_encode($respuesta);
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close( $con );
	}

	//CONSULTA JEFE CORREO
	if ($accion == 'consulta_jefe_correo') 
	{
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		$emp_aut = $_POST['empleado_aut'];
		$employeeID = $_POST['employeeID'];
		// die(json_encode($_POST));
		include '../function/connection.php';
		$query = "EXEC p1solicitudEmpleado ?,?,?";
		$params = array( $employeeID, $fechaINI, $fechaFIN );
		$stmt = sqlsrv_query( $con, $query, $params);

		$result = array();
	
		if( $stmt === false) {
			die( print_r( sqlsrv_errors(), true) );
			$respuesta = array(
				'estado' => 'error',
				'tipo' => 'error',
				'informacion' => 'No existe informacion',
				'mensaje' => 'No hay datos en la BD'                
			);
		} else {
			do {
				while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
				$result[] = $row; 
				}
			} while (sqlsrv_next_result($stmt));
			$respuesta = array(
				'estado' => 'correcto',
				'tipo' => 'success',
				'informacion' => $result,
				'mensaje' => 'Informacion obtenida de buscar'                
			);
		}
	
	
		echo json_encode($respuesta);
		sqlsrv_free_stmt( $stmt);
		sqlsrv_close( $con );
	}

	if($accion == 'obtenerMotivos')
	{
		// die(json_encode($_POST));
		include '../function/connection.php';

		$query = "SELECT code_value,code_value_desc FROM PJCODE WHERE code_type = 'RI' ORDER BY crtd_datetime";
                
		$stmt = sqlsrv_query( $con, $query);
		
		$result = array();
		
		if( $stmt === false) {
			die( print_r( sqlsrv_errors(), true) );
			$respuesta = array(
				'estado' => 'NOK',
				'tipo' => 'error',
				'informacion' => 'No existe informacion',
				'mensaje' => 'No hay datos en la BD'                
			);
		} else {
			do {
				while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
				$result[] = $row; 
				}
			} while (sqlsrv_next_result($stmt));
			$respuesta = array(
				'estado' => 'OK',
				'tipo' => 'success',
				'informacion' => $result,
				'mensaje' => 'Informacion obtenida'                
			);
		}               

		echo json_encode($respuesta);
		sqlsrv_free_stmt( $stmt);
		sqlsrv_close( $con ); 
	}

	//CONSULTA TABLA PERSONAL
	if ($accion == 'tabla-personal') 
	{
		$employeeID = $_POST['param'];
		// die(json_encode($_POST));
		include '../function/connection.php';
		$query = "SELECT
					txt.employee,te.nombre_largo,
					SUM(CASE WHEN txt.tipo = '1' THEN txt.horas ELSE 0 END) AS txt_favor,
					SUM(CASE WHEN txt.tipo = '2' THEN txt.horas ELSE 0 END) AS txt_contra,
					SUM(CASE WHEN txt.tipo = '1' THEN txt.horas ELSE 0 END)-SUM(CASE WHEN txt.tipo = '2' THEN txt.horas ELSE 0 END) AS txt_saldo,
					SUM(CASE WHEN txt.tipo = '3' THEN txt.dias ELSE 0 END) AS dias
					FROM P1TXTVAC AS txt
					INNER JOIN PJEMPLOY AS pe
					ON txt.employee = pe.employee
					INNER JOIN tbempleados AS te
					ON txt.employee = te.numero_nomina
					WHERE pe.manager1 = ? AND txt.jefe_autorizacion = 1
					GROUP BY txt.employee,te.nombre_largo";
			$params = array( $employeeID );
		// $params = array( $employeeID, $fechaINI, $fechaFIN );
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
		//die(json_encode($_POST));
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		$valorBuscado = $_POST['valorBuscado'];
		include '../function/connection.php';
		if (empty($valorBuscado)){
			$query = "EXEC p1solicitudRHRango ?,?";
			$params = array( $fechaINI, $fechaFIN );
		}
		else{
			$query = "EXEC p1solicitudRHParametro ?,?,?";
			$params = array($valorBuscado,$fechaINI, $fechaFIN);
		}
		//$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $con, $query, $params);

		$result = array();
	
		if( $stmt === false) {
			die( print_r( sqlsrv_errors(), true) );
			$respuesta = array(
				'estado' => 'error',
				'tipo' => 'error',
				'informacion' => 'No existe informacion',
				'mensaje' => 'No hay datos en la BD'                
			);
		} else {
			do {
				while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
				$result[] = $row; 
				}
			} while (sqlsrv_next_result($stmt));
			$respuesta = array(
				'estado' => 'correcto',
				'tipo' => 'success',
				'informacion' => $result,
				'mensaje' => 'Informacion obtenida de buscar'                
			);
		}
	
	
		echo json_encode($respuesta);
		sqlsrv_free_stmt( $stmt);
		sqlsrv_close( $con ); 
	}
	
	if ( $accion == 'consulta_nominas' ) 
	{
		//die(json_encode($_POST));
		$fechaINI = $_POST['fechaINI'];
		$fechaFIN = $_POST['fechaFIN'];
		// $valorBuscado = $_POST['valorBuscado'];
		include '../function/connection.php';
		
		$query = "SELECT CONCAT(te.numero_nomina,CONVERT(VARCHAR(10), p1.crtd_datetime, 112),replace(convert(varchar(4), p1.crtd_datetime,108),':','')) AS id_reg,
					te.numero_nomina,te.nombre_largo,tc.nombre AS Departamento,MIN(p1.fecha) AS fechaINI,MAX(p1.fecha) AS fechaFIN,p1.rh_vobo,
					COUNT(*) AS dias
					FROM P1TXTVAC AS p1
					INNER JOIN tbempleados AS te
					ON te.numero_nomina = p1.employee
					INNER JOIN tbcelula AS tc
					ON tc.id_celula = te.id_celula
					AND p1.tipo = 3 
					AND p1.jefe_autorizacion = 1
					AND p1.fecha >= ? AND p1.fecha <= ?
					AND p1.rh_vobo = 1
					AND te.status <> 'B'
					GROUP BY CONCAT(te.numero_nomina,CONVERT(VARCHAR(10), p1.crtd_datetime, 112),replace(convert(varchar(4), p1.crtd_datetime,108),':','')),te.numero_nomina,te.nombre_largo,tc.nombre,p1.rh_vobo
					ORDER BY te.numero_nomina
					";
		$params = array($fechaINI, $fechaFIN);
		//$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $con, $query, $params);

		$result = array();
	
		if( $stmt === false) {
			die( print_r( sqlsrv_errors(), true) );
			$respuesta = array(
				'estado' => 'error',
				'tipo' => 'error',
				'informacion' => 'No existe informacion',
				'mensaje' => 'No hay datos en la BD'                
			);
		} else {
			do {
				while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
				$result[] = $row; 
				}
			} while (sqlsrv_next_result($stmt));
			$respuesta = array(
				'estado' => 'correcto',
				'tipo' => 'success',
				'informacion' => $result,
				'mensaje' => 'Informacion obtenida de buscar'                
			);
		}
	
	
		echo json_encode($respuesta);
		sqlsrv_free_stmt( $stmt);
		sqlsrv_close( $con ); 
	}

 ?>