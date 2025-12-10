<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Presupuestos</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <!-- ↓↓↓ Pendiente a mejorar  -->
  <?php
  function buscarUsuarioPorId($usuarios, $id) {
      foreach ($usuarios as $u) {
          if ($u->getIdUsuario() == $id) {
              return $u;
          }
      }
      return null;
  }

  function buscarClientePorId($clientes, $id) {
      foreach ($clientes as $c) {
          if ($c->getIdCliente() == $id) {
              return $c;
          }
      }
      return null;
  }
  ?>
  <!-- ↑↑↑ Pendiente a mejorar  -->

  <?php include('views/layouts/sidebar.php'); ?>
  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">

      <!-- Encabezado -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-info mb-0">Panel de Presupuestos</h1>
        <a href="<?php echo constant('URL');?>presupuestos/create" class="btn btn-info">
          <i class="bi bi-file-earmark-plus"></i> Nuevo Presupuesto
        </a>
      </div>

      <?php if (!empty($this->presupuestos)) : ?>

        <div class="table-responsive shadow rounded">
          <table class="table table-striped align-middle">
            <thead class="table-info">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Importe Final</th>
                <th scope="col" class="text-center">Acciones</th>
              </tr>
            </thead>

            <tbody>

              <!--  -->
              <?php foreach ($this->presupuestos as $index => $p) : ?>

                <?php
                  $usuario = buscarUsuarioPorId($this->usuarios, $p->getIdUsuario());
                  $cliente = ($p->getIdCliente() !== null) ? buscarClientePorId($this->clientes, $p->getIdCliente()) : null;
                ?>

                <tr>
                  <th scope="row"><?php echo $index + 1; ?></th>

                  <!-- USUARIO -->
                  <td>
                    <?php 
                      if ($usuario) {
                        echo htmlspecialchars($usuario->getUsuario());
                      } else {
                        echo '<span class="text-muted">Desconocido</span>';
                      }
                    ?>
                  </td>

                  <!-- CLIENTE -->
                  <td>
                    <?php 
                      if ($cliente) {
                        echo htmlspecialchars($cliente->getNombre() . " " . $cliente->getApellido());
                      } else {
                        echo '<span class="text-muted">Sin cliente</span>';
                      }
                    ?>
                  </td>

                  <!-- FECHA -->
                  <td><?php echo htmlspecialchars($p->getFecha()); ?></td>

                  <!-- ESTADO -->
                  <td>
                    <?php 
                      $estado = $p->getEstado();
                      $badge = "secondary";

                      if ($estado === "Pendiente") $badge = "warning";
                      if ($estado === "Aprobado") $badge = "success";
                      if ($estado === "Rechazado") $badge = "danger";

                      echo "<span class='badge bg-$badge'>$estado</span>";
                    ?>
                  </td>

                  <!-- IMPORTE -->
                  <td>$<?php echo number_format($p->getImporteFinal(), 2, ',', '.'); ?></td>

                  <!-- ACCIONES -->
                  <td class="text-center">
                    <div class="btn-group" role="group">

                      <!-- Ver -->
                      <a href="<?php echo constant('URL');?>presupuestos/show/<?php echo $p->getIdPresupuesto(); ?>"
                        class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Ver">
                        <i class="bi bi-eye"></i>
                      </a>

                      <!-- Editar -->
                      <a href="<?php echo constant('URL');?>presupuestos/edit/<?php echo $p->getIdPresupuesto(); ?>"
                        class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <!-- Archivar -->
                      <a href="<?php echo constant('URL');?>presupuestos/hide/<?php echo $p->getIdPresupuesto(); ?>"
                        class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Archivar"
                        onclick="return confirm('¿Deseas archivar este presupuesto?');">
                        <i class="bi bi-eye-slash"></i>
                      </a>

                      <!-- Eliminar -->
                      <a href="<?php echo constant('URL');?>presupuestos/delete/<?php echo $p->getIdPresupuesto(); ?>"
                        class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar"
                        onclick="return confirm('¿Deseas eliminar este presupuesto?');">
                        <i class="bi bi-trash"></i>
                      </a>

                    </div>
                  </td>

                </tr>

              <?php endforeach; ?>
              <!--  -->

            </tbody>
          </table>
        </div>

      <?php else : ?>

        <div class="alert alert-info text-center" role="alert">
          No hay presupuestos registrados actualmente.
        </div>

      <?php endif; ?>
    </main>
  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

</body>
</html>
