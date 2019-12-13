<h1>Salidas por Trabajo</h1>
<div class="row">
	<div class="col-md-12">	
		<form method="POST" class="form" role="form" id="txtForm">
			<div class="form-row">
				<div class="col-md-4 mb-2">
					<label>Elegir fecha</label>
					<input type="date" id="txtFechat" max="3000-12-31"  min="1000-01-01" class="form-control" required value="<?php echo date("Y-m-d");?>">
				</div>
				<div class="col-md-4 mb-2">
					<label for="txtHoras">Horas</label>
					<input type="number" class="form-control" id="txtHorast" placeholder="Ingresar Horas a favor" required>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-12 mb-6">
					<label>Razón</label>
					<textarea class="form-control" id="txtRazont" rows="3" required></textarea>
				</div>
			</div>
			<div class="form-row" id="agregar-txt" action="#">	
				<div class="col-md-6 mb-3">
					<label>Jefe directo</label>
					<input type="text" class="form-control" id="txtNamet" value="<?php echo	$managerName;?>" disabled>
				</div>
				<div class="col-md-6 mb-3">
					<label>Correo jefe directo</label>
					<input type="text" class="form-control" id="txtMailt" value="<?php echo	$managerMail;?>" disabled>
				</div>
			</div>
			<br>	
			<input type="submit" class="btn btn-success salida-trabajo" id="salida-trabajo" value="Enviar">
			<input type="hidden" id="typet" value="salidaTrabajo">
			<input type="hidden" id="employeeID" value="<?php echo $_SESSION["user1"];?>">
		</form>
	</div>
</div>
