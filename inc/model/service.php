<?php 	
	$_SESSION["godLevel"] = 0;
	$employee_id = $_SESSION["user1"];
	$userType = "";
	$selectQuery = "SELECT emp_status,te.numero_nomina,te.nombre_largo,em_id03,user1,manager1,manager2, em_id24, 
					(SELECT em_id03 FROM PJEMPLOY WHERE employee=(SELECT manager1 FROM PJEMPLOY WHERE employee= ?)) correo_jefe,
					(SELECT emp_name FROM PJEMPLOY WHERE employee=(SELECT manager1 FROM PJEMPLOY WHERE employee= ?)) nombre_jefe
					FROM PJEMPLOY AS pe
					INNER JOIN tbempleados AS te
					ON te.numero_nomina = pe.employee 
					WHERE employee= ?";
	$params = array( $employee_id, $employee_id, $employee_id );
    $stmt_user1 = sqlsrv_query( $con, $selectQuery, $params );

	if( $stmt_user1 === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}

	while( $obj = sqlsrv_fetch_object( $stmt_user1)) {
		$userType = $obj -> em_id24;
		$managerMail = trim($obj -> correo_jefe);
		$managerName = ucwords(strtolower(trim($obj -> nombre_jefe)));
		$employeeName = ucwords(strtolower(trim($obj -> nombre_largo)));
		$employeeID = $obj -> numero_nomina;
	}
    sqlsrv_free_stmt( $stmt_user1 );

    // REVISAR DEPARTAMENTO
    $selectQueryDpto = "SELECT tc.nombre FROM tbempleados AS te 
						INNER JOIN tbcelula AS tc
						ON te.id_celula = tc.id_celula
						WHERE te.numero_nomina = ?";
	$params = array( $employee_id );
    $stmt_user3 = sqlsrv_query( $con, $selectQueryDpto, $params );

	if( $stmt_user3 === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}

	if( sqlsrv_fetch( $stmt_user3 ) === false) {
     die( print_r( sqlsrv_errors(), true));
	}

	$emp_depto = sqlsrv_get_field( $stmt_user3, 0);
    $emp_depto = ucwords(strtolower($emp_depto));
    sqlsrv_free_stmt( $stmt_user3 );

    //IDENTIFICAR SI EL USUARIO TIENE GENTE A SU MANDO
    $selectQuery_Jefes = "SELECT * FROM PJEMPLOY WHERE manager1=?";
	$params = array( $employee_id );
    $stmt_user2 = sqlsrv_query( $con, $selectQuery_Jefes, $params );

    $row = sqlsrv_fetch_array( $stmt_user2, SQLSRV_FETCH_ASSOC);

    if ($row>0) {
    	$_SESSION["godLevel"] = 1;
    }

    sqlsrv_free_stmt( $stmt_user2);

    //PANEL JEFE PENDIENTES
    $selectQuery_personal = "SELECT 
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
								WHERE pe.manager1= ? ORDER BY fecha ASC;";

	$params = array( $employee_id );
    $stmt_manager_panel = sqlsrv_query( $con, $selectQuery_personal, $params );
    
    if( $stmt_manager_panel === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}

	//VER PANEL DE USUARIO 
	$selectQuery = "SELECT
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
						FROM P1TXTVAC WHERE employee = ? ORDER BY fecha";
	$params = array( $employee_id );
    $stmt_emp_panel = sqlsrv_query( $con, $selectQuery, $params );

    if( $stmt_emp_panel === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}

	//VER PANEL DE USUARIO 

    // VER TIEMPO POR TIEMPO
    $total_vacaciones=0;
    $total_txt_favor=0;
    $total_txt_contra=0;
    $totales = "SELECT
					tipo,
					CASE
						WHEN tipo = 1
						THEN SUM(horas)
					END AS total_txt_favor, 
					CASE
						WHEN tipo = 2
						THEN SUM(ABS(horas))
					END AS total_txt_contra,
					CASE
						WHEN tipo = 3
						THEN SUM(dias) 
					END AS dias_gozados,
					CASE
						WHEN tipo = 3
						THEN SUM(vac_anio)-SUM(dias)
					END AS total_vacaciones
					FROM P1TXTVAC 
					WHERE employee = ? AND jefe_autorizacion = 1
					GROUP BY tipo;";

	$params = array( $employee_id );
    $stmt_txt_total = sqlsrv_query( $con, $totales, $params );

	if( $stmt_txt_total === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}

    while ($row = sqlsrv_fetch_array( $stmt_txt_total, SQLSRV_FETCH_ASSOC)){

	    $total_txt_favor .= $row['total_txt_favor'];
	    $total_txt_contra .= $row['total_txt_contra'];
	    $dias_gozados .= $row['dias_gozados'];
	    $total_vacaciones .= $row['total_vacaciones'];

	}

	sqlsrv_free_stmt( $stmt_txt_total);

	// VALIDAR MAXIMO TXT EN CONTRA
	$validarTXTC = "SELECT * FROM validacionCOVID (?)";

	$params = array( $employee_id );
    $stmt_validar_txtc = sqlsrv_query( $con, $validarTXTC, $params );

	if( $stmt_validar_txtc === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}

    while ($row = sqlsrv_fetch_array( $stmt_validar_txtc, SQLSRV_FETCH_ASSOC)){

	    $validacion_txtc .= $row['VALIDACION'];
	    $txtcSemanal .= $row['txtcSemana'];
		$txtcTotal.= $row['txtC'];
		$txtcSemanalC .= $row['horastxtcSemanales'];
	    $txtcTotalC .= $row['horastxtcTotal'];
	    $empAnt .= $row['Antiguedad'];
		$horasRestantes .= $row['horastxtcSemanales']-$row['txtcSemana'];

	}

	sqlsrv_free_stmt( $stmt_validar_txtc);

	// VALIDAR MAXIMO TXT EN CONTRA

 ?>