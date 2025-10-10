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

        <h1 class="center">Seccion de Nuevo Usuario</h1>
        
        <div class="center"><?php echo $this->mensaje; ?></div>
        
        <form action="<?php echo constant('URL');?>nuevo/registrar" method="POST">
            <P>
                <label for="matricula">Identificador</label><br>
                <input type="text" name="matricula" id="">
            </P>
            <P>
                <label for="nombre">nombre</label><br>
                <input type="text" name="nombre" id="" required>
            </P>
            <P>
                <label for="apellido">apellido</label><br>
                <input type="text" name="apellido" id="" required>
            </P>
            <p>
                <input type="submit" value="Registrar" required>
            </p>
    </div>

    <?php require 'views/layouts/footer.php';?>

</body>
</html>