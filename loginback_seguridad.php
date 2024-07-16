<?php
session_start();    

ini_set('display_errors', 0);

require 'admin/config.php';

if(isset($_POST["usuario"]) && isset($_POST["password"])){
    $usuario = $_POST["usuario"]; 
    $password = $_POST["password"]; 
} else{ 
echo "no has iniciado sesion";
} 
 
$conexion = mysqli_connect("127.0.0.1", "root", "" , "surfdamorte");

$contr = "SELECT * FROM Usuarios WHERE Nombre = '$usuario'";
$result = mysqli_query($conexion, $contr);
$row = mysqli_fetch_array($result); 

if ($row['nombre'] == $usuario){ // && password_verify($password, $row['contraseña'])) { 
   $CodRol = $row['CodRol']; 
   $_SESSION["usuario"] = $usuario; 
   $_SESSION["password"] = $password; 
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



?> 