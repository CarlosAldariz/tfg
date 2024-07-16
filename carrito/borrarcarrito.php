<?php
require '../admin/config.php'; 
require '../views/header.php'; 

session_start();  

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Obtener el ID del usuario del formulario
    $id_usuario = $_POST['id']; 

    // Conectar a la base de datos
    $conn = mysqli_connect("127.0.0.1", "root", "", "surfDaMorte");
    if (!$conn) {
        echo "Error al conectar a la base de datos: " . mysqli_connect_error();
        exit;
    }

    // Obtener los productos del carrito del usuario
    $query = $conn->prepare("SELECT CodProd, cantidad FROM carrito WHERE id_usuario = ?");
    $query->bind_param('i', $id_usuario);
    $query->execute();
    $result = $query->get_result();

    // Iterar sobre los productos del carrito para restaurar el stock
    while ($row = $result->fetch_assoc()) {
        $CodProd = $row['CodProd'];
        $cantidad = $row['cantidad'];

        // Actualizar el stock del producto sumando la cantidad del carrito
        $restaurarStock = $conn->prepare("UPDATE Productos SET stock = stock + ? WHERE CodProd = ?");
        $restaurarStock->bind_param('ii', $cantidad, $CodProd);
        $restaurarStock->execute();
        $restaurarStock->close();
    }

    // Eliminar todos los productos del carrito del usuario
    $sql = "DELETE FROM carrito WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_usuario);
    $stmt->execute();
    $stmt->close();

    // Redireccionar de vuelta al menú después de eliminar el carrito
    header("Location: Index.php");
    exit();
} else {
    echo "Intento de eliminar un carrito inexistente.";
}

require '../footer.php';   
?>