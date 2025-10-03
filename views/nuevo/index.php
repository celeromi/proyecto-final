<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php require 'views/layouts/header.php';?>
    
    <div id="main">
        <h1 class="center">Seccion de Nuevo</h1>
        <form action="<?php echo constant('URL');?>nuevo/registrar" method="POST">
            <P>
                <label for="matricula">matricula</label><br>
                <input type="text" name="matricula" id="">
            </P>
            <P>
                <label for="nombre">nombre</label><br>
                <input type="text" name="nombre" id="">
            </P>
            <P>
                <label for="apellido">apellido</label><br>
                <input type="text" name="apellido" id="">
            </P>
            <p>
                <input type="submit" value="Registrar">
            </p>
    </div>

    <?php require 'views/layouts/footer.php';?>

</body>
</html>