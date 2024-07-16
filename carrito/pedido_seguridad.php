<?php 

require '../admin/config.php'; 
require '../views/header.php'; 


$conn = mysqli_connect("127.0.0.1", "root", "", "surfdamorte");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obteniendo el id_usuario del POST
$id_usuario = $_POST['id'];

// Comenzando la transacción
mysqli_begin_transaction($conn);

try {
    // Obteniendo los carritos del usuario
    $sql_carritos = "SELECT * FROM carrito WHERE id_usuario = $id_usuario";
    $result_carritos = mysqli_query($conn, $sql_carritos);

    if (mysqli_num_rows($result_carritos) > 0) {
        $precio_total = 0;

        // Calculando el precio total del pedido
        while ($row = mysqli_fetch_assoc($result_carritos)) {
            $precio_total += $row['precio'] * $row['cantidad'];
        }

        // Insertando el nuevo pedido
        $fecha_pedido = date('Y-m-d');
        $id_estado = 1; // Suponiendo que el estado inicial es 'Enviado'
        $sql_pedido = "INSERT INTO pedidos (id_usuario, id_estado, fecha_pedido, precio_total) VALUES ($id_usuario, $id_estado, '$fecha_pedido', $precio_total)";
        
        if (!mysqli_query($conn, $sql_pedido)) {
            throw new Exception("Error al insertar el pedido: " . mysqli_error($conn));
        }

        // Obteniendo el id del nuevo pedido
        $CodPed = mysqli_insert_id($conn);

        // Insertar los detalles del pedido en una tabla detalles_pedido
        $sql_detalles_pedido = "INSERT INTO detalles_pedido (CodPed, CodProd, cantidad, precio, nombre) VALUES ";
        $values = [];

        // Reiniciar el resultado de carritos para usarlo de nuevo
        mysqli_data_seek($result_carritos, 0);

        while ($row = mysqli_fetch_assoc($result_carritos)) {
            $CodProd = $row['CodProd'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $nombre = $row['nombre'];
            $values[] = "($CodPed, $CodProd, $cantidad, $precio, '$nombre')";
        }

        $sql_detalles_pedido .= implode(", ", $values);

        if (!mysqli_query($conn, $sql_detalles_pedido)) {
            throw new Exception("Error al insertar los detalles del pedido: " . mysqli_error($conn));
        }

        // Eliminando los carritos del usuario
        $sql_delete_carritos = "DELETE FROM carrito WHERE id_usuario = $id_usuario";
        if (!mysqli_query($conn, $sql_delete_carritos)) {
            throw new Exception("Error al eliminar los carritos: " . mysqli_error($conn));
        }

        // Confirmar la transacción
        mysqli_commit($conn);
        echo "Pedido realizado con éxito";

    } else {
        echo "No hay carritos para este usuario.";
    }

     // Mostrar todos los pedidos del usuario
     $sql_pedidos = "SELECT p.CodPed, p.fecha_pedido, p.precio_total, e.Descripcion as estado
     FROM pedidos p
     JOIN estados e ON p.id_estado = e.Cod_Estado
     WHERE p.id_usuario = $id_usuario";
$result_pedidos = mysqli_query($conn, $sql_pedidos);

if (mysqli_num_rows($result_pedidos) > 0) {
echo "<h2>Pedidos del usuario</h2>";
echo "<table border='1'>";
echo "<h2 style='margin-bottom: 20px;'>Tus pedidos</h2>";
        echo "<div style='overflow-x: auto;'>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background-color: #f2f2f2;'>";
        echo "<th style='padding: 10px; text-align: left;'>ID Pedido</th>";
        echo "<th style='padding: 10px; text-align: left;'>Fecha Pedido</th>";
        echo "<th style='padding: 10px; text-align: left;'>Precio Total</th>";
        echo "<th style='padding: 10px; text-align: left;'>Estado</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result_pedidos)) {
            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['CodPed']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['fecha_pedido']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['precio_total']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['estado']}</td>";
            echo "</tr>";
}
echo "</table>";
} else {
echo "No hay pedidos para este usuario.";
}

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
mysqli_close($conn);

require '../footer.php';  

?>