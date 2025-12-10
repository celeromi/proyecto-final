<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visualizar Cliente</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>

  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary mb-0">Detalle del Cliente</h1>
        <a href="<?php echo constant('URL');?>clientes" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <div class="d-flex justify-content-center">
        <div class="card shadow-sm p-4 rounded-4" style="max-width: 600px; width: 100%;">
          
          <?php if (isset($this->cliente)) { $c = $this->cliente; ?>
          
            <form autocomplete="off">

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold">DNI</label>
                  <input type="text" value="<?php echo htmlspecialchars($c->getDni()); ?>" class="form-control" disabled>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">CUIT</label>
                  <input type="text" value="<?php echo htmlspecialchars($c->getCuit()); ?>" class="form-control" disabled>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold">Nombre</label>
                  <input type="text" value="<?php echo htmlspecialchars($c->getNombre()); ?>" class="form-control" disabled>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">Apellido</label>
                  <input type="text" value="<?php echo htmlspecialchars($c->getApellido()); ?>" class="form-control" disabled>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Correo</label>
                <input type="email" value="<?php echo htmlspecialchars($c->getCorreo()); ?>" class="form-control" disabled>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold">Contacto</label>
                  <input type="text" value="<?php echo htmlspecialchars($c->getContacto()); ?>" class="form-control" disabled>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold">Dirección</label>
                  <input type="text" value="<?php echo htmlspecialchars($c->getDireccion()); ?>" class="form-control" disabled>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Razón Social</label>
                <input type="text" value="<?php echo htmlspecialchars($c->getRazonSocial()); ?>" class="form-control" disabled>
              </div>

              <?php if (method_exists($c, 'getArchivado')) { ?>
              <div class="mb-3">
                <label class="form-label fw-bold">Estado</label>
                <input type="text" value="<?php echo $c->getArchivado() ? 'Archivado' : 'Activo'; ?>" class="form-control" disabled>
              </div>
              <?php } ?>

              <div class="d-flex justify-content-end mt-4">
                <a href="<?php echo constant('URL');?>clientes" class="btn btn-secondary">
                  <i class="bi bi-x-circle"></i> Cerrar
                </a>
              </div>

            </form>

          <?php } else { ?>
            <div class="alert alert-danger text-center">
              No se encontró el cliente.
            </div>
          <?php } ?>

        </div>
      </div>

    </main>
  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
