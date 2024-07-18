<?php
session_start();

require 'config.php'; 
require '../functions.php';


$conexion = conexion($bd_config); 

if (!$conexion) { 
    header('Location: ../error.php');
    exit();
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $titulo = limpiarDatos($_POST['titulo']); 
    $extracto = limpiarDatos($_POST['extracto']); 
    $text = limpiarDatos($_POST['text']); 
    $id = limpiarDatos($_POST['id']); 
    $thumb_guardada = $_POST['thumb-guardada']; 
    $thumb = $_FILES['thumb'];

    if (empty($thumb['name'])) { 
        $thumb = $thumb_guardada;
    } else { 
        $archivo_subido = '../' . $blog_config['carpeta_imagenes'] . basename($_FILES['thumb']['name']);
        move_uploaded_file($_FILES['thumb']['tmp_name'], $archivo_subido); 
        $thumb = $_FILES['thumb']['name']; 
    } 

    $statement = $conexion->prepare(
        'UPDATE articulos SET titulo = :titulo, extracto = :extracto, text = :text, thumb = :thumb WHERE id = :id' 
    ); 

    $statement->execute(array( 
        ':titulo' => $titulo, 
        ':extracto' => $extracto,
        ':text' => $text,
        ':thumb' => $thumb,
        ':id' => $id
    ));

    header('Location: ' . RUTA . '/admin');
    exit();
} else { 
    $id_articulo = id_articulo($_GET['id']);  

    if (empty($id_articulo)) { 
        header('Location: ' . RUTA . '/admin');
        exit();
    } 

    $post = obtener_post_por_id($conexion, $id_articulo); 

    if (!$post) { 
        header('Location: ' . RUTA . '/admin');
        exit();
    } 

    $post = $post[0]; 
}

require '../views/editar.view.php'; 
?>