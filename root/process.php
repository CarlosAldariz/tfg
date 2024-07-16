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
        // Prepare and execute the first DELETE statement
        $sql1 = "DELETE FROM carrito WHERE id_usuario=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $stmt1->close();
    
        // Prepare and execute the second DELETE statement
        $sql2 = "DELETE FROM pedidos WHERE id_usuario=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();
    
        // Prepare and execute the third DELETE statement
        $sql3 = "DELETE FROM usuarios WHERE id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("i", $id);
        $stmt3->execute();
        $stmt3->close();
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