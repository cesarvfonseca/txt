<div class="row">
	<h1>Panel incidencias</h1>
	<hr>
	<div class="col-md-12">
		<hr>
		<h3>Seleccionar un periodo</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<input type="text" name="daterange" id="daterange" class="form-control" />
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 table-responsive-sm">
			<table id="order_data" class="table table-striped table-bordered table-hover text-left table-sm">
				<thead class="text-center">
					<th>Tipo</th>
					<th>Fecha</th>
					<th>Horas</th>
					<th>Autorización del Jefe</th>
					<th>Estado RH</th>
					<th>Acción</th>
				</thead>
				<tbody id="bodyTable">	

				</tbody>
			</table>
		</div>
		<div class="alert alert-info" id="aviso" role="alert">
		  Eligir un periodo.
		</div>
		<div class="alert alert-warning" id="alerta" role="alert">
		  No hay información disponible.
		</div>		
	</div>
</div>
