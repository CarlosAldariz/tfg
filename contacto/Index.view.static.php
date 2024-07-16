<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title> 
    <link rel="stylesheet" href="estilos.css"> 
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="wrap"> 
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <textarea name="mensaje" class="form-control" id="mensaje" placeholder="Mensaje:"></textarea> 
        
            <?php if (!empty($errores)):  ?>
                <div class="alert error"> 
                    <?php echo $errores; ?> 
                </div> 
            <?php elseif ($enviado): ?>
                <div class="alert success"> 
                 <p> Enviado Correctamente </p> 
             </div> 
        <?php endif ?>


            <input type="submit" name="submit" btn="btn btn-primary" value="Enviar Correo">
        </form> 
    </div>

</body>
</html>