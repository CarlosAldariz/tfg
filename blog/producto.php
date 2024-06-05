<?php 

require 'admin/config.php'; 
require 'functions.php'; 

$conexion = conexion($bd_config); 
$id_articulo = id_articulo($_GET['CodProd']);

if (!$conexion) { 
    header('Location: error.php');
} 

if(empty($id_articulo)) { 
    header('Location: index.php');
} 

$post = obtener_post_por_id_producto($conexion, $id_articulo); 

if (!$post) { 
    header('Location: Index.php');
} 

$post = $post[0];

require 'views/producto.view.php';

?>