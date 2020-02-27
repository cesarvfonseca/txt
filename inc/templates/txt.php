<h1>Tiempo por tiempo a favor</h1>
<div class="row">
	<div class="col-md-12">
		<form method="POST" class="form" role="form" id="txtForm">
			<div class="form-row">
				<div class="col-md-4 mb-2">
					<label>Elegir fecha</label>
					<input type="date" id="txtFecha" max="3000-12-31"  min="1000-01-01" class="form-control" required value="<?php echo date("Y-m-d");?>">
				</div>
				<div class="col-md-4 mb-2">
					<label for="txtHoras">Horas</label>
					<input type="number" class="form-control" id="txtHoras" placeholder="Ingresar Horas a favor" step=".5" required>
				</div>
				<div class="col-md-4 mb-2">
					<label for="txtMotivo">Motivo</label>
        			<select class="form-control txtMotivo" id="txtMotivoF"></select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-12 mb-6">
					<label>Razón</label>
					<textarea class="form-control" id="txtRazon" rows="3" required></textarea>
				</div>
			</div>
			<div class="form-row" id="agregar-txt" action="#">
				<div class="col-md-6 mb-3">
					<label>Jefe directo</label>
					<input type="text" class="form-control" id="txtName" value="<?php echo	$managerName;?>" disabled>
				</div>
				<div class="col-md-6 mb-3">
					<label>Correo jefe directo</label>
					<input type="text" class="form-control" id="txtMail" value="<?php echo	$managerMail;?>" disabled>
				</div>
			</div>
			<br>
			<input type="submit" class="btn btn-success nuevo-txt" id="" value="Enviar">
			<input type="hidden" id="type" value="txt">
			<input type="hidden" id="employeeID" value="<?php echo $_SESSION["user1"];?>">
		</form>
	</div>
</div>
