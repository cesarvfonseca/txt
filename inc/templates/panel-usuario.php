<div class="row">
	<h1>Panel incidencias</h1>
	<hr>
	<div class="col-md-12">
		<hr>
		<h3>Seleccionar un periodo</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- <input type="date" name="daterange" id="daterange" class="form-control" /> -->
		<form class="text-center">
            <div class="form-row">
                <div class="form-group col-md-3 offset-1">
                    <label for="txtfechaAlta">Fecha de Inicio</label>
                    <input type="date" class="form-control text-center" id="txtFechaINI" value="<?php echo date("Y-m-d", strtotime('-7 days'));?>">
                </div>
    
                <div class="form-group col-md-3 offset-1">
                    <label for="txtfechaAlta">Fecha de Final</label>
                    <input type="date" class="form-control text-center" id="txtFechaFIN" value="<?php echo date("Y-m-d");?>">
                </div>
                <div class="form-group col-md-1 offset-1">
                    <label for="" class="text-hide">......</label>
                    <button class="btn btn-info btn-block mt-1" id="btnRangoUsuario" role="button">Mostrar <i class="fas fa-search"></i></button>
				</div>
            </div>
        </form>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="form-group col-md-1 offset-10">
			<button class="btn btn-success ml-3 exportTableE" title="Exportar tabla"><i class="fas fa-file-excel"></i> Exportar tabla</button>	
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 table-responsive-sm">
			<table id="panelEmpleado" class="table table-striped table-bordered table-hover text-left table-sm">
				<thead class="text-center">
					<th>Tipo</th>
					<th class="d-none">Motivo</th>
					<th>Comentario</th>
					<th>Fecha</th>
					<th>Entrada</th>
					<th>Salida</th>
					<th>Horas</th>
					<th>Autorización del Jefe</th>
					<th>Comentario Jefe</th>
					<th>Estado RH</th>
					<th>Comentario RH</th>
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
