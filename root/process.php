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
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

    if ($id && $action) {
        if ($action == "delete") {
            // Start transaction
            $conn->begin_transaction();

            try {
                // Prepare and execute the DELETE statements
                $sql1 = "DELETE FROM carrito WHERE id_usuario=?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("i", $id);
                if (!$stmt1->execute()) {
                    throw new Exception($stmt1->error);
                }
                $stmt1->close();

                $sql4 = "DELETE FROM detalles_pedido WHERE CodPed IN (SELECT CodPed FROM pedidos WHERE id_usuario=?)";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->bind_param("i", $id);
                if (!$stmt4->execute()) {
                    throw new Exception($stmt4->error);
                }
                $stmt4->close();

                $sql2 = "DELETE FROM pedidos WHERE id_usuario=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("i", $id);
                if (!$stmt2->execute()) {
                    throw new Exception($stmt2->error);
                }
                $stmt2->close();

                $sql3 = "DELETE FROM usuarios WHERE id=?";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bind_param("i", $id);
                if (!$stmt3->execute()) {
                    throw new Exception($stmt3->error);
                }
                $stmt3->close();

                // Commit transaction
                $conn->commit();
            } catch (Exception $e) {
                // Rollback transaction on error
                $conn->rollback();
                error_log($e->getMessage());
                die("Error occurred: " . $e->getMessage());
            }
        } elseif ($action == "update") {
            $CodRol = filter_input(INPUT_POST, 'CodRol', FILTER_SANITIZE_NUMBER_INT);
            if ($CodRol) {
                $sql = "UPDATE usuarios SET CodRol=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $CodRol, $id);
                if (!$stmt->execute()) {
                    error_log($stmt->error);
                    die("Error occurred: " . $stmt->error);
                }
                $stmt->close();
            }
        }
    }
}

$conn->close();
header("Location: index.php");
exit();
?>