<?php 
session_start(); 
 
if (($_SESSION["CodRol"]) != 4) { 
if (($_SESSION["CodRol"]) != 3) {  
    require '../views/header.php';
    echo "<h1 style='text-align: center; margin-top: 20%; margin-bottom: 20%;'>No tienes los permisos suficientes, ponte en contacto con el administrador</h1>"; 
    require '../footer.php' ;
    exit ();
 } }

if(isset($_GET['id'])) {
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
    
    // Ejecuta la consulta para seleccionar la base de datos
    $sql = "USE surfdamorte";
    if ($conn->query($sql) === TRUE) {
        // Consulta SQL para eliminar un artículo con el ID recibido
        $sql = "DELETE FROM productos WHERE CodProd = $id";
        
        // Ejecuta la consulta de eliminación
        if ($conn->query($sql) === TRUE) {
            header ('Location: index.php');
        } else {
            echo "Error al eliminar artículo: " . $conn->error;
        }
    } else {
        echo "Error al seleccionar la base de datos: " . $conn->error;
    }
    
    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    header ('Location: index.php');
}
?>