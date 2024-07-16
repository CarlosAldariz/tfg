<style> 

@media print { 
    header { 
        display: none;
    } 
    .footer { 
        display: none; 
    } 
    h2 { 
        display: none;
    } 
    .comprar { 
        display:none; 
    } 
    strong { 
        display:none;
    }
    p { 
        display:none;
    } 
    .no-print { 
        display:none;
    }

}
</style>
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
    $sql_carritos = "SELECT * FROM carrito WHERE id_usuario = ?";
    $stmt_carritos = $conn->prepare($sql_carritos);
    $stmt_carritos->bind_param("i", $id_usuario);
    $stmt_carritos->execute();
    $result_carritos = $stmt_carritos->get_result();

    if ($result_carritos->num_rows > 0) {
        $precio_total = 0;

        // Calculando el precio total del pedido
        while ($row = $result_carritos->fetch_assoc()) {
            $precio_total += $row['precio'] * $row['cantidad'];
        }

        // Insertando el nuevo pedido
        $fecha_pedido = date('Y-m-d');
        $id_estado = 1; // Suponiendo que el estado inicial es 'Enviado'
        $sql_pedido = "INSERT INTO pedidos (id_usuario, id_estado, fecha_pedido, precio_total) VALUES (?, ?, ?, ?)";
        $stmt_pedido = $conn->prepare($sql_pedido);
        $stmt_pedido->bind_param("iisd", $id_usuario, $id_estado, $fecha_pedido, $precio_total);
        
        if (!$stmt_pedido->execute()) {
            throw new Exception("Error al insertar el pedido: " . $stmt_pedido->error);
        }

        // Obteniendo el id del nuevo pedido
        $CodPed = $conn->insert_id;

        // Insertar los detalles del pedido en una tabla detalles_pedido
        $sql_detalles_pedido = "INSERT INTO detalles_pedido (CodPed, CodProd, cantidad, precio, nombre) VALUES ";
        $values = [];

        // Reiniciar el resultado de carritos para usarlo de nuevo
        $result_carritos->data_seek(0);

        while ($row = $result_carritos->fetch_assoc()) {
            $CodProd = $row['CodProd'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $nombre = $row['nombre'];
            $values[] = "($CodPed, $CodProd, $cantidad, $precio, '$nombre')";
        }

        $sql_detalles_pedido .= implode(", ", $values);
        if (!$conn->query($sql_detalles_pedido)) {
            throw new Exception("Error al insertar los detalles del pedido: " . $conn->error);
        }

        // Eliminando los carritos del usuario
        $sql_delete_carritos = "DELETE FROM carrito WHERE id_usuario = ?";
        $stmt_delete_carritos = $conn->prepare($sql_delete_carritos);
        $stmt_delete_carritos->bind_param("i", $id_usuario);
        if (!$stmt_delete_carritos->execute()) {
            throw new Exception("Error al eliminar los carritos: " . $stmt_delete_carritos->error);
        }

        // Confirmar la transacción
        mysqli_commit($conn);
        echo "Pedido realizado con éxito";

    } else { 

    }

       echo '<div class="no-print">';
     // Mostrar todos los pedidos del usuario
     $sql_pedidos = "SELECT p.CodPed, p.fecha_pedido, p.precio_total, e.Descripcion as estado
     FROM pedidos p
     JOIN estados e ON p.id_estado = e.Cod_Estado
     WHERE p.id_usuario = ?";
    $stmt_pedidos = $conn->prepare($sql_pedidos);
    $stmt_pedidos->bind_param("i", $id_usuario);
    $stmt_pedidos->execute();
    $result_pedidos = $stmt_pedidos->get_result();

    if ($result_pedidos->num_rows > 0) { 
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
        echo "<th style='padding: 10px; text-align: left;'>Acciones</th>";
        echo "</tr>";

        while ($row = $result_pedidos->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['CodPed']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['fecha_pedido']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['precio_total']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$row['estado']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>
                    <button class='comprar' onclick=\"showDetails({$row['CodPed']})\">Ver Detalles</button>
                  </td>";
            echo "</tr>";
        }
        echo "</table>"; 
        echo '</div>';
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


?>

<script>
function showDetails(CodPed) {
    fetch(`get_order_details.php?CodPed=${CodPed}`)
        .then(response => response.json())
        .then(data => {
            let detailsHtml = '<h3>Detalles del Pedido</h3>';
            detailsHtml += '<table border="1" style="width: 100%; border-collapse: collapse;">';
            detailsHtml += '<tr style="background-color: #f2f2f2;">';
            detailsHtml += '<th style="padding: 10px; text-align: left;">Nombre del Producto</th>';
            detailsHtml += '<th style="padding: 10px; text-align: left;">Cantidad</th>';
            detailsHtml += '<th style="padding: 10px; text-align: left;">Precio</th>';
            detailsHtml += '</tr>';
            data.forEach(item => {
                detailsHtml += `<tr>`;
                detailsHtml += `<td style="padding: 10px; border: 1px solid #ddd;">${item.nombre}</td>`;
                detailsHtml += `<td style="padding: 10px; border: 1px solid #ddd;">${item.cantidad}</td>`;
                detailsHtml += `<td style="padding: 10px; border: 1px solid #ddd;">${item.precio}</td>`;
                detailsHtml += `</tr>`;
            });
            detailsHtml += '</table>';
            document.getElementById('orderDetails').innerHTML = detailsHtml;
        })
        .catch(error => console.error('Error:', error));
}
</script>

<div id="orderDetails"></div>  

<script>
function showDetails(CodPed) {
    fetch(`get_order_details.php?CodPed=${CodPed}`)
        .then(response => response.json())
        .then(data => {
            let detailsHtml = '<h3>Detalles del Pedido</h3>';
            detailsHtml += '<button style="margin-bottom: 10px;" class="comprar" onclick="window.print()">Imprimir Factura</button>';
            detailsHtml += '<table border="1" style="width: 100%; border-collapse: collapse;">';
            detailsHtml += '<tr style="background-color: #f2f2f2;">';
            detailsHtml += '<th style="padding: 10px; text-align: left;">Nombre del Producto</th>';
            detailsHtml += '<th style="padding: 10px; text-align: left;">Cantidad</th>';
            detailsHtml += '<th style="padding: 10px; text-align: left;">Precio</th>';
            detailsHtml += '</tr>';
            data.forEach(item => {
                detailsHtml += `<tr>`;
                detailsHtml += `<td style="padding: 10px; border: 1px solid #ddd;">${item.nombre}</td>`;
                detailsHtml += `<td style="padding: 10px; border: 1px solid #ddd;">${item.cantidad}</td>`;
                detailsHtml += `<td style="padding: 10px; border: 1px solid #ddd;">${item.precio}</td>`;
                detailsHtml += `</tr>`; 
                
            });
            detailsHtml += '</table>';
            document.getElementById('orderDetails').innerHTML = detailsHtml;
        })
        .catch(error => console.error('Error:', error));
}
</script>

<?php require '../footer.php';   ?>