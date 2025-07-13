<?php
require_once __DIR__ . '/../modelos/usuario_mod.php';

echo "<h2>🧪 Test modelo Usuario</h2>";

// Crear usuario de prueba
$usuario = new Usuario(
    40123456,                           // dni
    20345678901,                        // cuil
    'test@correo.com',                 // correo
    'Ana',                              // nombre
    'González',                         // apellido
    3411234567,                         // contacto
    'Calle Prueba 123',                // dirección
    'anauser',                          // usuario
    'test123',                          // contraseña
    0                                   // archivado
);

// Simular ID
$usuario->setIdUsuario(999);

// Mostrar atributos
echo "<h3>🔍 Atributos del usuario:</h3>";
echo "<pre>";
echo "ID: "         . $usuario->getIdUsuario() . "\n";
echo "DNI: "        . $usuario->getDni() . "\n";
echo "CUIL: "       . $usuario->getCuil() . "\n";
echo "Correo: "     . $usuario->getCorreo() . "\n";
echo "Nombre: "     . $usuario->getNombre() . "\n";
echo "Apellido: "   . $usuario->getApellido() . "\n";
echo "Contacto: "   . $usuario->getContacto() . "\n";
echo "Dirección: "  . $usuario->getDireccion() . "\n";
echo "Usuario: "    . $usuario->getUsuario() . "\n";
echo "Contraseña: " . $usuario->getContrasena() . "\n";
echo "Archivado: "  . $usuario->getArchivado() . "\n";
echo "</pre>";

// Modificar atributos
$usuario->setNombre('Anita');
$usuario->setCorreo('anita@modificado.com');
$usuario->setDireccion('Calle Nueva 456');
$usuario->setContrasena('nuevoPass123');
$usuario->setArchivado(1);

// Mostrar atributos modificados
echo "<h3>✏️ Atributos modificados:</h3>";
echo "<pre>";
echo "Nombre: "     . $usuario->getNombre() . "\n";
echo "Correo: "     . $usuario->getCorreo() . "\n";
echo "Dirección: "  . $usuario->getDireccion() . "\n";
echo "Contraseña: " . $usuario->getContrasena() . "\n";
echo "Archivado: "  . $usuario->getArchivado() . "\n";
echo "</pre>";
?>
