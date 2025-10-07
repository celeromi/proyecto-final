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

        <h1 class="center">Detalle de <?php echo $this->alumno->matricula;?></h1>
        
        <div class="center"><?php echo $this->mensaje; ?></div>
        
        <form action="<?php echo constant('URL');?>consulta/actualizarAlumno" method="POST">
            <P>
                <label for="matricula">matricula</label><br>
                <input type="text" name="matricula" disabled value="<?php echo $this->alumno->matricula;?>">
            </P>
            <P>
                <label for="nombre">nombre</label><br>
                <input type="text" name="nombre" value="<?php echo $this->alumno->nombre;?>">
            </P>
            <P>
                <label for="apellido">apellido</label><br>
                <input type="text" name="apellido" value="<?php echo $this->alumno->apellido;?>">
            </P>
            <p>
                <input type="submit" value="Actualizar" required>
            </p>
    </div>

    <?php require 'views/layouts/footer.php';?>

</body>
</html>