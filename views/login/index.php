<main class="d-flex align-items-center justify-content-center vh-100">
  <div class="card shadow p-4 rounded-4" style="width: 400px;">
    <h3 class="text-center text-primary mb-4">Iniciar Sesión</h3>

    <?php if (isset($this->error)) : ?>
      <div class="alert alert-danger"><?php echo $this->error; ?></div>
    <?php endif; ?>

    <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
      <div class="mb-3">
        <label for="usuario" class="form-label fw-bold">Usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="contrasena" class="form-label fw-bold">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-box-arrow-in-right"></i> Ingresar
      </button>
    </form>
  </div>
</main>
