<?php
require_once __DIR__ . '/../controladores/cliente_ctrl.php';

echo "<h2>🧪 Test del controlador Cliente</h2>";

// 1. Crear cliente
echo "<h3>🟢 Creando nuevo cliente...</h3>";
$cliente = new Cliente(
    45891234,                              // DNI
    20345678900,                           // CUIT
    'cliente.test@demo.com',              // Correo
    'Elena',                               // Nombre
    'Suárez',                              // Apellido
    1145678912,                            // Contacto
    'Av. de los Testeos 999',              // Dirección
    'Distribuidora Test SRL',             // Razón social
    0                                      // Archivado
);
crearCliente($cliente, $pdo);
echo "Cliente creado correctamente.<br>";

// 2. Obtener último ID insertado
$id_cliente = $pdo->lastInsertId();
echo "<h3>🔎 Obteniendo cliente con ID = $id_cliente...</h3>";
$clienteData = obtenerClientePorId($id_cliente, $pdo);
echo "<pre>" . print_r($clienteData, true) . "</pre>";

// 3. Listar todos los clientes activos
echo "<h3>📋 Clientes activos:</h3>";
$clientes = obtenerTodosLosClientes($pdo);
echo "<pre>" . print_r($clientes, true) . "</pre>";

// 4. Modificar datos del cliente
echo "<h3>✏️ Modificando datos del cliente...</h3>";
$clienteMod = new Cliente(
    $clienteData['dni'],
    $clienteData['cuit'],
    'modificado@correo.com',                    // Nuevo correo
    $clienteData['nombre'],
    $clienteData['apellido'],
    1122233344,                                 // Nuevo contacto
    'Calle Actualizada 456',                    // Nueva dirección
    $clienteData['razon_social'],
    0
);
$clienteMod->setIdCliente($id_cliente);
actualizarCliente($clienteMod, $pdo);
echo "Cliente actualizado correctamente.<br>";

// 5. Archivar cliente
echo "<h3>🚫 Archivando cliente ID = $id_cliente...</h3>";
archivarCliente($id_cliente, $pdo);
echo "Cliente archivado correctamente.<br>";

// 6. Verificar que no aparece entre activos
echo "<h3>🔁 Verificando lista actualizada de clientes activos:</h3>";
$clientes = obtenerTodosLosClientes($pdo);
echo "<pre>" . print_r($clientes, true) . "</pre>";
?>
