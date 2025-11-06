<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Usuarios</title>
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
        <h1 class="text-success mb-0">Panel de Usuarios</h1>
        <a href="<?php echo constant('URL');?>usuarios/create" class="btn btn-success"> <!--  -->
          <i class="bi bi-person-plus"></i> Nuevo Usuario
        </a>
      </div>

      <!--  -->
      <?php if (!empty($this->usuarios)) : ?>
        <div class="table-responsive shadow rounded">
          <table class="table table-striped align-middle">
            <thead class="table-success">
              <tr>
                <th scope="col">#</th>
                <th scope="col">DNI</th>
                <th scope="col">CUIL</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Contacto</th>
                <th scope="col">Dirección</th>
                <th scope="col" class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($this->usuarios as $index => $usuario) : ?>
                <tr>
                  <th scope="row"><?php echo $index + 1; ?></th>
                  <td><?php echo htmlspecialchars($usuario->getDni()); ?></td>
                  <td><?php echo htmlspecialchars($usuario->getCuil()); ?></td>
                  <td><?php echo htmlspecialchars($usuario->getApellido() . ', ' . $usuario->getNombre()); ?></td>
                  <td><?php echo htmlspecialchars($usuario->getCorreo()); ?></td>
                  <td><?php echo htmlspecialchars($usuario->getContacto()); ?></td>
                  <td><?php echo htmlspecialchars($usuario->getDireccion()); ?></td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <!--  -->
                      <a href="<?php echo constant('URL');?>usuarios/show/<?php echo $usuario->getIdUsuario(); ?>" 
                         class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Ver">
                        <i class="bi bi-eye"></i>
                      </a>
                    <!--  -->
                      <a href="<?php echo constant('URL');?>usuarios/edit/<?php echo $usuario->getIdUsuario(); ?>" 
                         class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <!--  -->
                      <a href="<?php echo constant('URL');?>usuarios/hide/<?php echo $usuario->getIdUsuario(); ?>" 
                         class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Archivar"
                         onclick="return confirm('¿Seguro que deseas archivar este usuario?');">
                        <i class="bi bi-eye-slash"></i>
                      </a>
                      <!--  -->
                      <a href="<?php echo constant('URL');?>usuarios/delete/<?php echo $usuario->getIdUsuario(); ?>" 
                         class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar" 
                         onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">
                        <i class="bi bi-trash"></i>
                      </a>
                      <!--  -->
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else : ?>
        <div class="alert alert-warning text-center" role="alert">
          No hay usuarios registrados actualmente.
        </div>
      <?php endif; ?>
      <!--  -->
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
