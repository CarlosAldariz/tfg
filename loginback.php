<?php
session_start();

ini_set('display_errors', 0);

require 'admin/config.php';

if(isset($_POST["usuario"]) && isset($_POST["password"])){
    $usuario = $_POST["usuario"]; 
    $password = $_POST["password"]; 
} else { 
    echo "No has iniciado sesión";
    exit();
}

$conexion = mysqli_connect("127.0.0.1", "root", "" , "surfdamorte");

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

// Usar una declaración preparada para evitar inyección SQL
$stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE Nombre = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && password_verify($password, $row['contraseña'])) {
    $CodRol = $row['CodRol']; 
    $_SESSION["usuario"] = $usuario; 
    $_SESSION["CodRol"] = $CodRol;  

    switch ($CodRol) {
        case 1: // editor
            header('Location:' . RUTA . '/admin');
            exit();
        case 2:
            header('Location: index.php');
            exit();
        case 3:
            header('Location:' . RUTA . '/tienda');
            exit();
        case 4:
            header('Location:' . RUTA . '/root');
            exit();
        default:
            header('Location: index.php');
            exit();
    }
} else {
    echo '<script>alert("Usuario o contraseña incorrectos");</script>'; 
    echo '<script>window.setTimeout(function() { window.location = "login.php"; }, 5);</script>'; 
}

$conexion->close();
?>