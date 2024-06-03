<?php 

    define('RUTA', 'http://localhost/php_udemy/blog/'); 

$bd_config = array( 
    'basedatos' => 'blog_practica', 
    'usuario' => 'root', 
    'pass' => ''
); 

$blog_config = array( 
    'post_por_pagina' => '3', 
    'carpeta_imagenes' => 'imagenes/', 
); 

$blog_admin = array( 
    'usuario' => 'editor', 
    'password' => '123'
);

?>