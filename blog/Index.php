<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

    require 'admin/config.php'; 

    require 'functions.php'; 

    $conexion = conexion($bd_config); 

    if (!$conexion) { 
        header('Location: error.php');
    } 

    $posts = obtener_post($blog_config['post_por_pagina'], $conexion); 

    if (!$posts) { 
        header('Location: error.php');
    } 

    require 'views/index.view.php';  

    ?>
</body>
</html>