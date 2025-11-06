<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estructura Genérica</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/icons/bootstrap-icons.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>
  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <main class="p-4 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="text-success mb-0">Estructura Genérica</h1>
      <!--  -->
      <a href="<?php echo constant('URL');?>main" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
      <!--  -->
    </div>

    <!--  -->
    <!-- Contenido -->
    <!--  -->
    
    </main>
  </div>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

</body>
</html>
