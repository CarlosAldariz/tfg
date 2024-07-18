<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title> 

    <style> 

    img { 
        height: 240px;
    }

    </style>

</head>
<body>
    <?php 

    require 'admin/config.php'; 

    require 'functions.php'; 

    $conexion = conexion($bd_config); 

    if (!$conexion) { 
        header('Location: error.php');
    } 

    $posts = obtener_post_categorias($blog_config['post_por_pagina'], $conexion); 

    if (!$posts) { 
        header('Location: error.php');
    } 

    require 'views/tienda.view.php';  

    ?>
</body>
</html>