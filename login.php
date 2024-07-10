<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title> 
    <link rel="stylesheet" href="css/estilos.css">  
    <link rel="stylesheet" href="css/views.css">  
</head>

<body> 
 <?php 
  session_start(); 
 session_destroy();    
 require 'admin/config.php'; 
 require 'functions.php';
 require 'views/header.php';
     ?> 
    
    <div class="contenedor"> 
    <div class="post">  
        <article>  
            <h2 class="titulo">Iniciar Sesión</h2> 
            <form class="formulario" method="post" action="loginback.php"> 
                <input type="text" name="usuario" placeholder="usuario"> 
                <input type="password" name="password" placeholder="contraseña"> 
                <input type="submit" value="Iniciar Sesión"> 
                <a href="crear_cuenta.php" class="link-button">Crear cuenta</a>
            </form>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </article>
    </div> 
</div>
<?php require 'footer.php'; ?>