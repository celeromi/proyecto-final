<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Producto</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>

  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-warning mb-0">Nuevo Producto</h1>
        <a href="<?php echo constant('URL');?>productos" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <div class="d-flex justify-content-center">
        <div class="card shadow-sm p-4 rounded-4" style="max-width: 600px; width: 100%;">

          <form action="<?php echo constant('URL');?>productos/insert" method="POST" autocomplete="off">

            <div class="mb-3">
              <label for="codigo" class="form-label fw-bold">Código</label>
              <input type="text" name="codigo" id="codigo" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="nombre" class="form-label fw-bold">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="categoria" class="form-label fw-bold">Categoría</label>
              <input type="text" name="categoria" id="categoria" class="form-control" required>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="precio" class="form-label fw-bold">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="stock" class="form-label fw-bold">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
              </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-warning me-2">
                <i class="bi bi-check-circle"></i> Aceptar
              </button>
              <a href="<?php echo constant('URL');?>productos" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Cancelar
              </a>
            </div>

          </form>

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
