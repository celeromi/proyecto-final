<?php
require_once __DIR__ . '/../conexiones/conexion_sql.php';
require_once __DIR__ . '/../modelos/producto_mod.php';

// Crear producto nuevo
function crearProducto(Producto $producto, PDO $pdo) {
    $sql = "INSERT INTO producto (nombre, categoria, descripcion, precio_unitario, precio_mayorista, archivado)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $producto->getNombre(),
        $producto->getCategoria(),
        $producto->getDescripcion(),
        $producto->getPrecioUnitario(),
        $producto->getPrecioMayorista(),
        $producto->getArchivado()
    ]);
}

// Obtener todos los productos activos
function obtenerTodosLosProductos(PDO $pdo) {
    $stmt = $pdo->query("SELECT * FROM producto WHERE archivado = 0");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener un producto por su ID
function obtenerProductoPorId($id_producto, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM producto WHERE id_producto = ?");
    $stmt->execute([$id_producto]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Actualizar un producto existente
function actualizarProducto(Producto $producto, PDO $pdo) {
    $sql = "UPDATE producto SET nombre = ?, categoria = ?, descripcion = ?, precio_unitario = ?, precio_mayorista = ?, archivado = ?
            WHERE id_producto = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $producto->getNombre(),
        $producto->getCategoria(),
        $producto->getDescripcion(),
        $producto->getPrecioUnitario(),
        $producto->getPrecioMayorista(),
        $producto->getArchivado(),
        $producto->getIdProducto()
    ]);
}

// Archivar producto (eliminación lógica)
function archivarProducto($id_producto, PDO $pdo) {
    $stmt = $pdo->prepare("UPDATE producto SET archivado = 1 WHERE id_producto = ?");
    $stmt->execute([$id_producto]);
}
?>
