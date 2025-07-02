<?php
require_once __DIR__ . '/../conexiones/conexion_sql.php';
require_once __DIR__ . '/../modelos/cliente_mod.php';

// Crear nuevo cliente
function crearCliente(Cliente $cliente, PDO $pdo) {
    $sql = "INSERT INTO cliente (dni, cuit, correo, nombre, apellido, contacto, direccion, razon_social, archivado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $cliente->getDni(),
        $cliente->getCuit(),
        $cliente->getCorreo(),
        $cliente->getNombre(),
        $cliente->getApellido(),
        $cliente->getContacto(),
        $cliente->getDireccion(),
        $cliente->getRazonSocial(),
        $cliente->getArchivado()
    ]);
}

// Obtener todos los clientes activos
function obtenerTodosLosClientes(PDO $pdo) {
    $stmt = $pdo->query("SELECT * FROM cliente WHERE archivado = 0");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener cliente por ID
function obtenerClientePorId($id_cliente, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM cliente WHERE id_cliente = ?");
    $stmt->execute([$id_cliente]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Actualizar un cliente existente
function actualizarCliente(Cliente $cliente, PDO $pdo) {
    $sql = "UPDATE cliente SET dni = ?, cuit = ?, correo = ?, nombre = ?, apellido = ?, contacto = ?, direccion = ?, razon_social = ?, archivado = ?
            WHERE id_cliente = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $cliente->getDni(),
        $cliente->getCuit(),
        $cliente->getCorreo(),
        $cliente->getNombre(),
        $cliente->getApellido(),
        $cliente->getContacto(),
        $cliente->getDireccion(),
        $cliente->getRazonSocial(),
        $cliente->getArchivado(),
        $cliente->getIdCliente()
    ]);
}

// Archivar cliente (eliminación lógica)
function archivarCliente($id_cliente, PDO $pdo) {
    $stmt = $pdo->prepare("UPDATE cliente SET archivado = 1 WHERE id_cliente = ?");
    $stmt->execute([$id_cliente]);
}
?>
