<?php
require_once __DIR__ . '/../modelos/producto_mod.php';

echo "<h2>🧪 Test del modelo Producto</h2>";

// Crear producto de prueba
$producto = new Producto(
    'Rexona Fresh Antibacterial',                               // nombre
    'Jabón Barra',                                              // categoría
    'Rexona Fresh Antibacterial Jabón Barra 3 Unidades X 90 G', // descripción
    2500.00,                                                    // precio_unitario
    2200.00                                                     // precio_mayorista
);

// Simulamos que fue asignado por la base
$producto->setIdProducto(999);

// Mostrar los datos con getters
echo "<ul>";
echo "<li><strong>ID Producto:</strong> " . $producto->getIdProducto() . "</li>";
echo "<li><strong>Nombre:</strong> " . $producto->getNombre() . "</li>";
echo "<li><strong>Categoría:</strong> " . $producto->getCategoria() . "</li>";
echo "<li><strong>Descripción:</strong> " . $producto->getDescripcion() . "</li>";
echo "<li><strong>Precio Unitario:</strong> $" . $producto->getPrecioUnitario() . "</li>";
echo "<li><strong>Precio Mayorista:</strong> $" . $producto->getPrecioMayorista() . "</li>";
echo "<li><strong>Archivado:</strong> " . ($producto->getArchivado() ? 'Sí' : 'No') . "</li>";
echo "</ul>";
?>
