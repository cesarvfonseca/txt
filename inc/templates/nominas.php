<div class="row">
    <h1>Panel Nominas MEXQ</h1>
    <hr>
    <div class="col-md-12">
        <hr>
        <h3>Seleccionar un periodo</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
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
                <div class="form-group col-md-2 offset-1">
                    <button class="btn btn-info btn-block mt-1" id="btnRangoNominas" role="button">Buscar <i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-3">
        <!-- <input type="text" name="txtBuscar" id="txtBuscarNominas" placeholder="Buscar empleado" class="form-control" disabled /> -->
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="form-group col-md-1 offset-10">
			<button class="btn btn-success ml-3 exportTableNominas" title="Exportar tabla"><i class="fas fa-file-excel"></i> Exportar tabla</button>	
		</div>
	</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 table-responsive-lg">
            <table id="tablaNominas" class="table table-striped table-bordered table-hover text-left table-sm">
                <thead class="text-center">
                    <th>Nomina</th>
                    <th>Empleado</th>
                    <th>Departamento</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
					<th>Dias</th>
                </thead>
                <tbody id="tablanominas">  

                </tbody>
            </table>
        </div>
        <div class="alert alert-info" id="avisoR" role="alert">
          Eligir un periodo.
        </div>
        <div class="alert alert-warning" id="alertaR" role="alert">
          No hay información disponible.
        </div>      
    </div>
</div>

