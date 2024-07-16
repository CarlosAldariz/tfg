<?php
require '../admin/config.php'; 
require '../views/header.php'; 


if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}  

error_reporting(E_ERROR);
ini_set('display_errors', '0');

$conn = mysqli_connect("127.0.0.1", "root", "", "surfdamorte");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CodProd'])) {
    $usuario = $_SESSION['usuario'];
    $CodProd = intval($_POST['CodProd']);  

    // Buscar el id del usuario mediante una query   
    $nomusu = $conn->prepare("SELECT id FROM Usuarios WHERE nombre = ?");
    $nomusu->bind_param('s', $usuario);
    $nomusu->execute();
    $result = $nomusu->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_usuario = $row['id'];
    } else {
        echo "<h2>Usuario no encontrado.</h2>";
        mostrarCarrito($conn, $id_usuario);
        require '../footer.php';  
        exit();
    }

    // Verificar el stock del producto
    $stock_check = $conn->prepare("SELECT stock FROM Productos WHERE CodProd = ?");
    $stock_check->bind_param('i', $CodProd);
    $stock_check->execute();
    $result = $stock_check->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock = $row['stock'];
        if ($stock <= 0) {
            echo "<h2>No hay stock suficiente para ese producto. </h2>";  
            mostrarCarrito($conn, $id_usuario);
            require '../footer.php';  
            exit();
        }
    } else {
        echo "<h2>Producto no encontrado.</h2>"; 
        mostrarCarrito($conn, $id_usuario);
        require '../footer.php';  
        exit();
    }

    // Buscar el precio del producto
    $mony = $conn->prepare("SELECT precio FROM Productos WHERE CodProd = ?");
    $mony->bind_param('i', $CodProd);
    $mony->execute();
    $result = $mony->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $precio = $row['precio'];
    } else {
        echo "<h2>Producto no encontrado.</h2>"; 
        mostrarCarrito($conn, $id_usuario);
        require '../footer.php';  
        exit();
    }

    // Sacar el nombre del producto
    $nomprod = $conn->prepare("SELECT nombre FROM Productos WHERE CodProd = ?");
    $nomprod->bind_param('i', $CodProd);
    $nomprod->execute();
    $result = $nomprod->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreprod = $row['nombre'];
    } else {
        echo "<h2>Producto no encontrado.</h2>"; 
        mostrarCarrito($conn, $id_usuario);
        require '../footer.php';  
        exit();
    }

    // Insertar id_usuario, $CodProd, 1, $precio, $nombreprod
    $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, CodProd, cantidad, precio, nombre) VALUES (?, ?, 1, ?, ?)");
    $stmt->bind_param('iids', $id_usuario, $CodProd, $precio, $nombreprod);

    if ($stmt->execute()) {
        echo "<h2>Producto añadido al carrito con éxito.</h2>"; 

        mostrarCarrito($conn, $id_usuario);
        require '../footer.php';

        // Restar el stock del producto
        $restarStock = $conn->prepare("UPDATE Productos SET stock = stock - 1 WHERE CodProd = ?");
        $restarStock->bind_param('i', $CodProd);
        $restarStock->execute();
        $restarStock->close();

    } else {
        echo "<h2>Error al añadir el producto al carrito.</h2>";
        mostrarCarrito($conn, $id_usuario);
        require '../footer.php';  
    }

    $stmt->close();
    $nomusu->close();
    $mony->close();
    $nomprod->close();

} else {
    // Mostrar el carrito y el footer si no se ha enviado ningún dato
    $usuario = $_SESSION['usuario'];

    // Obtener el id del usuario
    $nomusu = $conn->prepare("SELECT id FROM Usuarios WHERE nombre = ?");
    $nomusu->bind_param('s', $usuario);
    $nomusu->execute();
    $result = $nomusu->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_usuario = $row['id'];
        mostrarCarrito($conn, $id_usuario);
    } else {
        echo "<h2>Usuario no encontrado.</h2>";
    }

    require '../footer.php';  
}

function mostrarCarrito($conn, $id_usuario) {
    // Obtener los productos del carrito del usuario y calcular el precio total
    $query = $conn->prepare("SELECT id, nombre, cantidad, precio FROM carrito WHERE id_usuario = ?");
    $query->bind_param('i', $id_usuario);
    $query->execute();
    $result = $query->get_result();

    $total = 0;
    if ($result->num_rows > 0) { 
        echo "<br>";
        echo "<h2 style='margin-bottom: 20px;'>Tu carrito</h2>";
        echo "<div style='overflow-x: auto;'>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background-color: #f2f2f2;'>";
        echo "<th style='padding: 10px; text-align: left;'>Producto</th>";
        echo "<th style='padding: 10px; text-align: center;'>Cantidad</th>";
        echo "<th style='padding: 10px; text-align: center;'>Precio</th>";
        echo "<th style='padding: 10px; text-align: center;'>Subtotal</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            $nombre = $row['nombre'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];  
            $subtotal = $cantidad * $precio;
            $total += $subtotal;

            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>$nombre</td>";
            echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>$cantidad</td>";
            echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>$precio</td>";
            echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>$subtotal</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";

        echo "<h3 style='margin-top: 20px;'>Precio total del pedido: $total</h3>";

    } else {
        echo "<p style='margin-top: 20px;'>El carrito está vacío.</p>";
    } 

    echo "<br>";

    echo "<form action='borrarcarrito.php' method='post'>"; 
    echo "<input type='hidden' name='id' value='$id_usuario'>";
    echo "<button class='comprar' type='submit'>Cancelar Pedido</button>";    
    echo "</form>";   

    echo "<br>";

    //antes de la eliminacion del carrito recuerda restaurar el stock 

    echo "<form action='pedido.php' method='post'>"; 
    echo "<input type='hidden' name='id' value='$id_usuario'>";
    echo "<button class='comprar' type='submit'>Realizar Pedido</button>";    
    echo "</form>";  

    echo "<br>";

    echo "<form action='pedido_ver.php' method='post'>"; 
    echo "<input type='hidden' name='id' value='$id_usuario'>";
    echo "<button class='comprar' type='submit'>Ver Pedido/s</button>";    
    echo "</form>";  
}

//crear en el root una pagina que nos permita controlar el estado de los pedidos

$nomusu->close();
require '../footer.php';  

?>