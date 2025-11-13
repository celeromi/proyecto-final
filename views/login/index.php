<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <main class="w-100 d-flex justify-content-center">
    <div class="card shadow-lg p-4 rounded-4" style="width: 400px;">

      <!-- Logo -->
      <div class="text-center mb-3">
        <img src="<?php echo constant('URL');?>public/img/baer-logo.png" 
             alt="Logo" 
             class="img-fluid mb-2" 
             style="width: 120px; height: auto;">
        <h3 class="text-primary fw-bold mb-3">Iniciar Sesión</h3>
      </div>

      <!-- Mensaje de error -->
      <?php if (isset($this->error)) : ?>
        <div class="alert alert-danger py-2 text-center">
          <i class="bi bi-exclamation-triangle"></i> 
          <?php echo $this->error; ?>
        </div>
      <?php endif; ?>

      <!-- Formulario -->
      <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST" autocomplete="off">
        <div class="mb-3">
          <label for="usuario" class="form-label fw-bold">Usuario</label>
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese su usuario" required>
        </div>
        <div class="mb-3">
          <label for="contrasena" class="form-label fw-bold">Contraseña</label>
          <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Ingrese su contraseña" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-2">
          <i class="bi bi-box-arrow-in-right"></i> Ingresar
        </button>
      </form>

      <!-- Enlaces inferiores -->
      <div class="text-center mt-3">
        <a href="#" class="text-decoration-none small text-secondary">
          <i class="bi bi-question-circle"></i> ¿Olvidaste tu contraseña?
        </a>
      </div>

    </div>
  </main>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

</body>
</html>
