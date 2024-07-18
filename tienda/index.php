<?php session_start(); 



require 'config.php'; 
require '../functions.php'; 

$conexion = conexion($bd_config); 

// comprobarSession();

if (!$conexion) { 
    header ('Location: ../error.php');
} 

$posts = obtener_productos($config_tienda['post_por_pagina'], $conexion); 

require '../views/tienda_inex.view.php';

?>