<div class="row">
    <div class="col-md-12">
        <h1 class="display-4 text-center mt-4">Administrar Turnos</h1>
        <hr>
    </div>
    <hr>
    
    <div class="col-md-8 offset-2">
        <div class="col-md-1">
            <button class="btn btn-success" id="btnNuevoturno">Nuevo Turno</button>
        </div>
        <br>

        <div class="col-md-12 table-responsive-lg">
            <table id="tablaTurnos" class="table table-striped table-bordered table-hover text-left table-sm">
                <thead class="text-center bg-info text-white">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Hora de entrada (HE)</th>
                    <th>Hora de Salida (HS)</th>
                    <th>Tiempo en Jornada (TJ)</th>
					<th>Creado</th>
                </thead>
                <tbody id="tableTurnos">  

                </tbody>
            </table>
        </div>

        <div class="col-md-12 nuevoTurno d-none">
            <h3 class="display-5 text-center mt-4">Crear nuevo turno</h3>
            <br>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="txtClasificacion">Clasificación de turno</label>
                        <select class="form-control" id="txtClasificacion"></select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txtNombreTurno">Nombre del turno</label>
                        <input type="text" class="form-control" id="txtNombreTurno" placeholder="Nombre del turno" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="txtDescripcionTurno">Descripcion del turno</label>
                        <input type="text" class="form-control" id="txtDescripcionTurno" placeholder="Descripcion del turno" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="horaEntrada">Hora de entrada (formato 24 hrs)</label>
                        <input class="form-control" type="time" id="horaEntrada" min="07:00" max="20:00" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="entradaTemprana">Entrada Temprana</label>
                        <input class="form-control" type="number" id="entradaTemprana" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="entradaTolerancia">Entrada Tolerancia</label>
                        <input class="form-control" type="number" id="entradaTolerancia" required>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label for="salidaTolerancia">Horario de entrada</label>
                        <p id="horarioEntrada"></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="horaSalida">Hora de salida (formato 24 hrs)</label>
                        <input class="form-control" type="time" id="horaSalida" min="07:00" max="20:00" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="salidaTemprana">Salida Temprana</label>
                        <input class="form-control" type="number" id="salidaTemprana" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="salidaTolerancia">Salida Tolerancia</label>
                        <input class="form-control" type="number" id="salidaTolerancia" required>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <label for="salidaTolerancia">Horario de salida</label>
                        <p id="horarioSalida"></p>
                    </div>
                </div>
                <hr>
                <button class="btn btn-info btn-block" id="btnGuardarTurno" role="button">Guardar</button>
                <br>
                <button class="btn btn-danger btn-block btncancelarTN">Cancelar</button>
                </div>
            <br>
        </div>

        <div class="col-md-8 offset-2 detalleTurno d-none">
            <h3 class="display-5 text-center mt-4">Detalles del turno</h3>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="editClasificacion">Clasificación de turno</label>
                    <select class="form-control eturno" id="editClasificacion"></select>
                </div>
                <div class="form-group col-md-2">
                    <label for="editNombreTurno">Nombre del turno</label>
                    <input type="text" class="form-control eturno" id="editNombreTurno" placeholder="Nombre del turno" required>
                </div>
                <div class="form-group col-md-8">
                    <label for="editDescripcionTurno">Descripcion del turno</label>
                    <input type="text" class="form-control  eturno" id="editDescripcionTurno" placeholder="Descripcion del turno" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="edithoraEntrada">Hora de entrada (formato 24 hrs)</label>
                    <input class="form-control eturno" type="time" id="edithoraEntrada" min="07:00" max="20:00" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="editentradaTemprana">Entrada Temprana</label>
                    <input class="form-control eturno" type="number" id="editentradaTemprana" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="editentradaTolerancia">Entrada Tolerancia</label>
                    <input class="form-control eturno" type="number" id="editentradaTolerancia" required>
                </div>
                <div class="form-group col-md-6 text-center">
                    <label for="edithorarioEntrada">Horario de entrada</label>
                    <p id="edithorarioEntrada"></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="edithoraSalida">Hora de salida (formato 24 hrs)</label>
                    <input class="form-control eturno" type="time" id="edithoraSalida" min="07:00" max="20:00" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="editsalidaTemprana">Salida Temprana</label>
                    <input class="form-control eturno" type="number" id="editsalidaTemprana" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="editsalidaTolerancia">Salida Tolerancia</label>
                    <input class="form-control eturno" type="number" id="edtsalidaTolerancia" required>
                </div>
                <div class="form-group col-md-6 text-center">
                    <label for="editsalidaTolerancia">Horario de salida</label>
                    <p id="edithorarioSalida"></p>
                </div>
            </div>
            <hr>
            <button class="btn btn-info" id="btnEditarTurno">Editar Turno</button>
            <button class="btn btn-success d-none" id="btnActualizarTurno">Actualizar Turno</button>
            <button class="btn btn-warning d-none float-right" id="btnEliminarTurno">Eliminar Turno</button>
            <hr>
            <h2 class="display-5 text-center">Empleados</h2>
            <div class="col-md-12 table-responsive-lg">
                <table id="tablaTurnoEmpleado" class="table table-striped table-bordered table-hover text-left table-sm">
                    <thead class="text-center bg-success text-white">
                        <th>Nomina</th>
                        <th>Nombre</th>
                        <th>Departamento</th>
                        <th>Fecha inicio</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody id="tableTurnoEmpleado">  

                    </tbody>
                </table>
            </div>
            

            <br>
            <button class="btn btn-danger btn-block btncancelarTN">Cancelar</button>
        </div>

    </div>
</div>