<div class="col-md-6 mx-auto">
  <!-- form card login -->
  <div class="card rounded-0">
    <div class="card-header">
      <h3 class="mb-0">Inicio de sesion...</h3>
    </div>
    <div class="card-body">
      <form class="form" role="form" autocomplete="off" id="loginForm" method="POST">
        <div class="form-group">
          <label for="txtUser">Correo</label>
          <input type="text" class="form-control form-control-lg rounded-0" name="txtUser" id="txtUser">
          <div class="invalid-feedback">Ingresa tu correo</div>
        </div>
        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" class="form-control form-control-lg rounded-0" name="txtPwd" id="txtPwd" autocomplete="new-password">
          <div class="invalid-feedback">Ingresa tu contraseña</div>
        </div>
            <button type="submit" class="btn btn-success btn-lg btn-block" name="btnLogin" id="btnLogin">
            <input type="hidden" id="type" value="login">
          Entrar
        </button>
      </form>
    </div>
    <!--/card-block-->
  </div>
  <!-- /form card login -->


