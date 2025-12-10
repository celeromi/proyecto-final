<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Cliente</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>

  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary mb-0">Nuevo Cliente</h1>
        <a href="<?php echo constant('URL');?>clientes" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <div class="d-flex justify-content-center">
        <div class="card shadow-sm p-4 rounded-4" style="max-width: 600px; width: 100%;">

        <!--  -->
        <form action="<?php echo constant('URL'); ?>clientes/insert" method="POST" autocomplete="off">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="dni" class="form-label fw-bold">DNI</label>
              <input type="text" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="correo" class="form-label fw-bold">Correo</label>
              <input type="email" name="correo" id="correo" class="form-control" required>
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

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="contacto" class="form-label fw-bold">Contacto</label>
              <input type="text" name="contacto" id="contacto" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="direccion" class="form-label fw-bold">Dirección</label>
              <input type="text" name="direccion" id="direccion" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="cuit" class="form-label fw-bold">CUIT</label>
              <input type="text" name="cuit" id="cuit" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="razon_social" class="form-label fw-bold">Razón Social</label>
              <input type="text" name="razon_social" id="razon_social" class="form-control">
            </div>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary me-2">
              <i class="bi bi-check-circle"></i> Aceptar
            </button>
            <a href="<?php echo constant('URL'); ?>clientes" class="btn btn-danger">
              <i class="bi bi-x-circle"></i> Cancelar
            </a>
          </div>

        </form>
        <!--  -->

        </div>
      </div>

    </main>
  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

</body>
</html>
