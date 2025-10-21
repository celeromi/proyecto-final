<div class="d-flex flex-column flex-shrink-0 bg-body-tertiary" style="width: 4.5rem; height: 100vh;">
  <a href="/" class="d-block p-3 link-body-emphasis text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="Inicio">
    <svg class="bi pe-none" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
  </a>

  <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
    <li class="nav-item">
<!--       <a href="#" class="nav-link active py-3 border-bottom rounded-0" title="Inicio">
        <svg class="bi pe-none" width="24" height="24"><use xlink:href="#home"></use></svg>
      </a> -->
    <!--  -->
    <a href="#" class="nav-link py-3 border-bottom rounded-0">
        <img src="<?php echo constant('URL');?>public/icons/house-door-fill.svg" width="24" height="24" alt="Inicio">
    </a>
    <!--  -->
    </li>
    <li><a href="#" class="nav-link py-3 border-bottom rounded-0" title="Productos"><svg class="bi pe-none" width="24" height="24"><use xlink:href="#grid"></use></svg></a></li>
    <li><a href="#" class="nav-link py-3 border-bottom rounded-0" title="Clientes"><svg class="bi pe-none" width="24" height="24"><use xlink:href="#people-circle"></use></svg></a></li>
  </ul>

  <div class="dropdown border-top">
    <a href="#" class="d-flex align-items-center justify-content-center p-3 text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
      <img src="https://github.com/mdo.png" alt="user" width="24" height="24" class="rounded-circle">
    </a>
    <ul class="dropdown-menu text-small shadow">
      <li><a class="dropdown-item" href="#">Perfil</a></li>
      <li><a class="dropdown-item" href="#">Configuración</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
    </ul>
  </div>
</div>
