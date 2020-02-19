<h1>Permiso sin Goce de Salario (PSG)</h1>
<div class="row">
	<div class="col-md-12">	
		<form method="POST" class="form" role="form">
			<div class="form-row">
				<div class="col-md-4 mb-2">
					<label >Elegir fecha</label>
					<input type="date" id="txtFechapsg" max="3000-12-31"  min="1000-01-01" class="form-control" required value="<?php echo date("Y-m-d");?>">
				</div>

				<div class="col-md-4 mb-2">
					<label>Horas</label>
					<input type="text" class="form-control horasSolicitadas" id="txtHoraspsg" placeholder="Ingresar Horas" required>
					<div class="invalid-horasSolicitadas d-none text-danger">
						Ingrese cantidad de horas valida!
					</div>
				</div>

			</div>


			<div class="form-row">
				<div class="col-md-12 mb-6">
					<label>Razón</label>
					<textarea class="form-control" id="txtRazonpsg" rows="3"></textarea>
				</div>
			</div>
			<div class="form-row" id="agregar-txt" action="#">	
				<div class="col-md-6 mb-3">
					<label>Jefe directo</label>
					<input type="text" class="form-control" id="txtNamepsg" value="<?php echo	$managerName;?>" disabled>
				</div>
				<div class="col-md-6 mb-3">
					<label>Correo jefe directo</label>
					<input type="text" class="form-control" id="txtMailpsg" value="<?php echo	$managerMail;?>" disabled>
				</div>
			</div>
			<br>	
			<input type="submit" class="btn btn-success nuevo-txtpsg" id="" value="Enviar PSG">
			<input type="hidden" id="typepsg" value="psg">
			<input type="hidden" id="employeeIDpsg" value="<?php echo $_SESSION["user1"];?>">
		</form>
	</div>

</div>
