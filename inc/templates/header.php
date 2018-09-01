<nav class="navbar navbar-light bg-dark justify-content-between">
  <a class="navbar-brand text-white">RH | TXT Y VACACIONES</a>
  <!--  <form class="form-inline"> -->

    <?php if (!isset($_SESSION['userActive']) || empty($_SESSION['userActive'])){ ?>
      <label class="text-white mr-sm-2">Bienvenido</label>
    <?php }else{ ?>
      <label class="text-white mr-sm-2">
        Bienvenido <?php echo $_SESSION["userName"] ?>
      </label>
      <!-- <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Cerrar Sesión</button> -->
      <div class="pull-right btnSalir">
        <a class="btn btn-sm btn-danger text-white" 
            data-idemp="<?php echo $_SESSION["userActive"];?>"
            role="button">
            Salir <i class="fas fa-sign-out-alt"></i>
        </a>
      </div>
    <?php } ?>

  <!-- </form> -->
</nav>