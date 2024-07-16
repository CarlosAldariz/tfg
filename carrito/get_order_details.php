<?php

require '../admin/config.php';

$conn = mysqli_connect("127.0.0.1", "root", "", "surfdamorte");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$CodPed = intval($_GET['CodPed']);

$sql_detalles = "SELECT nombre, cantidad, precio FROM detalles_pedido WHERE CodPed = ?";
$stmt_detalles = $conn->prepare($sql_detalles);
$stmt_detalles->bind_param("i", $CodPed);
$stmt_detalles->execute();
$result_detalles = $stmt_detalles->get_result();

$details = [];

while ($row = $result_detalles->fetch_assoc()) {
    $details[] = $row;
}

echo json_encode($details);

mysqli_close($conn);

?>