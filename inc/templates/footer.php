<?php
	include	'inc/model/service.php';
?>
<br><br>
<nav style="background: rgb(0,0,0,0.6) !important" class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-primary">
	<a class="navbar-brand" href="index.php?request=">Incidencias MEXQ</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<input type="hidden" id="employeeID" value="<?php echo $_SESSION["user1"];?>">
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto">
			<!--  P1001 -->
			<?php if ($employee_id == 'P1001'): ?>
				<div class="btn-group dropup">
					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-users"></i> Recursos Humanos
					</button>
					<div class="dropdown-menu">
						<h6 class="dropdown-header">Opciones RH</h6>
						<a class="dropdown-item" href="index.php?request=rrhh"><i class="fas fa-clipboard"></i> Panel RRHH</a>
						<a class="dropdown-item" href="index.php?request=rh_resumen"><i class="fas fa-user-friends"></i> Resumen de Personal</a>
						<a class="dropdown-item" href="index.php?request=turnos"><i class="fas fa-business-time"></i> Administrar Turnos</a>
						<a class="dropdown-item" href="index.php?request=asignar-turnos"><i class="fas fa-user-clock"></i> Asignar Horarios</a>
						<a class="dropdown-item" href="index.php?request=omisiones"><i class="fas fa-clock"></i> Omisiones</a>
					</div>
				</div>
			<?php endif ?>
			<!-- P1002 -->
			<?php if ($employee_id == 'P1002'): ?>
				<div class="btn-group dropup">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-users"></i> Nominas
					</button>
					<div class="dropdown-menu">
						<h6 class="dropdown-header">Opciones Nominas</h6>
						<a class="dropdown-item" href="index.php?request=nominas"><i class="fas fa-clipboard"></i> Panel Nominas</a>
						<a class="dropdown-item" href="index.php?request=personal-nominas"><i class="fas fa-user-friends"></i> Resumen de Personal</a>
					</div>
				</div>
			<?php endif ?>
			<!-- USAR NUMERO DE NOMINA DEL EMPLEADO ACTIVO -->
			<input type="hidden" id="idemp" value="<?php echo ($_SESSION['user1']); ?>">
<!-- 			<li class="nav-item">
				<a class="nav-link" href="Panel de In">Link</a>
			</li> -->
<!--       <li class="nav-item dropup">
        <a class="nav-link dropdown-toggle" href="https://getbootstrap.com" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropup</a>
        <div class="dropdown-menu" aria-labelledby="dropdown10">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </li> -->
</ul>
</div>
</nav>


<script src="js/control.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.2/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

