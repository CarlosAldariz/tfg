<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
</head>
<body>
    <?php 

    require 'admin/config.php'; 

    require 'functions.php'; 

    $conexion = conexion($bd_config); 
    $id = id_articulo($_GET['id']);


    if (!$conexion) { 
        header('Location: error.php');
    } 

    $posts = obtener_post_por_id_producto($blog_config['post_por_pagina'], $conexion, $id); 

    if (!$posts) { 
        header('Location: error.php');
    } 

    require 'views/productos.view.php';  

    ?>
</body>
</html>