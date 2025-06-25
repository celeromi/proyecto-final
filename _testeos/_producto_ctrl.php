<?php
require_once __DIR__ . '/../controladores/producto_ctrl.php';

echo "<h2>🧪 Test del controlador Producto</h2>";

// 1. Crear producto de prueba
echo "<h3>🟢 Creando nuevo producto...</h3>";
$producto = new Producto(
    'Detergente Líquido',       // nombre
    'Limpieza',                 // categoría
    'Botella de 1L para cocina',
    1100.00,                    // precio_unitario
    950.00                      // precio_mayorista
);
crearProducto($producto, $pdo);
echo "Producto creado correctamente.<br>";

// 2. Buscar el último producto insertado por ID (suponiendo que es el último)
$ultimoId = $pdo->lastInsertId();
echo "<h3>🔎 Buscando producto con ID = $ultimoId...</h3>";
$prod = obtenerProductoPorId($ultimoId, $pdo);
echo "<pre>" . print_r($prod, true) . "</pre>";

// 3. Mostrar todos los productos activos
echo "<h3>📦 Listado de productos activos:</h3>";
$productos = obtenerTodosLosProductos($pdo);
echo "<pre>" . print_r($productos, true) . "</pre>";

// 4. Modificar el producto creado
echo "<h3>✏️ Modificando descripción y precios del producto...</h3>";
$productoMod = new Producto(
    $prod['nombre'],
    $prod['categoria'],
    'Botella de 1 litro – fórmula mejorada', // nueva descripción
    1150.00,                                 // nuevo precio unitario
    980.00                                   // nuevo precio mayorista
);
$productoMod->setIdProducto($prod['id_producto']);
$productoMod->setArchivado(0);
actualizarProducto($productoMod, $pdo);
echo "Producto actualizado correctamente.<br>";

// 5. Archivar el producto
echo "<h3>🚫 Archivando el producto con ID = $ultimoId...</h3>";
archivarProducto($ultimoId, $pdo);
echo "Producto archivado correctamente.<br>";

// Confirmar que ya no aparece en productos activos
echo "<h3>🔁 Verificando que no aparezca en la lista activa...</h3>";
$productosActualizados = obtenerTodosLosProductos($pdo);
echo "<pre>" . print_r($productosActualizados, true) . "</pre>";
?>
