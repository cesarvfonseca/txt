<div class="row">
    <h1 class="display-4 text-center mt-4">Asignar Turnos</h1>
    <br>
</div>
<div class="col-md-2 offset-5">
    <input type="text" name="buscarEmpleadoTurno" id="buscarEmpleadoTurno" placeholder="Buscar empleado" class="form-control"/>
</div>

<div class="col-md-10 offset-1 text-center">
    <h3 class="display-5 mt-4">Turnos disponibles</h3>
    <div class="form-group">
        <select class="custom-select col-md-4" id="clasificacionTurnos">
        
        </select>
        <select class="custom-select col-md-4 mx-4" id="turnosDisponibles">
        
        </select>
        <button class="btn btn-success col-md-2 pull-right" role="button" id="btnAsignarTurnos" onclick="asignarTurno()">Asignar Turno</button>
    </div>
    
</div>

<h3 class="display-5 text-center mt-4">Empleados</h3>
<div class="col-md-10 offset-1">
    <hr>
    <div class="col-md-12 table-responsive-lg">
        <table id="tablaTurnosEmpleado" class="table table-striped table-bordered table-hover text-left table-sm">
            <thead class="text-center bg-info text-white">
                <th>Nomina</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Horario LV</th>
                <th>Horario Sabatino</th>
            </thead>
            <tbody id="tableTurnosEmpleado">  

            </tbody>
        </table>
    </div>
</div>
