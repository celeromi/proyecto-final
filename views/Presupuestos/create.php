<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Presupuesto</title>

  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>

  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-info mb-0">Crear Presupuesto</h1>
        <a href="<?php echo constant('URL');?>presupuestos" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <form action="<?php echo constant('URL');?>presupuestos/insert" method="POST">

        <!-- 🔹 CARD 1 – DATOS DEL PRESUPUESTO -->
        <div class="card shadow-sm p-4 mb-4 rounded-4">

          <h4 class="fw-bold mb-3">Datos del Presupuesto</h4>

          <div class="row">
            <!-- Usuario -->
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Usuario</label>
              <select name="id_usuario" class="form-select" required>
                <option value="" disabled selected>Seleccione un usuario</option>
                <?php foreach($this->usuarios as $u): ?>
                  <option value="<?= $u->getIdUsuario(); ?>">
                    <?= htmlspecialchars($u->getApellido() . ', ' . $u->getNombre()); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Cliente -->
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Cliente</label>
              <select name="id_cliente" class="form-select">
                <option value="" selected>Sin cliente asignado</option>
                <?php foreach($this->clientes as $c): ?>
                  <option value="<?= $c->getIdCliente(); ?>">
                    <?= htmlspecialchars($c->getApellido() . ', ' . $c->getNombre()); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="row">
            <!-- Fecha -->
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Fecha</label>
              <input type="date" name="fecha" class="form-control" required>
            </div>

            <!-- Estado -->
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Estado</label>
              <select name="estado" class="form-select" required>
                <option value="Aprobado">Aprobado</option>
                <option value="Pendiente">Pendiente</option>
                <option value="Rechazado">Rechazado</option>
              </select>
            </div>
          </div>

          <!-- Importante: el importe final lo calcula el controlador -->
          <input type="hidden" name="importe_final" id="importe_final">

        </div>


        <!-- 🔹 CARD 2 – DETALLES DEL PRESUPUESTO -->
        <div class="card shadow-sm p-4 mb-4 rounded-4">

          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Detalles</h4>
            <button type="button" class="btn btn-success" onclick="agregarFila()">
              <i class="bi bi-plus-lg"></i> Agregar producto
            </button>
          </div>

          <table class="table table-bordered align-middle" id="tabla_detalles">
            <thead class="table-light">
              <tr>
                <th style="width: 50%">Producto</th>
                <th style="width: 20%">Cantidad</th>
                <th style="width: 20%">Precio</th>
                <th style="width: 10%"></th>
              </tr>
            </thead>
            <tbody>
              <!-- Se agregan dinámicamente -->
            </tbody>
          </table>

          <div class="text-end mt-3">
            <h4 class="fw-bold">Total: $ <span id="total_view">0.00</span></h4>
          </div>

        </div>


        <div class="text-end">
          <button class="btn btn-primary px-4">
            <i class="bi bi-check-circle"></i> Crear Presupuesto
          </button>
        </div>

      </form>

    </main>
  </div>

  <script>
    const productos = <?= json_encode(array_map(function($p){
      return [
        'id' => $p->getIdProducto(),
        'nombre' => $p->getNombre(),
        'precio' => $p->getPrecioUnitario(),
      ];
    }, $this->productos)); ?>;

    function agregarFila(){
      const tabla = document.querySelector("#tabla_detalles tbody");

      const fila = document.createElement("tr");

      fila.innerHTML = `
        <td>
          <select name="id_producto[]" class="form-select" onchange="actualizarPrecio(this)" required>
            <option value="" disabled selected>Seleccione producto</option>
            ${productos.map(p => `
              <option value="${p.id}" data-precio="${p.precio}">
                ${p.nombre}
              </option>
            `).join('')}
          </select>
        </td>
        <td>
          <input type="number" min="1" value="1" name="cantidades[]" class="form-control" oninput="calcularTotal()" required>
        </td>
        <td class="precio_view">$0.00</td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove(); calcularTotal();">
            <i class="bi bi-trash3"></i>
          </button>
        </td>
      `;

      tabla.appendChild(fila);
    }

    function actualizarPrecio(select){
      const precio = select.options[select.selectedIndex].dataset.precio || 0;
      const fila = select.closest("tr");
      fila.querySelector(".precio_view").textContent = "$" + parseFloat(precio).toFixed(2);
      calcularTotal();
    }

    function calcularTotal(){
      let total = 0;

      document.querySelectorAll("#tabla_detalles tbody tr").forEach(fila => {
        const select = fila.querySelector("select");
        const cantidad = parseInt(fila.querySelector("input").value) || 1;

        const precio = select.selectedOptions[0]?.dataset.precio ?? 0;
        total += cantidad * parseFloat(precio);
      });

      document.getElementById("total_view").textContent = total.toFixed(2);
      document.getElementById("importe_final").value = total;
    }
  </script>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>

</body>
</html>
