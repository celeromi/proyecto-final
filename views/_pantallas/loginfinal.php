<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/img/baer-logo.png" type="image/png">
    <title>Login - Baer Cosméticos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #333333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Lato', sans-serif;
        }
        .login-container {
            background-color: #1f1f1f;
            padding: 40px 20px;
            border-radius: 8px;
            text-align: center;
            width: 400px;
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }
        .login-container img {
            width: 150px;
            margin: 30px auto;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 80%;
            padding: 15px;
            margin: 10px auto;
            border-radius: 5px;
            border: none;
            background-color: #eee;
            font-size: 16px;
        }
        .login-container input[type="submit"] {
            width: 80%;
            padding: 15px;
            margin: 20px auto;
            border-radius: 5px;
            border: none;
            background-color: #607d8b;
            color: white;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }
        .login-container a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background-color: #edeef6;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .modal-content h2 {
            font-size: 24px;
            color: black;
        }
        .modal-content button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #607d8b;
            color: white;
        }
    </style>
</head>
<body>
<div class="login-container">
    <img src="assets/img/images.png" alt="Baer Cosméticos">
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="submit" value="Ingresar">
    </form>
    <a href="#" onclick="openRecoverModal()">Recuperar contraseña</a>
</div>

<!-- Modal de recuperación de contraseña -->
<div id="recoverModal" class="modal">
    <div class="modal-content">
        <h2>Recuperar contraseña</h2>
        <p>Ingresa tu correo para recuperar tu contraseña:</p>
        <form onsubmit="handleRecover(event)">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <button type="submit">Enviar</button>
        </form>
    </div>
</div>

<!-- Modal de confirmación -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <i class="fas fa-check-circle" style="font-size: 40px; color: #4CAF50;"></i>
        <h2>¡Correo enviado!</h2>
        <p>Revisa tu bandeja de entrada para continuar con el proceso de recuperación.</p>
        <button onclick="closeModal('confirmationModal')">Aceptar</button>
    </div>
</div>

<!-- Modal de error de login -->
<?php if (isset($_SESSION['login_error']) && $_SESSION['login_error'] === true): ?>
    <div id="errorModal" class="modal" style="display: flex;">
        <div class="modal-content">
            <i class="fas fa-times-circle" style="font-size: 40px; color: #D32F2F;"></i>
            <h2>¡Credenciales incorrectas!</h2>
            <p>Por favor, verifica tu usuario y contraseña.</p>
            <button onclick="closeModal('errorModal')">Aceptar</button>
        </div>
    </div>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<script>
    function openRecoverModal() {
        document.getElementById("recoverModal").style.display = "flex";
    }
    function handleRecover(event) {
        event.preventDefault();
        closeModal('recoverModal');
        document.getElementById("confirmationModal").style.display = "flex";
    }
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
</script>
</body>
</html>
