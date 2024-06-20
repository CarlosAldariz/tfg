<?php
require '../admin/config.php'; 
require '../views/header.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
} 

$conn =  mysqli_connect("127.0.0.1", "root", "" , "surfdamorte");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CodProd'])) {
    $usuario = $_SESSION['usuario'];
    $CodProd = intval($_POST['CodProd']);  

    //busco el id del usuario mediante una query   
        $nomusu = $conn->prepare("SELECT id FROM Usuarios WHERE nombre = $usuario");
    $id_usuario = ($nomusu->execute());
    //busco el precio mediante el $codprod usando una quuery   
    $mony = $conn->prepare("SELECT precio FROM Productos WHERE CodProd = $CodProd"); 
    $precio = ($mony->execute());
    //saco el nombre del producto en un codprod (query)
    $nomprod = $conn->prepare("SELECT nombre FROM Productos WHERE CodProd = $CodProd"); 
    $nombreprod = ($nomprod->execute());
    //añado como precio total a una variable
    $preciototal += $precio;
    //inserto id_usuario, $codprod, 1,  
    $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, CodProd, cantidad, precio, nombre) VALUES ($id_usuario, $CodProd, 1, $nomprod"); 


    if ($stmt->execute()) {
        echo "Producto añadido al carrito con éxito.";
    } else {
        echo "Error al añadir el producto al carrito.";
    }

    $stmt->close();
}  

    //sacar pon pantalla el carrito con el id usuario 

    //añadir un boton para ejecutar el pedido 

    //restar el stock 

    // mostrar la factura por pdf (si puedes, saca datos por pantalla e inmediatamente imprimelos, seria top); 

    

require '../footer.php'; 

?>