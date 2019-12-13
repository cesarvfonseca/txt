<h1>Tiempo por tiempo en contra</h1>
<div class="row">
	<div class="col-md-12">	
		<form method="POST" class="form" role="form" id="txtcForm">
			<div class="form-row">
				<div class="col-md-4 mb-2">
					<label >Elegir fecha</label>
					<input type="date" id="txtFechac" max="3000-12-31"  min="1000-01-01" class="form-control" required value="<?php echo date("Y-m-d");?>">
				</div>

				<div class="col-md-4 mb-2">
					<label>Horas</label>
					<input type="number" class="form-control" id="txtHorasc" placeholder="Ingresar Horas en contra" required>
				</div>

				<div class="col-md-4 mb-2">
					<label for="txtMotivo">Motivo</label>
        			<select class="form-control txtMotivo" id="txtMotivoC"></select>
				</div>
			</div>


			<div class="form-row">
				<div class="col-md-12 mb-6">
					<label>Razón</label>
					<textarea class="form-control" id="txtRazonc" rows="3"></textarea>
				</div>
			</div>
			<div class="form-row" id="agregar-txt" action="#">	
				<div class="col-md-6 mb-3">
					<label>Jefe directo</label>
					<input type="text" class="form-control" id="txtNamec" value="<?php echo	$managerName;?>" disabled>
				</div>
				<div class="col-md-6 mb-3">
					<label>Correo jefe directo</label>
					<input type="text" class="form-control" id="txtMailc" value="<?php echo	$managerMail;?>" disabled>
				</div>
			</div>
			<br>	
			<input type="submit" class="btn btn-success nuevo-txtc" id="" value="Enviar TXTC">
			<input type="hidden" id="typec" value="txtc">
			<input type="hidden" id="employeeIDc" value="<?php echo $_SESSION["user1"];?>">
		</form>
	</div>
</div>
