<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Usuarios</title>
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
</head>

<body class="d-flex">

  <?php include('views/layouts/sidebar.php'); ?>
  <div class="d-flex flex-column flex-grow-1">
    <?php include('views/layouts/header.php'); ?>

    <!--  -->
    <main class="p-4 flex-grow-1">
      <h1 class="text-success">Panel de Usuarios</h1>
    </main>
    <!--  -->

  </div>

  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>

</body>
</html>
