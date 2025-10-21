<div class="d-flex flex-column flex-shrink-0 bg-light border-end" style="width: 4.8rem; height: 100vh;">

  <!-- Logo / Inicio -->
  <a href="<?php echo constant('URL'); ?>" 
     class="d-block p-3 text-decoration-none text-center border-bottom">
    <img src="<?php echo constant('URL'); ?>public/img/logo.png" 
         alt="BAER" width="32" height="32" class="rounded-circle">
  </a>

  <!-- Menú lateral -->
  <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">

    <!-- Usuarios -->
    <li class="nav-item">
      <a href="<?php echo constant('URL'); ?>usuarios" 
         class="nav-link py-3 border-bottom" 
         title="Usuarios" data-bs-toggle="tooltip" data-bs-placement="right">
        <img src="<?php echo constant('URL'); ?>public/icons/person-gear.svg" 
             width="24" height="24" alt="Usuarios">
      </a>
    </li>

    <!-- Clientes -->
    <li>
      <a href="<?php echo constant('URL'); ?>clientes" 
         class="nav-link py-3 border-bottom" 
         title="Clientes" data-bs-toggle="tooltip" data-bs-placement="right">
        <img src="<?php echo constant('URL'); ?>public/icons/people.svg" 
             width="24" height="24" alt="Clientes">
      </a>
    </li>

    <!-- Productos -->
    <li>
      <a href="<?php echo constant('URL'); ?>productos" 
         class="nav-link py-3 border-bottom" 
         title="Productos" data-bs-toggle="tooltip" data-bs-placement="right">
        <img src="<?php echo constant('URL'); ?>public/icons/bag-heart.svg" 
             width="24" height="24" alt="Productos">
      </a>
    </li>

    <!-- Presupuestos -->
    <li>
      <a href="<?php echo constant('URL'); ?>presupuestos" 
         class="nav-link py-3 border-bottom" 
         title="Presupuestos" data-bs-toggle="tooltip" data-bs-placement="right">
        <img src="<?php echo constant('URL'); ?>public/icons/file-earmark-text.svg" 
             width="24" height="24" alt="Presupuestos">
      </a>
    </li>
  </ul>

  <!-- Perfil de usuario (abajo) -->
  <div class="dropdown border-top">
    <a href="#" class="d-flex align-items-center justify-content-center p-3 dropdown-toggle"
       data-bs-toggle="dropdown" aria-expanded="false">
      <img src="<?php echo constant('URL'); ?>public/img/user.png" 
           alt="usuario" width="24" height="24" class="rounded-circle">
    </a>
    <ul class="dropdown-menu text-small shadow">
      <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
      <li><a class="dropdown-item" href="#">Configuración</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?php echo constant('URL'); ?>logout">Cerrar sesión</a></li>
    </ul>
  </div>

</div>
