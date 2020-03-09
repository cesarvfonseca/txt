<div class="row">
    <div class="col-md-12">
        <h1 class="display-4 text-center mt-4">Omisiones de checadas</h1>
        <hr>
    </div>
    <div class="col-md-8 offset-2 text-center">
        <div class="form-row">
            <div class="form-group col-md-3 offset-1">
                <label for="txtfechaAlta">Fecha de Inicio</label>
                <input type="date" class="form-control text-center" id="omfechaIni" value="<?php echo date("Y-m-d", strtotime('-10 days'));?>">
            </div>

            <div class="form-group col-md-3 offset-1">
                <label for="txtfechaAlta">Fecha de Final</label>
                <input type="date" class="form-control text-center" id="omfechaFin" value="<?php echo date("Y-m-d");?>">
            </div>
            <div class="form-group col-md-2 offset-1">
                <button class="btn btn-info btn-block mt-4" id="btnomRango" role="button">Buscar <i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <div class="col-md-8 offset-2">
        <input type="text" name="txtomBuscar" id="txtomBuscar" placeholder="Buscar empleado" class="form-control pull-left col-md-3 offset-1" disabled />
    </div>
    
    <div class="col-md-10 offset-1">
    <br>
        <div class="col-md-12 table-responsive-lg">
            <table id="tablaomisiones" class="table table-striped table-bordered table-hover text-left table-sm">
                <thead class="text-center bg-info text-white">
                    <th>Nomina</th>
                    <th>Empleado</th>
                    <th>Departamento</th>
                    <th>Fecha</th>
                    <th>Hora entrada</th>
                    <th>Hora entrada RH</th>
                    <th>Hora salida</th>
                    <th>Hora salida RH</th>
                    <th>Jornada</th>
                    <th>Acciones</th>
                </thead>
                <tbody id="tableomisiones">  

                </tbody>
            </table>
        </div>
        <div class="alert alert-info" id="avisoR" role="alert">
        Eligir un periodo.
        </div>
        <div class="alert alert-warning d-none" id="alertaomiR" role="alert">
        No hay información disponible en el periodo elegido.
        </div>      
    </div>

</div>