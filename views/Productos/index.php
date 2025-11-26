<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Productos</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>
  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-warning mb-0">Panel de Productos</h1>
        <a href="<?php echo constant('URL');?>productos/create" class="btn btn-warning">
          <i class="bi bi-bag-plus"></i> Nuevo Producto
        </a>
      </div>

      <?php if (!empty($this->productos)) : ?>
        <div class="table-responsive shadow rounded">
          <table class="table table-striped align-middle">
            <thead class="table-warning">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoría</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col" class="text-center">Acciones</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($this->productos as $index => $producto) : ?>
                <tr>
                  <th scope="row"><?php echo $index + 1; ?></th>
                  <td><?php echo htmlspecialchars($producto->getCodigo()); ?></td>
                  <td><?php echo htmlspecialchars($producto->getNombre()); ?></td>
                  <td><?php echo htmlspecialchars($producto->getCategoria()); ?></td>
                  <td>$<?php echo number_format($producto->getPrecio(), 2, ',', '.'); ?></td>
                  <td><?php echo htmlspecialchars($producto->getStock()); ?></td>

                  <td class="text-center">
                    <div class="btn-group" role="group">

                      <a href="<?php echo constant('URL');?>productos/show/<?php echo $producto->getIdProducto(); ?>" 
                         class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Ver">
                        <i class="bi bi-eye"></i>
                      </a>

                      <a href="<?php echo constant('URL');?>productos/edit/<?php echo $producto->getIdProducto(); ?>" 
                         class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <a href="<?php echo constant('URL');?>productos/hide/<?php echo $producto->getIdProducto(); ?>" 
                         class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Archivar"
                         onclick="return confirm('¿Seguro que deseas archivar este producto?');">
                        <i class="bi bi-eye-slash"></i>
                      </a>

                      <a href="<?php echo constant('URL');?>productos/delete/<?php echo $producto->getIdProducto(); ?>" 
                         class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar" 
                         onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
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
        <div class="alert alert-warning text-center" role="alert">
          No hay productos registrados actualmente.
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
