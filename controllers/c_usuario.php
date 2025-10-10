<?php
require_once __DIR__ . '/../conexiones/conexion_sql.php';
require_once __DIR__ . '/../modelos/usuario_mod.php';

// Crear un nuevo usuario en la base de datos
function crearUsuario(Usuario $usuario, PDO $pdo) {
    $sql = "INSERT INTO usuario (dni, cuil, correo, nombre, apellido, contacto, direccion, usuario, contrasena, archivado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $usuario->getDni(),
        $usuario->getCuil(),
        $usuario->getCorreo(),
        $usuario->getNombre(),
        $usuario->getApellido(),
        $usuario->getContacto(),
        $usuario->getDireccion(),
        $usuario->getUsuario(),
        $usuario->getContrasena(),
        $usuario->getArchivado()
    ]);
}

// Obtener todos los usuarios (que no estén archivados)
function obtenerTodosLosUsuarios(PDO $pdo) {
    $stmt = $pdo->query("SELECT * FROM usuario WHERE archivado = 0");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener un usuario por su ID
function obtenerUsuarioPorId($id, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtener un usuario por su nombre de usuario (campo 'usuario')
function obtenerUsuarioPorUsuario($nombreUsuario, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = ? AND archivado = 0");
    $stmt->execute([$nombreUsuario]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Actualizar datos de un usuario
function actualizarUsuario(Usuario $usuario, PDO $pdo) {
    $sql = "UPDATE usuario SET dni = ?, cuil = ?, correo = ?, nombre = ?, apellido = ?, contacto = ?, direccion = ?, usuario = ?, contrasena = ?, archivado = ?
            WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $usuario->getDni(),
        $usuario->getCuil(),
        $usuario->getCorreo(),
        $usuario->getNombre(),
        $usuario->getApellido(),
        $usuario->getContacto(),
        $usuario->getDireccion(),
        $usuario->getUsuario(),
        $usuario->getContrasena(),
        $usuario->getArchivado(),
        $usuario->getIdUsuario()
    ]);
}

// Archivar un usuario (eliminación lógica)
function archivarUsuario($id, PDO $pdo) {
    $stmt = $pdo->prepare("UPDATE usuario SET archivado = 1 WHERE id_usuario = ?");
    $stmt->execute([$id]);
}

// Verificar credenciales (sin iniciar sesión)
function verificarCredenciales($usuario, $contrasena, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = ? AND archivado = 0");
    $stmt->execute([$usuario]);
    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioData && $usuarioData['contrasena'] === $contrasena) {
        return $usuarioData;
    }
    return false;
}

// Loguearse: inicia sesión si las credenciales son válidas
function loguearse($usuario, $contrasena, PDO $pdo) {
    $usuarioData = verificarCredenciales($usuario, $contrasena, $pdo);

    if ($usuarioData) {
        // Suponemos que session_start() ya fue llamado por quien usa esta función
        $_SESSION['usuario'] = [
            'id_usuario' => $usuarioData['id_usuario'],
            'nombre'     => $usuarioData['nombre'],
            'apellido'   => $usuarioData['apellido'],
            'correo'     => $usuarioData['correo'],
            'nivel'      => $usuarioData['nivel'] ?? null
        ];
        return true;
    }
    return false;
}

// Obtener usuario por DNI
function obtenerUsuarioPorDNI($dni, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE dni = ?");
    $stmt->execute([$dni]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtener usuario por CUIL
function obtenerUsuarioPorCUIL($cuil, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE cuil = ?");
    $stmt->execute([$cuil]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtener usuario por Correo
function obtenerUsuarioPorCorreo($correo, PDO $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE correo = ?");
    $stmt->execute([$correo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Eliminar físicamente un usuario por ID (uso puntual)
function eliminarUsuarioPorId($id_usuario, PDO $pdo) {
    $stmt = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
}

?>