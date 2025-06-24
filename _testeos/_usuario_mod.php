<?php
require_once __DIR__ . '/../modelos/usuario_mod.php';

$usuario = new Usuario(
    12345678,                  // dni
    20123456789,               // cuil
    'gfarias@gmail.com',       // correo
    'Gastón',                  // nombre
    'Farias',                  // apellido
    3454234567,                // contacto
    'Avenida Siempreviva 742', // direccion
    'gfarias',                 // usuario
    'securepass711',           // contrasena
    0                          // archivado
);

// Mostramos los datos
echo "<h2>Test del modelo Usuario</h2>";
echo "<ul>";
echo "<li><strong>DNI:</strong> " . $usuario->getDni() . "</li>";
echo "<li><strong>CUIL:</strong> " . $usuario->getCuil() . "</li>";
echo "<li><strong>Correo:</strong> " . $usuario->getCorreo() . "</li>";
echo "<li><strong>Nombre:</strong> " . $usuario->getNombre() . "</li>";
echo "<li><strong>Apellido:</strong> " . $usuario->getApellido() . "</li>";
echo "<li><strong>Contacto:</strong> " . $usuario->getContacto() . "</li>";
echo "<li><strong>Dirección:</strong> " . $usuario->getDireccion() . "</li>";
echo "<li><strong>Usuario:</strong> " . $usuario->getUsuario() . "</li>";
echo "<li><strong>Contraseña:</strong> " . $usuario->getContrasena() . "</li>";
echo "<li><strong>Archivado:</strong> " . ($usuario->getArchivado() ? 'Sí' : 'No') . "</li>";
echo "</ul>";
?>
