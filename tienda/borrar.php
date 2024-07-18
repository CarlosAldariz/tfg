<?php
session_start();

if ($_SESSION["CodRol"] != 4 && $_SESSION["CodRol"] != 3) {
    require '../views/header.php';
    echo "<h1 style='text-align: center; margin-top: 20%; margin-bottom: 20%;'>No tienes los permisos suficientes, ponte en contacto con el administrador</h1>";
    require '../footer.php';
    exit();
}

if (isset($_GET['id'])) {
    // Obtiene el ID enviado por GET
    $id = $_GET['id'];

    // Datos de conexión a la base de datos
    $servername = "localhost"; // Puedes cambiar esto si tu base de datos no está en localhost
    $username = "root"; // Nombre de usuario de la base de datos
    $password = ""; // Contraseña de la base de datos (en este caso no hay contraseña)
    $dbname = "surfdamorte"; // Nombre de la base de datos

    // Crea una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para actualizar el estado y stock en la tabla productos
    $sql = "UPDATE productos SET estado = 2, stock = 0 WHERE CodProd = $id";

    // Ejecuta la consulta de actualización en la tabla productos
    if ($conn->query($sql) === TRUE) {
        // Consulta SQL para eliminar el producto del carrito
        $sql_delete = "DELETE FROM carrito WHERE CodProd = $id";

        // Ejecuta la consulta de eliminación en la tabla carrito
        if ($conn->query($sql_delete) === TRUE) {
            header('Location: index.php');
        } else {
            echo "Error al eliminar artículo del carrito: " . $conn->error;
        }
    } else {
        echo "Error al actualizar artículo: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    header('Location: index.php');
}
?>