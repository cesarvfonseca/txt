<?php
	session_start();

	if (empty($_REQUEST['request']))
	$request='';
		else
	$request=$_REQUEST['request'];

	include '../menu.php';
	include '../conexion_sis.php';

	if (!isset($_SESSION['user1']))
   {
      header("location: ../");
   }
   $usuario = $_SESSION['user1'];
   
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="<?php echo serverurl; ?>img/q.ico" type="image/x-icon">
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
	
	<style>
		input{
			border-radius: 24px !important;
		}
	</style>
</head>
<body>
	<header>
		<?php
			menuotro();
		 ?>
		 <br>

	</header>

	<div style="margin: 50px 0; background-color: white;"></div>
	 <div class="container-fluid m-4">
	 	<div class="row">
	 		<div class="col-md-12">
				<?php
					if (empty($usuario)){
						header("Location: ../");
					} else if (isset($_SESSION['user1']) || $_SESSION['user1']) {
						//include('inc/templates/autorizar.php');
						if ($request == '') {
							include('inc/templates/main-page.php');
						} else if ($request=='rrhh') {
							include('inc/templates/rrhh.php');
						} else if ($request=='nominas') {
							include('inc/templates/nominas.php');
						} elseif ($request=='autorizar') {
							include('inc/templates/autorizar.php');
						}
					}

				 ?>
	 		</div>
	 	</div>
	 </div>

	<?php include 'inc/templates/footer.php'; ?>

	</body>
</html>
