<?php 
require 'config.php'; 
require '../functions.php'; 

$conexion = conexion($bd_config); 

if (!$conexion) { 
    header('Location: error.php');
    exit;
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = limpiarDatos($_POST['nombre']);
    $descripcion = limpiarDatos($_POST['descripcion']);
    $precio = limpiarDatos($_POST['precio']);
    $stock = limpiarDatos($_POST['stock']);
    $codcat = limpiarDatos($_POST['codcat']);
    $imagen = $_FILES['imagen']['name'];
    $archivo_subido = '../imagenes/productos/imagenes_tienda/' . $_FILES['imagen']['name'];

    move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo_subido);

    // Validar que el precio y el stock no sean negativos
    if ($precio < 0 || $stock < 0) {
        require '../views/header.php';
        
        echo '<div style="text-align: center; margin-top: 50px;">';
        echo "<h1>No se puede crear el producto porque el precio o el stock son negativos.</h1>";
        echo '</div>';
        require '../footer.php'; 

        echo '<meta http-equiv="refresh" content="5;url=create.php">';
        exit;
    }

    $statement = $conexion->prepare(
        'INSERT INTO Productos (nombre, descripcion, precio, imagen, CodCat, stock) 
        VALUES (:nombre, :descripcion, :precio, :imagen, :codcat, :stock)'
    );
    $statement->execute(array(
        ':nombre' => $nombre,
        ':descripcion' => $descripcion,
        ':precio' => $precio,
        ':imagen' => $imagen,
        ':codcat' => $codcat,
        ':stock' => $stock
    ));

    header('Location: index.php');
    exit;
}

require '../views/create.view.php';
?>