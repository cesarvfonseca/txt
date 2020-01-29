<?php 	$emp_code_a = $_REQUEST['emp']; ?>
<?php 	$fecha_a = $_REQUEST['fechaINI']; ?>
<?php 	$fecha_b = $_REQUEST['fechaFIN']; ?>

<div class="row">
	<h1>Panel de Autorización</h1>
	<br>
	<input type="hidden" id="emp_id_a" value="<?php echo $emp_code_a; ?>">
	<input type="hidden" id="fecha_a" value="<?php echo $fecha_a; ?>">
	<input type="hidden" id="fecha_b" value="<?php echo $fecha_b; ?>">
	<input type="hidden" id="employeeID" value="<?php echo $_SESSION["user1"]; ?>" readonly>
</div>

<div class="row">		
	<div class="col-md-12">	
		<div class="col-md-12 table-responsive-sm">	
			<table id="tabla-personal" class="table table-striped table-bordered table-hover text-left table-sm">
				<thead class="bg-info text-white text-center">
					<th>Nomina</th>
					<th>Empleado</th>
					<th>Tipo</th>
					<th>Motivo</th>
					<th>Comentario</th>
					<th>Fecha</th>
					<th>Entrada</th>
					<th>Salida</th>
					<th>Horas</th>
					<th>Estado RH</th>
					<th>Comentario RH</th>
					<th>Comentario Jefe</th>
					<th>Autorización</th>
				</thead>
				<tbody id="tablaPersonal">

				</tbody>
			</table>
		</div>
		<div class="alert alert-info" id="avisoM" role="alert">
		  Eligir un periodo.
		</div>
		<div class="alert alert-warning" id="alertaM" role="alert">
		  No hay información disponible.
		</div>
	</div>
</div>
<script src="js/control.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.2/dist/sweetalert2.all.min.js"></script>