<h1>Permiso con Goce de Salario (PCG)</h1>
<div class="row">
	<div class="col-md-12">	
		<form method="POST" class="form" role="form">
			<div class="form-row">
				<div class="col-md-4 mb-2">
					<label >Elegir fecha</label>
					<input type="date" id="txtFechapcg" max="3000-12-31"  min="1000-01-01" class="form-control" required value="<?php echo date("Y-m-d");?>">
				</div>

				<div class="col-md-4 mb-2">
					<label>Horas</label>
					<input type="number" class="form-control" id="txtHoraspcg" placeholder="Ingresar Horas en contra" required>
				</div>

				<div class="col-md-4 mb-2">
					<label for="txtMotivo">Motivo</label>
        			<select class="form-control txtMotivo" id="txtMotivopcg"></select>
				</div>
			</div>


			<div class="form-row">
				<div class="col-md-12 mb-6">
					<label>Razón</label>
					<textarea class="form-control" id="txtRazonpcg" rows="3"></textarea>
				</div>
			</div>
			<div class="form-row" id="agregar-txt" action="#">	
				<div class="col-md-6 mb-3">
					<label>Jefe directo</label>
					<input type="text" class="form-control" id="txtNamepcg" value="<?php echo	$managerName;?>" disabled>
				</div>
				<div class="col-md-6 mb-3">
					<label>Correo jefe directo</label>
					<input type="text" class="form-control" id="txtMailpcg" value="<?php echo	$managerMail;?>" disabled>
				</div>
			</div>
			<br>	
			<input type="submit" class="btn btn-success nuevo-txtpcg" id="nuevopcg" value="Enviar PCG">
			<input type="hidden" id="typepcg" value="pcg">
			<input type="hidden" id="employeeIDpcg" value="<?php echo $_SESSION["user1"];?>">
		</form>
	</div>
</div>
