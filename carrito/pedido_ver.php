<?php 

require '../admin/config.php'; 
require '../views/header.php'; 


$conn = mysqli_connect("127.0.0.1", "root", "", "surfdamorte");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$id_usuario = $_POST['id'];

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
echo "<h2> No realizaste ningún pedido pero estás a tiempo </h2>";
} 

require '../footer.php';  

?>