<div class="row mt-4">
    <div class="col-md-12">
        <h1 class="text-center">Reporte de Incidencias</h1>
    </div>

    <div class="col-md-6 offset-3">
        <form class="text-center">
            <div class="form-row">
                <div class="form-group col-md-3 offset-1">
                    <label for="txtfechaAlta">Fecha de Inicio</label>
                    <input type="date" class="form-control text-center" id="txtFechaINInb" value="<?php echo date("Y-m-d", strtotime('-7 days'));?>">
                </div>
    
                <div class="form-group col-md-3 offset-1">
                    <label for="txtfechaAlta">Fecha de Final</label>
                    <input type="date" class="form-control text-center" id="txtFechaFINnb" value="<?php echo date("Y-m-d");?>">
                </div>
                <div class="form-group col-md-3 offset-1 mt-4">
                    <button class="form-control btn btn-primary btn-block mt-1" id="btnBuscarnb" role="button">Buscar <i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-6 offset-3 mt-4">
        <div class="form-group col-md-7 offset-1 float-left">
            <input type="text" id="txtBuscarEmpleadonb" placeholder="Buscar empleado" class="form-control" disabled />
        </div>
        <div class="form-group col-md-3 offset-1 float-right">
            <button class="btn btn-success" id="exportarReportenb">Exportar Reporte</button>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="col-md-12 table-responsive-lg">
            <table id="tableIncidenciasNominas" class="table table-striped table-bordered table-hover text-left table-sm">
                <thead class="text-center  bg-info text-white">
                    <th>Nomina</th>
                    <th>Empleado</th>
                    <th>Departamento</th>
                    <th>Fecha Incidencia</th>
                    <th>Hora Entrada</th>
                    <th>Status Entrada</th>
                    <th>Hora Salida</th>
                    <th>Status Salida</th>
                    <th>Joranda Laborada</th>
                    <th>TXT a Favor</th>
                    <th>TXT en Contra</th>
                    <th>PCG</th>
                    <th>PSG</th>
					<th>Turno</th>
					<th>Turno Entrada</th>
					<th>Turno Salida</th>
					<th>Turno Jornada</th>
                </thead>
                <tbody id="tablaIncidencias">  

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