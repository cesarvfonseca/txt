<?php
#PDO COMENTADO
$accion = $_POST['accion'];
//VERIFICAR QUE LA ACCION PROVIENE DEL FORM DE LOGIN
if ($accion == 'login')
{
   include '../function/connection.php';
   $usuario = $_POST['usuario'];
   $password = $_POST['password'];
   //HASHEAR LA CONTRASEÑA INGRESADA EN EL ACCESO
   $password = hash('sha512',$password);
   try{
    $query = "SELECT pe.employee,pe.emp_name,pe.emp_status,aw.password,aw.counter_login,aw.estado
    FROM PJEMPLOY pe
    INNER JOIN P1ACCESOWEB aw
    ON pe.employee = aw.employee
    WHERE pe.employee = ?";
    $params = array( $usuario );
    $stmt = sqlsrv_query( $con, $query, $params );

    if ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
     $passwordDB = trim($row['password']);
     $employeeName = trim(ucwords(strtolower($row['emp_name'])));
     $employee = trim($row['employee']);
     $employee_status = trim($row['emp_status']);
     $estado_conexion = trim($row['estado']);
     $counter = trim($row['counter_login']);
     $estado_en_linea = 1;
     //VERIFICAR QUE EL EMPLEADO ESTE ACTIVO EN EL SISTEMA
     if ($employee_status === 'A') {
        if ($password === $passwordDB) {
            if ($estado_conexion === '0') {
                session_start();
                $_SESSION["userActive"] = trim($row['employee']);
                $_SESSION["userName"] = $employeeName;
                $_SESSION["loginStatus"] = true;
                $respuesta = array(
                    'estado' => 'correcto',
                    'nombre' => $employeeName,
                    'tipo' => $accion
                );
            //ACTUALIZAR CONTADOR DE SESIONES
                $counter++;
                $queryUpdate = "UPDATE P1ACCESOWEB SET last_login_datetime = GETDATE(),counter_login = ?, estado = ? WHERE employee = ?";
                $params = array( $counter, $estado_en_linea, $employee );
                $stmtUpd = sqlsrv_query( $con, $queryUpdate, $params );
                sqlsrv_free_stmt( $stmtUpd);
            }else{
                $respuesta = array(
                    'estado' => 'error',
                    'informacion'  => 'La sesión esta activa'
                );
            }
        }else{
           $respuesta = array(
            'estado' => 'error',
            'informacion'  => 'Error usuario y/o contraseña equivocados'
        );
       }
   }else{
    $respuesta = array(
        'estado' => 'error',
        'informacion'  => 'El trabajador esta inactivo en el sistema'
    );
}
} else {
    $respuesta = array(
        'estado' => 'error',
        'informacion'  => 'Error usuario y/o contraseña equivocados'
    );
}
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $con );
}catch(PDOException $e) {
    // En caso de un error, tomar la exepcion
   $respuesta = array(
    'pass' => $e->getMessage()
);
}
echo json_encode($respuesta);
}

if ($accion == 'salir')
{
    session_start();
    include '../function/connection.php';
    $employee = $_POST["employee_id"];
    $estado_en_linea = 0;
    $queryUpdate = "UPDATE P1ACCESOWEB SET estado = ? WHERE employee = ?";
    $params = array( $estado_en_linea, $employee );
    $stmt = sqlsrv_query( $con, $queryUpdate, $params );
    sqlsrv_free_stmt( $stmt);
    sqlsrv_close( $con );
    
    session_destroy();
    $_SESSION = array();

    $respuesta = array(
        'estado' => 'correcto',
        'informacion'  => 'Saliendo de la sesión'
    );
    echo json_encode($respuesta);
}

if ($accion == 'txt' || $accion == 'txtc')
{
    include '../function/connection.php';
    $fecha = $_POST['fecha'];
    $horas = $_POST['horas'];
    $razon = $_POST['razon'];
    $employeeID = $_POST["employeeID"];
    try{
        if ($accion == 'txt')
            $tipo = 1;
        else
            $tipo = 2;
        $insert_qry = "INSERT INTO P1TXTVAC (employee,fecha,tipo,horas,emp_observaciones,crtd_user,lupd_datetime,lupd_user)
        VALUES (?,?,?,?,?,?,GETDATE(),?)";
        $params = array( $employeeID, $fecha, $tipo, $horas, $razon, $employeeID, $employeeID);
        $stmt = sqlsrv_query( $con, $insert_qry, $params );
        if( $stmt ) {
            $respuesta = array(
                'estado' => 'correcto'
            );
        }else{
            die( print_r( sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $con );
    }catch(PDOException $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
            'estado' => 'error',
            'log' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}

//EDITAR INCIDENCIAS DEL Empleado
if ($accion == 'editar_incidencia')
{
    // die(json_encode($_POST));
    include '../function/connection.php';
    $horas = $_POST['horas'];
    $idempleado = $_POST['idempleado'];
    $idmov = $_POST['idmov'];
    try{
        $queryv = "SELECT jefe_autorizacion FROM P1TXTVAC WHERE id=?";
        $params = array( $idmov );
        $stmt_verificar_autorizacion = sqlsrv_query( $con, $queryv, $params );
        if( $stmt_verificar_autorizacion ) {
            if ($row = sqlsrv_fetch_array( $stmt_verificar_autorizacion, SQLSRV_FETCH_ASSOC)) {
              $estado = $row['jefe_autorizacion'];
              if ($estado == 0) {
                $update_qry = "UPDATE P1TXTVAC SET horas = ?, lupd_datetime = GETDATE(), lupd_user = ? WHERE id = ?";
                $params = array( $horas, $idempleado, $idmov);
                $stmt = sqlsrv_query( $con, $update_qry, $params );
                if( $stmt ) {
                    $respuesta = array(
                        'estado' => 'correcto',
                        'informacion' => 'La incidencia ha sido actualizada!'
                    );
                }else{
                    die( print_r( sqlsrv_errors(), true));
                }
                sqlsrv_free_stmt( $stmt);
            }else{
                $respuesta = array(
                    'estado' => 'incorrecto',
                    'informacion' => 'Ya esta validada por tu jefe directo'
                );
            }
        }
    } else {
        die( print_r( sqlsrv_errors(), true));
    }
    sqlsrv_free_stmt( $stmt_verificar_autorizacion );
    sqlsrv_close( $con );
}catch(PDOException $e) {
        // En caso de un error, tomar la exepcion
    $respuesta = array(
        'estado' => 'error',
        'log' => $e->getMessage()
    );
}
echo json_encode($respuesta);
}

//ELIMINAR INCIDENCIAS DEL EMPLEADO
if ($accion == 'eliminar_incidencia')
{
    // die(json_encode($_POST));
    include '../function/connection.php';
    $id_mov = $_POST['id_mov'];
    try{
        $queryv = "SELECT jefe_autorizacion FROM P1TXTVAC WHERE id= ?";
        $params = array( $id_mov );
        $stmt_verificar_autorizacion = sqlsrv_query( $con, $queryv, $params );
        if( $stmt_verificar_autorizacion ) {
            if ($row = sqlsrv_fetch_array( $stmt_verificar_autorizacion, SQLSRV_FETCH_ASSOC)) {
              $estado = $row['jefe_autorizacion'];
              if ($estado==0) {
                $delete_qry = "DELETE FROM P1TXTVAC WHERE id= ?";
                $params = array( $id_mov );
                $stmt = sqlsrv_query( $con, $delete_qry, $params );
                if( $stmt ) {
                    $respuesta = array(
                        'estado' => 'correcto',
                        'informacion' => 'La incidencia ha sido eliminada!'
                    );
                }else{
                 die( print_r( sqlsrv_errors(), true)); 
             }
             sqlsrv_free_stmt( $stmt );
         }else{
            $respuesta = array(
                'estado' => 'incorrecto',
                'informacion' => 'Ya esta validada por tu jefe directo'
            );
        }
    }
}else {
    die( print_r( sqlsrv_errors(), true));
}
sqlsrv_free_stmt( $stmt_verificar_autorizacion );
sqlsrv_close( $con );
}catch(PDOException $e) {
        // En caso de un error, tomar la exepcion
    $respuesta = array(
        'estado' => 'error',
        'log' => $e->getMessage()
    );
}
echo json_encode($respuesta);
}

//AUTORIZACION DEL JEFE
if ($accion == 'voboJefe')
{
    // die(json_encode($_POST));
    include '../function/connection.php';
    $idM = $_POST['id'];
    $status = $_POST['status'];
    $employeeID = $_POST['idempleado'];
    $observaciones_default = $_POST['observaciones_default'];
    try{
        $update_qry = "UPDATE P1TXTVAC SET jefe_autorizacion= ?, lupd_datetime=GETDATE(), lupd_user= ?,jefe_observaciones= ? WHERE id= ?";
        $params = array( $status,$employeeID,$observaciones_default,$idM );
        $stmt = sqlsrv_query( $con, $update_qry, $params );
        if( $stmt ) {
            $respuesta = array(
                'estado' => 'correcto'
            );
        }else{
            die( print_r( sqlsrv_errors(), true)); 
        }
        sqlsrv_free_stmt( $stmt );
    }catch(PDOException $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
            'estado' => 'error',
            'log' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}

//VISTO BUENO RH
if ($accion == 'voboRH')
{
    // die(json_encode($_POST));
    include '../function/connection.php';
    $idM = $_POST['id'];
    $status = $_POST['status'];
    $employeeID = $_POST['idempleado'];
    $observaciones_default = $_POST['observaciones_default'];
    try{
        $update_qry = "UPDATE P1TXTVAC SET rh_vobo = ?, lupd_datetime=GETDATE(), lupd_user= ?,rh_observaciones= ? WHERE id= ?";
        $params = array( $status,$employeeID,$observaciones_default,$idM );
        $stmt = sqlsrv_query( $con, $update_qry, $params );
        if( $stmt ) {
            $respuesta = array(
                'estado' => 'correcto'
            );
        }else{
            die( print_r( sqlsrv_errors(), true)); 
        }
        sqlsrv_free_stmt( $stmt );
    }catch(PDOException $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
            'estado' => 'error',
            'log' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}


//ELIMINAR REGISTROS ANTIGUOS
if ($accion == 'eliminar_regviejos') {
    // die(json_encode($_POST));
    include '../function/connection.php';
    $id_empleado = $_POST['id_empleado'];
    $name;
    $queryVerify = "SELECT id,jefe_autorizacion,DATEDIFF(D,crtd_datetime,GETDATE()) AS dias_previos FROM P1TXTVAC WHERE employee = ?";
    $params = array( $id_empleado );
    $stmt = sqlsrv_query( $con, $queryVerify, $params );
    if( $stmt === false ) {
         die( print_r( sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
        $idmovimiento = $row ["id"];
        $autorizacion = $row ["jefe_autorizacion"];
        $dias = $row ["dias_previos"];
        if ($autorizacion == 2 && $dias > 22) {
            $queryDelete = "DELETE FROM P1TXTVAC WHERE id= ?";
            $params = array( $idmovimiento );
            $stmt_borrar = sqlsrv_query( $con, $queryDelete, $params );
            if( $stmt_borrar === false ) {
                 die( print_r( sqlsrv_errors(), true));
            }
            $rows_affected = sqlsrv_rows_affected( $stmt_borrar);
            if( $rows_affected === false) {
                 die( print_r( sqlsrv_errors(), true));
                $respuesta = array(
                    'estado' => 'error',
                    'informacion' => 'Error en la eliminación de los datos'
                    );                 
            } elseif( $rows_affected == -1) {
                $respuesta = array(
                    'estado' => 'error',
                    'informacion' => 'No hay informacion antigua para eliminar'
                    );
            } else {
                $respuesta = array(
                    'estado' => 'correcto',
                    'informacion' => 'Registroas Antiguos Eliminados'
                    );
            }
            sqlsrv_free_stmt( $stmt_borrar );            
        }
    $respuesta = array(
        'estado' => 'correcto',
        'informacion' => 'No hay informacion antigua para eliminar'
    );        
    }

    sqlsrv_free_stmt( $stmt );

    echo json_encode( $respuesta );
}
//ELIMINAR REGISTROS ANTIGUOS


//CALCULAR VACACIONES
if ($accion == 'vacaciones')
{
    $feriados = array(
    '1-1', // Año Nuevo (irrenunciable)
    '10-4', // Viernes Santo (feriado religioso)
    '11-4', // Sábado Santo (feriado religioso)
    '1-5', // Día Nacional del Trabajo (irrenunciable)
    '21-5', // Día de las Glorias Navales
    '29-6', // San Pedro y San Pablo (feriado religioso)
    '16-7', // Virgen del Carmen (feriado religioso)
    '15-8', // Asunción de la Virgen (feriado religioso)
    '19-9', // Dia Festivo De Prueba
    '12-10', // Aniversario del Descubrimiento de América
    '31-10', // Día Nacional de las Iglesias Evangélicas y Protestantes (feriado religioso)
    '1-11', // Día de Todos los Santos (feriado religioso)
    '8-12', // Inmaculada Concepción de la Virgen (feriado religioso)
    '13-12', // elecciones presidencial y parlamentarias (puede que se traslade al domingo 13)
    '25-12', // Natividad del Señor (feriado religioso) (irrenunciable)
);
    include '../function/connection.php';
    $fechaINI = $_POST['fechaINI'];
    $fechaFIN = $_POST['fechaFIN'];
    $razon = $_POST['razon'];
    $employeeID = $_POST['employeeID'];
    $NOW = date('Y-m-d');
    $param = 1;
    $tipo = 3;
    $dias_habiles = DiasHabiles($fechaINI, $fechaFIN);
    $cant = count($dias_habiles);
    try{
        for ($i=0; $i < $cant ; $i++)
        {
            $dia = $dias_habiles[$i];
            $fecha = getdate($dia);
            $feriado = $fecha['mday'].'-'.$fecha['mon'];
            //EVALUAR SABADOS / DOMINGOS / DIAS FERIADOS
            if (!(($fecha["wday"]==0 || $fecha["wday"]==6)||(in_array($feriado,$feriados))))
            {
                $fechaSQL = $fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"];
                $insert_vac = "INSERT INTO P1TXTVAC (employee,fecha,tipo,dias,emp_observaciones,crtd_user,lupd_datetime,lupd_user)
                VALUES (?,?,?,?,?,?,?,?)";
                $params = array( $employeeID,$fechaSQL,$tipo,$param,$razon,$employeeID,$NOW,$employeeID );
                $stmt = sqlsrv_query( $con, $insert_vac, $params );
                if( $stmt === false ) {
                     die( print_r( sqlsrv_errors(), true));
                }
            }
        }
        $respuesta = array(
            'estado' => 'correcto'
        );
        $stmt = null;
        $conn = null;
    }catch(PDOException $e) {
            // En caso de un error, tomar la exepcion
        $respuesta = array(
            'estado' => 'error',
            'log' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}

function DiasHabiles($fecha_inicial,$fecha_final)
{
    $newArray = array();
    list($year,$mes,$dia) = explode("-",$fecha_inicial);
    $ini = mktime(0, 0, 0, $mes , $dia, $year);
    list($yearf,$mesf,$diaf) = explode("-",$fecha_final);
    $fin = mktime(0, 0, 0, $mesf , $diaf, $yearf);

    $r = 0;
    while($ini != $fin)
    {
        $ini = mktime(0, 0, 0, $mes , $dia+$r, $year);
        $newArray[] .=$ini;
        $r++;
    }
    return $newArray;
}

function diasFeriados(){

}

?>
