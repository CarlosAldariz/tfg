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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == "delete") {
        $sql = "DELETE FROM usuarios WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == "update") {
        $CodRol = $_POST['CodRol'];
        $sql = "UPDATE usuarios SET CodRol=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $CodRol, $id);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
header("Location: index.php");
exit();
?>