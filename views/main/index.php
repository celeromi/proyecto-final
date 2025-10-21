<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main - BAER</title>

  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.min.css">
</head>

<body class="d-flex">

  <!-- SIDEBAR -->
  <?php include('views/layouts/sidebar.php'); ?>

  <!-- CONTENEDOR PRINCIPAL -->
  <div class="d-flex flex-column flex-grow-1">

    <!-- HEADER (arriba del contenido) -->
    <?php include('views/layouts/header.php'); ?>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="p-4 flex-grow-1">
      <h1 class="text-primary">Bienvenida al panel BAER</h1>
      <p>Seleccioná una opción en la barra lateral.</p>
    </main>

  </div> <!-- fin contenedor principal -->

  <!-- ACTIVAR TOOLTIPS -->
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
  </script>

  <!-- BOOTSTRAP JS -->
  <script src="<?php echo constant('URL');?>public/js/bootstrap.bundle.min.js"></script>

</body>
</html>
