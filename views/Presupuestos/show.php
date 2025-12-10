<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle del Presupuesto</title>

  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>

  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-info mb-0">Detalle del Presupuesto</h1>
        <a href="<?php echo constant('URL');?>presupuestos" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <?php if (isset($this->presupuesto)) { 
          $p = $this->presupuesto;
          $u = $this->usuario;
          $c = $this->cliente;
      ?>

      <!-- ==============================
          SECCIÓN 1: DATOS DEL PRESUPUESTO
      =============================== -->
      <div class="card shadow-sm p-4 rounded-4 mb-4">

        <h4 class="fw-bold text-info mb-3">Datos del Presupuesto</h4>

        <p><strong>N° Presupuesto:</strong> <?php echo htmlspecialchars($p->getIdPresupuesto()); ?></p>

        <p><strong>Fecha:</strong> 
            <?php echo htmlspecialchars($p->getFecha()); ?>
        </p>

        <p><strong>Usuario:</strong>
            <?php echo htmlspecialchars($u->getNombre() . " " . $u->getApellido()); ?>
        </p>

        <p><strong>Cliente:</strong>
            <?php 
              if ($c) {
                  echo htmlspecialchars($c->getNombre() . " " . $c->getApellido());
              } else {
                  echo "<span class='text-muted'>Sin cliente asociado</span>";
              }
            ?>
        </p>

        <p><strong>Estado:</strong> 
            <?php echo htmlspecialchars($p->getEstado()); ?>
        </p>

        <p class="fs-5 fw-bold"><strong>Total:</strong> $<?php echo number_format($p->getImporteFinal(), 2); ?></p>

      </div>

      <!-- ==============================
          SECCIÓN 2: DETALLES DEL PRESUPUESTO
      =============================== -->
      <div class="card shadow-sm p-4 rounded-4">

        <h4 class="fw-bold text-info mb-3">Detalles</h4>

        <?php if (!empty($this->detalles)) { ?>

          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>Producto</th>
                  <th class="text-center">Cantidad</th>
                  <th class="text-end">Precio Unitario</th>
                  <th class="text-end">Precio Mayorista</th>
                </tr>
              </thead>
              <tbody>

                <?php 
                  foreach ($this->detalles as $d) { 
                    $prod = $this->productos[$d->getIdDetalle()];
                ?>
                <tr>
                  <td><?php echo htmlspecialchars($prod->getNombre()); ?></td>

                  <td class="text-center">
                      <?php echo htmlspecialchars($d->getCantidades()); ?>
                  </td>

                  <td class="text-end">
                      $<?php echo number_format($prod->getPrecioUnitario(), 2); ?>
                  </td>

                  <td class="text-end fw-bold">
                      $<?php echo number_format($prod->getPrecioMayorista(), 2); ?>
                  </td>
                </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>

        <?php } else { ?>

          <div class="alert alert-warning text-center">
            No se encontraron detalles para este presupuesto.
          </div>

        <?php } ?>

      </div>

      <?php } else { ?>

        <div class="alert alert-danger text-center">
          No se encontró el presupuesto.
        </div>

      <?php } ?>

    </main>

  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>

</body>
</html>
