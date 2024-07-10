<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "surfdamorte";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $CodPed = $_POST['CodPed'];
    $id_estado = $_POST['id_estado'];

    if ($id_estado == 4) { // Si la opción seleccionada es borrar
        // Obtener los detalles del pedido
        $sql_detalles = "SELECT CodProd, cantidad FROM detalles_pedido WHERE CodPed = ?";
        $stmt_detalles = $conn->prepare($sql_detalles);
        $stmt_detalles->bind_param("i", $CodPed);
        $stmt_detalles->execute();
        $result_detalles = $stmt_detalles->get_result();

        // Actualizar el stock de los productos
        while ($row = $result_detalles->fetch_assoc()) {
            $CodProd = $row['CodProd'];
            $cantidad = $row['cantidad'];

            $sql_update_stock = "UPDATE productos SET stock = stock + ? WHERE CodProd = ?";
            $stmt_update_stock = $conn->prepare($sql_update_stock);
            $stmt_update_stock->bind_param("ii", $cantidad, $CodProd);
            $stmt_update_stock->execute();
        }

        // Eliminar los detalles del pedido
        $sql_delete_detalles = "DELETE FROM detalles_pedido WHERE CodPed = ?";
        $stmt_delete_detalles = $conn->prepare($sql_delete_detalles);
        $stmt_delete_detalles->bind_param("i", $CodPed);
        $stmt_delete_detalles->execute();

        // Eliminar el pedido
        $sql_delete_pedido = "DELETE FROM pedidos WHERE CodPed = ?";
        $stmt_delete_pedido = $conn->prepare($sql_delete_pedido);
        $stmt_delete_pedido->bind_param("i", $CodPed);
        $stmt_delete_pedido->execute();

        header("Location: index.php");
    } else {
        // Actualizar el estado del pedido
        $sql = "UPDATE pedidos SET id_estado = ? WHERE CodPed = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_estado, $CodPed);

        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error al actualizar el estado del pedido: " . $conn->error;
        }
    }
}

$conn->close();
?>