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
          if ($u->getIdUsuario() == $id) return $u;
      }
      return null;
  }

  function buscarClientePorId($clientes, $id) {
      foreach ($clientes as $c) {
          if ($c->getIdCliente() == $id) return $c;
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
                <th>#</th>
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Importe Final</th>
                <th>Editar Estado</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach ($this->presupuestos as $index => $p) : ?>

                <?php
                  $usuario = buscarUsuarioPorId($this->usuarios, $p->getIdUsuario());
                  $cliente = ($p->getIdCliente() !== null)
                    ? buscarClientePorId($this->clientes, $p->getIdCliente())
                    : null;
                ?>

                <tr>
                  <th><?php echo $index + 1; ?></th>

                  <!-- USUARIO -->
                  <td>
                    <?php 
                      echo $usuario
                        ? htmlspecialchars($usuario->getUsuario())
                        : '<span class="text-muted">Desconocido</span>';
                    ?>
                  </td>

                  <!-- CLIENTE -->
                  <td>
                    <?php 
                      echo $cliente
                        ? htmlspecialchars($cliente->getNombre() . " " . $cliente->getApellido())
                        : '<span class="text-muted">Sin cliente</span>';
                    ?>
                  </td>

                  <!-- FECHA -->
                  <td><?php echo htmlspecialchars($p->getFecha()); ?></td>

                  <!-- ESTADO (Badge) -->
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

                  <!-- EDITAR ESTADO -->
                  <td>
                    <div class="input-group">
                      <select class="form-select form-select-sm estado-select"
                              data-id="<?php echo $p->getIdPresupuesto(); ?>">

                        <option value="Aprobado"   <?php echo ($estado==="Aprobado")  ? "selected" : ""; ?>>Aprobado</option>
                        <option value="Pendiente"  <?php echo ($estado==="Pendiente") ? "selected" : ""; ?>>Pendiente</option>
                        <option value="Rechazado"  <?php echo ($estado==="Rechazado") ? "selected" : ""; ?>>Rechazado</option>

                      </select>

                      <button class="btn btn-warning btn-sm cambiar-estado-btn"
                              data-id="<?php echo $p->getIdPresupuesto(); ?>">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                    </div>
                  </td>

                  <!-- ACCIONES -->
                  <td class="text-center">
                    <div class="btn-group" role="group">

                      <!-- Ver -->
                      <a href="<?php echo constant('URL');?>presupuestos/show/<?php echo $p->getIdPresupuesto(); ?>"
                        class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Ver">
                        <i class="bi bi-eye"></i>
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

            </tbody>
          </table>
        </div>

      <?php else : ?>

        <div class="alert alert-info text-center">No hay presupuestos registrados actualmente.</div>

      <?php endif; ?>
    </main>
  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {

        document.querySelectorAll(".cambiar-estado-btn").forEach(btn => {
            btn.addEventListener("click", () => {

                let id = btn.getAttribute("data-id");
                let select = document.querySelector('.estado-select[data-id="' + id + '"]');
                let estado = select.value;

                if (!confirm("¿Cambiar estado a: " + estado + "?")) return;

                window.location.href =
                    "<?php echo constant('URL'); ?>presupuestos/update_status/" + id + "/" + estado;
            });
        });

    });
  </script>

</body>
</html>
