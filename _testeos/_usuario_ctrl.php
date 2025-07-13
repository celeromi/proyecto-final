<?php
session_start(); // se inicia la sesión ANTES de cualquier salida al navegador
require_once __DIR__ . '/../controladores/usuario_ctrl.php';

echo "<h2>🧪 Test controlador Usuario</h2>";

// 1. Listar todos los usuarios
echo "<h3>📋 Usuarios actuales:</h3>";
$usuarios = obtenerTodosLosUsuarios($pdo);
echo "<pre>" . print_r($usuarios, true) . "</pre>";

// 2. Crear nuevo usuario
echo "<h3>➕ Creando usuario nuevo...</h3>";
$nuevoUsuario = new Usuario(
    40456789, 20987654321, 'nuevo@correo.com', 'Elena', 'Suárez',
    3419999999, 'Calle Falsa 456', 'elenas', 'secreto123', 0
);
crearUsuario($nuevoUsuario, $pdo);
$id_nuevo = $pdo->lastInsertId();
echo "Usuario creado con ID = $id_nuevo<br>";

// 3. Listar nuevamente
echo "<h3>🔁 Lista actualizada:</h3>";
$usuarios = obtenerTodosLosUsuarios($pdo);
echo "<pre>" . print_r($usuarios, true) . "</pre>";

// 4. Buscar por todos los medios
echo "<h3>🔎 Buscando por ID, Usuario, DNI, CUIL, Correo</h3>";
echo "<pre>";
print_r(obtenerUsuarioPorId($id_nuevo, $pdo));
print_r(obtenerUsuarioPorUsuario('elenas', $pdo));
print_r(obtenerUsuarioPorDNI(40456789, $pdo));
print_r(obtenerUsuarioPorCUIL(20987654321, $pdo));
print_r(obtenerUsuarioPorCorreo('nuevo@correo.com', $pdo));
echo "</pre>";

// 5. Modificar usuario y mostrar actualizado
echo "<h3>✏️ Modificando correo y nombre...</h3>";
$usuarioMod = new Usuario(
    40456789, 20987654321, 'editado@correo.com', 'ElenaEditada', 'Suárez',
    3411111111, 'Calle Nueva 888', 'elenas', 'nuevosecreto456', 0
);
$usuarioMod->setIdUsuario($id_nuevo);
actualizarUsuario($usuarioMod, $pdo);
echo "<pre>" . print_r(obtenerUsuarioPorId($id_nuevo, $pdo), true) . "</pre>";

// 6. Verificar credenciales incorrectas
echo "<h3>❌ Verificando con credenciales inválidas:</h3>";
$result = verificarCredenciales('elenas', 'incorrecta', $pdo);
echo $result ? "ERROR: debería fallar<br>" : "Correcto: credenciales inválidas<br>";

// 7. Verificar credenciales válidas
echo "<h3>✅ Verificando con credenciales válidas:</h3>";
$result = verificarCredenciales('elenas', 'nuevosecreto456', $pdo);
echo $result ? "Correcto: usuario verificado<br>" : "ERROR: debería funcionar<br>";

// 8. Loguear
echo "<h3>🔐 Intentando iniciar sesión:</h3>";

// Si ya hay sesión abierta, cerrarla
if (isset($_SESSION['usuario'])) {
    echo "🔁 Cerrando sesión anterior de: " . $_SESSION['usuario']['nombre'] . "<br>";
    session_unset();
    session_destroy();
    session_start(); // Iniciar una sesión limpia
}

// Intentar loguearse
if (loguearse('elenas', 'nuevosecreto456', $pdo)) {
    echo "✅ Sesión iniciada para: " . $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido'] . "<br>";
} else {
    echo "❌ No se pudo iniciar sesión<br>";
}

// 9. Archivar usuario
echo "<h3>🗃 Archivando usuario...</h3>";
archivarUsuario($id_nuevo, $pdo);
echo "<pre>" . print_r(obtenerUsuarioPorId($id_nuevo, $pdo), true) . "</pre>";

// 10. Eliminar usuario
echo "<h3>🗑 Eliminando usuario...</h3>";
eliminarUsuarioPorId($id_nuevo, $pdo);
echo "Usuario eliminado.<br>";

// Confirmar que fue eliminado
echo "<h3>🔍 Verificando eliminación:</h3>";
$verificado = obtenerUsuarioPorId($id_nuevo, $pdo);
echo $verificado ? "ERROR: el usuario aún existe<br>" : "Correcto: eliminado<br>";
?>
