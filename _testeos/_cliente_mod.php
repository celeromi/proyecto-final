<?php
require_once __DIR__ . '/../modelos/cliente_mod.php';

echo "<h2>🧪 Test del modelo Cliente</h2>";

// Crear cliente de prueba
$cliente = new Cliente(
    45678901,                        // dni
    20345678901,                     // cuit
    'cliente.prueba@mail.com',      // correo
    'Sofía',                         // nombre
    'Ramírez',                       // apellido
    1134567890,                      // contacto
    'Calle Ejemplo 456',            // dirección
    'Distribuidora Ramírez SRL',    // razón social
    0                                // archivado
);

// Simular que se le asigna un ID (como si viniera de la BD)
$cliente->setIdCliente(777);

// Mostrar los datos del cliente usando getters
echo "<ul>";
echo "<li><strong>ID Cliente:</strong> "      . $cliente->getIdCliente() . "</li>";
echo "<li><strong>DNI:</strong> "             . $cliente->getDni() . "</li>";
echo "<li><strong>CUIT:</strong> "            . $cliente->getCuit() . "</li>";
echo "<li><strong>Correo:</strong> "          . $cliente->getCorreo() . "</li>";
echo "<li><strong>Nombre:</strong> "          . $cliente->getNombre() . "</li>";
echo "<li><strong>Apellido:</strong> "        . $cliente->getApellido() . "</li>";
echo "<li><strong>Contacto:</strong> "        . $cliente->getContacto() . "</li>";
echo "<li><strong>Dirección:</strong> "       . $cliente->getDireccion() . "</li>";
echo "<li><strong>Razón Social:</strong> "    . $cliente->getRazonSocial() . "</li>";
echo "<li><strong>Archivado:</strong> "       . ($cliente->getArchivado() ? 'Sí' : 'No') . "</li>";
echo "</ul>";
?>
