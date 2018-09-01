<?php 
	include	'inc/model/service.php';
 ?>
<main class="col bg-faded py-3">
<div class="row">
	<div class="col-md-12">
		<h4 class="display-5">
			<p>Nomina: <?php echo ($_SESSION['user1']); ?></p>
			<input type="hidden" id="employeeID" value="<?php echo $_SESSION["user1"];?>">
		</h4>	
	</div>
	<div class="col-md-12">
		<h4 class="display-5">
			<p>Nombre: <?php echo ($_SESSION['userName']); ?></p>
		</h4>	
	</div>
	<div class="col-md-12">
		<h4 class="display-5">
			<p>Departamento: <?php echo $emp_depto; ?></p>
			<input type="hidden" id="employee_depto" value="<?php echo $emp_depto; ?>">
		</h4>	
	</div>
</div>
<hr>
<div class="row">
	<table class="table table-striped table-bordered table-hover text-center">
		<thead class="bg-primary text-white">
		    <tr>
		      <th scope="col">Horas Positivas</th>
		      <th scope="col">Horas Negativas</th>
		      <th scope="col">Total de Horas</th>
		      <th scope="col">Dias de vacaciones</th>
		    </tr>
  		</thead>
  		<tbody>
  			<tr>
  				<td><p class="h3"><?php echo number_format($total_txt_favor,1); ?></p></td>
  				<td><p class="h3"><?php echo number_format($total_txt_contra,1); ?></p></td>
  				<td><p class="h3"><?php echo number_format($total_txt_favor-$total_txt_contra,1); ?></p></td>
  				<td><p class="h3"><?php echo number_format($total_vacaciones,0); ?></p></td>
  			</tr>
  		</tbody>
	</table>
</div>

<div class="row">
	<div class="col-md-4">
	  <div class="form-group">
	    <label>Selecciona el tipo de transacción</label>
	    <select class="form-control custom-select" id="opcionCombo" onchange="getComboA(this)">
	      <option value="non" selected>Seleccionar una opcion</option>
	      <option value="txt">Tiempo por tiempo a favor</option>
	      <option value="txtc">Tiempo por tiempo en contra</option>
	      <option value="vacaciones">Vacaciones</option>
	      <option value="panel-usuario">Panel de incidencias</option>
	      <?php if ($_SESSION["godLevel"]==1): ?>
	      	<option value="panel-personal">Incidencias personal</option>
	      <?php endif ?>
	    </select>
	  </div>
	</div>
</div>

<div class="row" id="defaultDIV">
	<div class="col-md-12">
		<h1>Seleccionar una opcion</h1>
	</div>
</div>

<div class="row" id="txtDIV">
	<div class="col-md-12">
		<?php include ('inc/templates/txt.php');  ?>
	</div>
</div>
<div class="row" id="txtcDIV">
	<div class="col-md-12">
		<?php include ('inc/templates/txtc.php');  ?>
	</div>
</div>
<div class="row" id="vacacionesDIV">
	<div class="col-md-12">
		<?php include ('inc/templates/vacaciones.php');  ?>
	</div>
</div>
<div class="row" id="panel-usuarioDIV">
	<div class="col-md-12">
		<?php include ('inc/templates/panel-usuario.php');  ?>
	</div>
</div>

<div class="row" id="panel-personalDIV">
	<div class="col-md-12">
		<?php include ('inc/templates/panel-personal.php');  ?>
	</div>
</div>
</main>	

<script src="js/control.js"></script>
