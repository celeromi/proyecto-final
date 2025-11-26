<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Clientes</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>
  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary mb-0">Panel de Clientes</h1>
        <a href="<?php echo constant('URL');?>clientes/create" class="btn btn-primary">
          <i class="bi bi-person-plus"></i> Nuevo Cliente
        </a>
      </div>

      <?php if (!empty($this->clientes)) : ?>
        <div class="table-responsive shadow rounded">
          <table class="table table-striped align-middle">
            <thead class="table-primary">
              <tr>
                <th scope="col">#</th>
                <th scope="col">DNI</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Contacto</th>
                <th scope="col">Dirección</th>
                <th scope="col" class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($this->clientes as $index => $cliente) : ?>
                <tr>
                  <th scope="row"><?php echo $index + 1; ?></th>
                  <td><?php echo htmlspecialchars($cliente->getDni()); ?></td>
                  <td><?php echo htmlspecialchars($cliente->getApellido() . ', ' . $cliente->getNombre()); ?></td>
                  <td><?php echo htmlspecialchars($cliente->getCorreo()); ?></td>
                  <td><?php echo htmlspecialchars($cliente->getContacto()); ?></td>
                  <td><?php echo htmlspecialchars($cliente->getDireccion()); ?></td>

                  <td class="text-center">
                    <div class="btn-group" role="group">

                      <a href="<?php echo constant('URL');?>clientes/show/<?php echo $cliente->getIdCliente(); ?>" 
                         class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Ver">
                        <i class="bi bi-eye"></i>
                      </a>

                      <a href="<?php echo constant('URL');?>clientes/edit/<?php echo $cliente->getIdCliente(); ?>" 
                         class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <a href="<?php echo constant('URL');?>clientes/hide/<?php echo $cliente->getIdCliente(); ?>" 
                         class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Archivar"
                         onclick="return confirm('¿Seguro que deseas archivar este cliente?');">
                        <i class="bi bi-eye-slash"></i>
                      </a>

                      <a href="<?php echo constant('URL');?>clientes/delete/<?php echo $cliente->getIdCliente(); ?>" 
                         class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar" 
                         onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">
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
          No hay clientes registrados actualmente.
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
