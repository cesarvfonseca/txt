<div class="row">
    <div class="col-md-12">
        <h1 class="display-4 text-center mt-4">Resumen Personal</h1>
        <hr>
    </div>
    <div class="col-md-2 offset-5">
        <input type="text" name="txtBuscarPersonal" id="txtBuscarPersonal" placeholder="Buscar empleado" class="form-control"/>
    </div>
    <br><br>
    <div class="col-md-12">
        <div class="form-group col-md-1 offset-10">
			<button class="btn btn-success ml-3 exportResumenRH" title="Exportar tabla"><i class="fas fa-file-excel"></i> Exportar registros</button>	
		</div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12 table-responsive-lg">
            <table id="tablaResumen" class="table table-striped table-bordered table-hover text-left table-sm">
                <thead class="text-center">
                    <th>Nomina</th>
                    <th>Empleado</th>
                    <th>Departamento</th>
                    <th>TXT A Favor</th>
                    <th>TXT En Contra</th>
					<th>Dias de Vacaciones</th>
                </thead>
                <tbody id="tableresumen">  

                </tbody>
            </table>
        </div>
    </div>
</div>