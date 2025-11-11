<header class="navbar navbar-light bg-light shadow-sm">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">BAER Cosméticos</span>
    <div>
      <button class="btn btn-outline-primary me-2">Notificaciones</button>
      <button class="btn btn-primary">Perfil</button>
      <!--  -->
      <?php if (isset($_SESSION['user'])): ?>
        <a href="<?php echo constant('URL');?>logout" class="btn btn-danger">Cerrar Sesión</a>
      <?php endif; ?>
      <!--  -->
    </div>
  </div>
</header>