<h1>Vacaciones</h1>
<div class="row">
	<div class="col-md-12">	
		<form method="POST" id="vacacionesForm">
			<div class="form-row">
				<div class="col-md-6 mb-2">
					<label>Fecha inicial</label>
					<input type="date" id="fechaINI" max="3000-12-31"  min="1000-01-01" class="form-control" required value="<?php echo date("Y-m-d");?>">
				</div>

				<div class="col-md-6 mb-2">
					<label>Fecha final</label>
					<input type="date" id="fechaFIN" max="3000-12-31"  min="1000-01-01" class="form-control" required value="<?php echo date("Y-m-d");?>">
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-12 mb-6">
					<label>Razón</label>
					<textarea class="form-control" id="txtRazonv" rows="3"></textarea>
				</div>
			</div>
<!-- 			<div class="form-row">	
				<label for="validationCustom02">Correo jefe directo</label>
				<input type="text" class="form-control" id="txtMailv" value="<?php echo	$managerMail;?>" disabled>
			</div> -->
			<div class="form-row" id="agregar-txt" action="#">	
				<div class="col-md-6 mb-3">
					<label>Jefe directo</label>
					<input type="text" class="form-control" id="txtNamev" value="<?php echo	$managerName;?>" disabled>
				</div>
				<div class="col-md-6 mb-3">
					<label>Correo jefe directo</label>
					<input type="text" class="form-control" id="txtMailv" value="<?php echo	$managerMail;?>" disabled>
				</div>
			</div>			
			<br>	
			<input type="submit" class="btn btn-success nuevo-vacaciones" id="" value="Enviar">
			<input type="hidden" id="typev" value="vacaciones">
			<input type="hidden" id="employeeIDv" value="<?php echo $_SESSION["user1"];?>">

		</form>
	</div>
</div>
