<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle del Producto</title>

  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>

  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-info mb-0">Detalle del Producto</h1>
        <a href="<?php echo constant('URL');?>productos" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <div class="card shadow-sm p-4 rounded-4" style="max-width: 650px;">

        <?php if (isset($this->producto)){ $p = $this->producto; ?>

          <h4 class="fw-bold mb-3"><?php echo htmlspecialchars($p->getNombre()); ?></h4>

          <p><strong>Categoría:</strong> <?php echo htmlspecialchars($p->getCategoria()); ?></p>
          <p><strong>Descripción:</strong> <?php echo htmlspecialchars($p->getDescripcion()); ?></p>
          <p><strong>Precio Unitario:</strong> $<?php echo number_format($p->getPrecioUnitario(), 2); ?></p>
          <p><strong>Precio Mayorista:</strong> $<?php echo number_format($p->getPrecioMayorista(), 2); ?></p>

        <?php } else { ?>

          <div class="alert alert-danger text-center">
            No se encontró el producto.
          </div>

        <?php } ?>

      </div>

    </main>

  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>

</body>
</html>
