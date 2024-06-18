<?php 

$conexion = ("localhost", "root", "surfdamorte", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CodProd = $_POST['CodProd'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];

    // Validación de entrada
    if (empty($CodProd) || empty($startDate) || empty($endDate)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Inserta la reserva en la base de datos
    $sql = "INSERT INTO Reservas (CodProd, fecha_inicio, fecha_fin) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $CodProd, $startDate, $endDate);

    if ($stmt->execute()) {
        echo "Reserva realizada con éxito.";
    } else {
        echo "Error al realizar la reserva: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>