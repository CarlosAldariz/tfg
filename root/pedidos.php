<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pedidos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/views.css">
</head>
<body>
<?php 
session_start();   
require '../admin/config.php'; 
require '../functions.php';
require '../views/header.php';
?>

<div class="contenedor">
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

$sql = "SELECT p.CodPed, p.fecha_pedido, p.precio_total, p.id_estado, e.Descripcion AS estado, u.nombre AS usuario 
        FROM pedidos p 
        JOIN estados e ON p.id_estado = e.Cod_Estado 
        JOIN usuarios u ON p.id_usuario = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Pedidos</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>  
        .select { 
            color: var(--color2); 
            background: var(--color5);
        }

        .custom-select {
            position: relative;
            width: 200px;
            font-size: 16px;
        }

        .custom-select select {
            display: none; /* Oculta el select original */
        }

        .table-header {
            background-color: #f2f2f2;
        }

        .table-cell, .table-cell-center {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table-cell-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Lista de Pedidos</h1>
    <table>
        <thead>
            <tr class="table-header">
                <th class="table-cell">Usuario</th>
                <th class="table-cell-center">Fecha</th>
                <th class="table-cell-center">Precio Total</th>
                <th class="table-cell-center">Estado</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='table-cell'>" . $row["usuario"] . "</td>";
                echo "<td class='table-cell-center'>" . $row["fecha_pedido"] . "</td>";
                echo "<td class='table-cell-center'>" . $row["precio_total"] . "</td>";
                echo "<td class='table-cell-center'>";
                echo "<form method='POST' action='proceso_pedidos.php'>";
                echo "<input type='hidden' name='CodPed' value='" . $row["CodPed"] . "'>";
                echo "<select name='id_estado' class='custom-select'>";
                echo "<option value='1'" . ($row["id_estado"] == 1 ? " selected" : "") . ">Enviado</option>";
                echo "<option value='2'" . ($row["id_estado"] == 2 ? " selected" : "") . ">Entregado</option>";
                echo "<option value='3'" . ($row["id_estado"] == 3 ? " selected" : "") . ">Cancelado</option>";
                echo "<option value='4'>Borrar</option>"; // Nueva opción para borrar
                echo "</select>";
                echo "<button type='submit' name='action' value='update' class='comprar'>Cambiar Estado</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='table-cell-center'>No hay pedidos</td></tr>";
        }
        $conn->close(); 
        ?>
        </tbody>
    </table>
</body>
</html>
</div>
<?php require '../footer.php'; ?>
</body>
</html>