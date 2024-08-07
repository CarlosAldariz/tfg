<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <?php  
    require 'config.php'; 
    require '../functions.php'; 

    $conexion = conexion($bd_config); 

    if (!$conexion) { 
        header('Location: error.php');
    } 

    $id = limpiarDatos($_GET['id']);

    if (!$id) {
        header('Location: index.php');
    }

    $producto = obtener_producto_por_id($conexion, $id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = limpiarDatos($_POST['nombre']);
        $descripcion = limpiarDatos($_POST['descripcion']);
        $precio = limpiarDatos($_POST['precio']);
        $stock = limpiarDatos($_POST['stock']);
        $codcat = limpiarDatos($_POST['codcat']); 
        $estado = limpiarDatos($_POST['estado']);  // Añadimos la captura del estado
        $imagen_guardada = $_POST['imagen-guardada'];
        $imagen = $_FILES['imagen']['name'];

        // Validación del precio y stock
        if ($precio <= 0 || $stock <= 0) {
            $error = "El precio y el stock deben ser mayores a 0.";
        } else {
            if (empty($imagen)) {
                $imagen = $imagen_guardada;
            } else {
                $archivo_subido = 'imagenes/' . $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo_subido);
            }

            $statement = $conexion->prepare(
                'UPDATE Productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, imagen = :imagen, CodCat = :codcat, stock = :stock, estado = :estado WHERE CodProd = :id'
            );
            $statement->execute(array(
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':precio' => $precio,
                ':imagen' => $imagen,
                ':codcat' => $codcat,
                ':stock' => $stock,
                ':estado' => $estado,  // Incluimos el estado en la consulta
                ':id' => $id
            ));

            header('Location: index.php');
        }
    }

    require '../views/edit.view.php';
    ?>

</body>
</html>