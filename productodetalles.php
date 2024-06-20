<?php 

require 'admin/config.php'; 
require 'functions.php'; 

$conexion = conexion($bd_config); 
$id_producto = id_articulo($_GET['id']); // Puedes cambiar el nombre de la función para mayor claridad

if (!$conexion) { 
    header('Location: error.php');
    exit;
} 

if(empty($id_producto)) { 
    header('Location: index.php');
    exit;
} 

$producto = obtener_producto_por_id($conexion, $id_producto); 

if (!$producto) { 
    header('Location: index.php');
    exit;
} 

$producto = $producto;

require 'views/producto.view.php';

?>