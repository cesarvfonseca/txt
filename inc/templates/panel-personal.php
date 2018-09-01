<div class="row">
	<h1>Panel del personal</h1>
	<hr>
	<div class="col-md-12">
		<hr>
		<h3>Seleccionar un periodo</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<input type="text" name="daterange_manager" id="daterange_manager" class="form-control" />
	</div>
</div>
<hr>
<div class="row">		
	<div class="col-md-12">	
		<div class="col-md-12 table-responsive-sm">	
			<table id="tabla-personal" class="table table-striped table-bordered table-hover text-left table-sm">
				<thead class="bg-info text-white text-center">
					<th>Nomina</th>
					<th>Empleado</th>
					<th>Tipo</th>
					<th>Fecha</th>
					<th>Horas</th>
					<th>Estado RH</th>
					<th>Autorización</th>
				</thead>
				<tbody class="tablaPersonal">

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