<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
</head>
<body>
    <?php 
    require 'config.php'; 
    require '../functions.php'; 

    $conexion = conexion($bd_config); 

    if (!$conexion) { 
        header('Location: error.php');
    } 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = limpiarDatos($_POST['nombre']);
        $descripcion = limpiarDatos($_POST['descripcion']);
        $precio = limpiarDatos($_POST['precio']);
        $stock = limpiarDatos($_POST['stock']);
        $codcat = limpiarDatos($_POST['codcat']);
        $imagen = $_FILES['imagen']['name'];
        $archivo_subido = 'imagenes/' . $_FILES['imagen']['name'];

        move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo_subido);

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
    }

    require '../views/create.view.php';
    ?>
</body>
</html>