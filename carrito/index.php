<?php
require '../admin/config.php'; 
require '../views/header.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
} 

$conn = mysqli_connect("127.0.0.1", "root", "", "surfdamorte");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CodProd'])) {
    $usuario = $_SESSION['usuario'];
    $CodProd = intval($_POST['CodProd']);  

    print_r($CodProd);

    // Buscar el id del usuario mediante una query   
    $nomusu = $conn->prepare("SELECT id FROM Usuarios WHERE nombre = ?");
    $nomusu->bind_param('s', $usuario);
    $nomusu->execute();
    $result = $nomusu->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_usuario = $row['id'];
    } else {
        echo "Usuario no encontrado.";
        exit();
    }

    // Buscar el precio mediante el $CodProd usando una query   
    $mony = $conn->prepare("SELECT precio FROM Productos WHERE CodProd = ?");
    $mony->bind_param('i', $CodProd);
    $mony->execute();
    $result = $mony->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $precio = $row['precio'];
    } else {
        echo "Producto no encontrado.";
        exit();
    }

    // Sacar el nombre del producto usando $CodProd (query)
    $nomprod = $conn->prepare("SELECT nombre FROM Productos WHERE CodProd = ?");
    $nomprod->bind_param('i', $CodProd);
    $nomprod->execute();
    $result = $nomprod->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreprod = $row['nombre'];
    } else {
        echo "Producto no encontrado.";
        exit();
    }

    // Añadir el precio total a una variable
    $preciototal += $precio;

    // Insertar id_usuario, $CodProd, 1, $precio, $nombreprod
    $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, CodProd, cantidad, precio, nombre) VALUES (?, ?, 1, ?, ?)");
    $stmt->bind_param('iids', $id_usuario, $CodProd, $precio, $nombreprod);

    if ($stmt->execute()) {
        echo "Producto añadido al carrito con éxito.";
    } else {
        echo "Error al añadir el producto al carrito.";
    }

    $stmt->close();
    $nomusu->close();
    $mony->close();
    $nomprod->close();
}

// Sacar por pantalla el carrito con el id del usuario

// Añadir un botón para ejecutar el pedido

// Restar el stock

// Mostrar la factura por PDF (si puedes, saca datos por pantalla e inmediatamente imprimelos, sería top);

require '../footer.php'; 
?>