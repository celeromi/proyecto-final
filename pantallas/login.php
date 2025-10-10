<?php
// login.php
session_start();

// Simulamos una base de datos con usuario y contraseña
$valid_username = 'admin'; // El nombre de usuario correcto
$valid_password = 'password123'; // La contraseña correcta

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si el usuario y la contraseña son correctos
    if ($username === $valid_username && $password === $valid_password) {
        // Si es correcto, redirigir a la página de inicio
        $_SESSION['logged_in'] = true;
        header("Location: productos.php"); // Cambiar por la URL de tu página de inicio
        exit();
    } else {
        // Si el usuario o la contraseña son incorrectos, mostrar el modal de error
        $_SESSION['login_error'] = true;
        header("Location: index.php");
        exit();
    }
}
?>

