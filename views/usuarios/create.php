<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Usuario</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>

  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-success mb-0">Nuevo Usuario</h1>
        <a href="<?php echo constant('URL');?>usuarios" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <!--  -->
      <div class="d-flex justify-content-center">
        <div class="card shadow-sm p-4 rounded-4" style="max-width: 600px; width: 100%;">
          <!-- Si confirma intenta insertar en DB -->
          <form action="<?php echo constant('URL');?>usuarios/insert" method="POST" autocomplete="off">

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="dni" class="form-label fw-bold">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="cuil" class="form-label fw-bold">CUIL</label>
                <input type="text" name="cuil" id="cuil" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="nombre" class="form-label fw-bold">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="apellido" class="form-label fw-bold">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label fw-bold">Correo</label>
              <input type="email" name="correo" id="correo" class="form-control" required>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="contacto" class="form-label fw-bold">Contacto</label>
                <input type="text" name="contacto" id="contacto" class="form-control" placeholder="Teléfono" required>
              </div>
              <div class="col-md-6">
                <label for="direccion" class="form-label fw-bold">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="usuario" class="form-label fw-bold">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
              </div>
            </div>

            <!-- Boton de Aceptar -->
            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-success me-2">
                <i class="bi bi-check-circle"></i> Aceptar
              </button>
              <!-- Si falla vuelve a usuarios -->
              <a href="<?php echo constant('URL');?>usuarios" class="btn btn-danger"> 
                <i class="bi bi-x-circle"></i> Cancelar
              </a>
            </div>
          </form>
        </div>
      </div>
      <!--  -->
      
    </main>
  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

</body>
</html>
