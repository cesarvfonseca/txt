<div class="row">
    <h1>Panel Recursos Humanos MEXQ</h1>
    <hr>
    <div class="col-md-12">
        <hr>
        <h3>Seleccionar un periodo</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <input type="text" name="daterange_hhrr" id="daterange_hhrr" class="form-control" />
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-3">
        <input type="text" name="txtBuscar" id="txtBuscar" placeholder="Buscar empleado" class="form-control" disabled />
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 table-responsive-sm">
            <table id="tablaRH" class="table table-striped table-bordered table-hover text-left table-sm">
                <thead class="text-center">
                    <th>Nomina</th>
                    <th>Empleado</th>
                    <th>Departamento</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Horas</th>
                    <th>Estado Jefe</th>
                    <th>Autorización</th>
                </thead>
                <tbody id="tablehhrr">  

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

