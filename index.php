<?php     
	if (empty($_REQUEST['request']))
	$request='';
		else
	$request=$_REQUEST['request'];

	include '../conexion_sis.php';
	// session_start();
	include '../menu.php';
	
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>TxT y Vacaciones</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body>
	<header>
		<?php 
			menu4();
		 ?>
		 <br>	

	</header>

	 <div class="container">
	 	<div class="row">
	 		<div class="col-md-12">
				<?php 
					if (!isset($_SESSION['user1']) || empty($_SESSION['user1'])){
						header("Location: ../");
					}else if (isset($_SESSION['user1']) || $_SESSION['user1']) {
						// include('inc/templates/main-page.php');
						if ($request=='') {
							include('inc/templates/main-page.php');
						} else if ($request=='rrhh') {
							include('inc/templates/rrhh.php');
						}
					} 

				 ?>
	 		</div>
	 	</div>
	 </div>

	<?php include 'inc/templates/footer.php'; ?>

	</body>
</html>