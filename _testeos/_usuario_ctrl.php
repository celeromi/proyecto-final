<?php
require_once __DIR__ . '/../controladores/usuario_ctrl.php';

//  Buscar usuario con id = 1
echo "<h3> Usuario con ID = 1:</h3>";
$usuario1 = obtenerUsuarioPorId(1, $pdo);
echo $usuario1 ? "<pre>" . print_r($usuario1, true) . "</pre>" : "Usuario no encontrado.";

//  Crear nuevo usuario
echo "<h3> Creando nuevo usuario de prueba...</h3>";
$usuarioNuevo = new Usuario(
    99887766,                      // dni
    2099887766,                    // cuil
    'testuser@email.com',          // correo
    'Test',                        // nombre
    'User',                        // apellido
    3411234567,                    // contacto
    'Calle Test 123',              // direccion
    'testuser123',                 // usuario
    'claveTemporal2025',           // contrasena
    0                              // archivado
);
crearUsuario($usuarioNuevo, $pdo);
echo "Usuario creado correctamente.";

//  Obtener todos los usuarios
echo "<h3> Listando todos los usuarios activos:</h3>";
$usuarios = obtenerTodosLosUsuarios($pdo);
echo "<pre>" . print_r($usuarios, true) . "</pre>";

//  Buscar por nombre de usuario
echo "<h3> Buscando usuario con usuario = 'testuser123':</h3>";
$usuarioPorNombre = obtenerUsuarioPorUsuario('testuser123', $pdo);
if ($usuarioPorNombre) {
    echo "<pre>" . print_r($usuarioPorNombre, true) . "</pre>";
    
    // 🟠 Modificar datos del usuario creado
    echo "<h3>🟠 Modificando correo y contacto...</h3>";
    $usuarioMod = new Usuario(
        $usuarioPorNombre['dni'],
        $usuarioPorNombre['cuil'],
        'nuevo_email@test.com',               // nuevo correo
        $usuarioPorNombre['nombre'],
        $usuarioPorNombre['apellido'],
        3517654321,                           // nuevo contacto
        $usuarioPorNombre['direccion'],
        $usuarioPorNombre['usuario'],
        $usuarioPorNombre['contrasena'],
        $usuarioPorNombre['archivado']
    );
    $usuarioMod->setIdUsuario($usuarioPorNombre['id_usuario']);
    actualizarUsuario($usuarioMod, $pdo);
    echo "Usuario actualizado correctamente.<br>";
    echo "<pre>" . print_r($usuarioPorNombre, true) . "</pre>";}

    //  Archivar el usuario creado
    echo "<h3> Archivando el usuario creado...</h3>";
    archivarUsuario($usuarioPorNombre['id_usuario'], $pdo);
    echo "Usuario archivado correctamente.<br>";
    
} else {
    echo "Usuario 'testuser123' no encontrado.";
}

//  Buscar por nombre de usuario
echo "<h3> Buscando usuario con usuario = 'testuser123':</h3>";
$usuarioPorNombre = obtenerUsuarioPorUsuario('testuser123', $pdo);
if ($usuarioPorNombre) {
    echo "<pre>" . print_r($usuarioPorNombre, true) . "</pre>";
} else {
    echo "Usuario 'testuser123' no encontrado.";
}
?>