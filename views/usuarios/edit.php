<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualización de Usuario</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>
  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <!--  -->
    <main class="p-4 flex-grow-1">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-success mb-0">Editar Usuario</h1>
        <a href="<?php echo constant('URL');?>usuarios" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <div class="d-flex justify-content-center">
        <div class="card shadow-sm p-4 rounded-4" style="max-width: 600px; width: 100%;">
          <?php if (isset($this->usuario)){ $u = $this->usuario; ?>
            <form action="<?php echo constant('URL');?>usuarios/update" method="POST" autocomplete="off">

              <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($u->getIdUsuario()); ?>">

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold">DNI</label>
                  <input type="text" name="dni" value="<?php echo htmlspecialchars($u->getDni()); ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">CUIL</label>
                  <input type="text" name="cuil" value="<?php echo htmlspecialchars($u->getCuil()); ?>" class="form-control" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold">Nombre</label>
                  <input type="text" name="nombre" value="<?php echo htmlspecialchars($u->getNombre()); ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">Apellido</label>
                  <input type="text" name="apellido" value="<?php echo htmlspecialchars($u->getApellido()); ?>" class="form-control" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Correo</label>
                <input type="email" name="correo" value="<?php echo htmlspecialchars($u->getCorreo()); ?>" class="form-control" required>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold">Contacto</label>
                  <input type="text" name="contacto" value="<?php echo htmlspecialchars($u->getContacto()); ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">Dirección</label>
                  <input type="text" name="direccion" value="<?php echo htmlspecialchars($u->getDireccion()); ?>" class="form-control" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold">Usuario</label>
                  <input type="text" name="usuario" value="<?php echo htmlspecialchars($u->getUsuario()); ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">Contraseña</label>
                  <input type="password" name="contrasena" placeholder="********" class="form-control">
                </div>
              </div>

              <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success me-2">
                  <i class="bi bi-check-circle"></i> Guardar Cambios
                </button>
                <a href="<?php echo constant('URL');?>usuarios" class="btn btn-danger">
                  <i class="bi bi-x-circle"></i> Cancelar
                </a>
              </div>

            </form>
          <?php } else { ?>
            <div class="alert alert-danger text-center">
              No se encontró el usuario.
            </div>
          <?php } ?>
        </div>
      </div>
    </main>
    <!--  -->

  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

</body>
</html>
