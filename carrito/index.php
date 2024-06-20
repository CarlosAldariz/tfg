<?php
require '../admin/config.php'; 
require '../views/header.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CodProd'])) {
    $usuario = $_SESSION['usuario'];
    $CodProd = intval($_POST['CodProd']);  

    //busco el id del usuario mediante una query  

    //busco el precio mediante el $codprod usando una quuery  

    //saco el nombre del producto en un codprod (query)

    //añado como precio total a una variable
    
    //inserto id_usuario, $codprod, 1, 

    $conn =  mysqli_connect("127.0.0.1", "root", "" , "surfdamorte");

    $stmt = $conn->prepare("INSERT INTO Carrito (usuario, CodProd) VALUES (?, ?)");
    $stmt->bind_param("ii", $usuario, $CodProd);

    if ($stmt->execute()) {
        echo "Producto añadido al carrito con éxito.";
    } else {
        echo "Error al añadir el producto al carrito.";
    }

    $stmt->close();
} 

require '../footer.php'; 

?>