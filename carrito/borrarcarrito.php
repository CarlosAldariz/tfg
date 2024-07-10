<?php
require '../admin/config.php'; 
require '../views/header.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Obtener el ID del producto a eliminar del formulario
    $id_carrito = $_POST['id']; 

    print_r($id_carrito);

    // Conectar a la base de datos
    $conn = mysqli_connect("127.0.0.1", "root", "", "surfDaMorte");
    if (!$conn) {
        echo "Error al conectar a la base de datos: " . mysqli_connect_error();
        exit;
    }

    $sql = "DELETE FROM Carrito WHERE id_usuario = '$id_carrito'";
    
    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        // Redireccionar de vuelta al menú después de eliminar el producto
        header("location: Index.php");
        exit; // Detener la ejecución del script después de redireccionar
    } else {
        echo "Error al eliminar el producto del carrito: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else { 
    echo "Tratas de borrar un carrito inexistente";
}

require '../footer.php';   
?>