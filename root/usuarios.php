<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/views.css">
</head>
<body>
<?php 
session_start();   
require '../admin/config.php'; 
require '../functions.php';
require '../views/header.php'; 

if (($_SESSION["CodRol"]) != 4) { 
    echo "<h1 style='text-align: center; margin-top: 20%; margin-bottom: 20%;'>No tienes los permisos suficientes, ponte en contacto con el administrador</h1>"; 
    require '../footer.php' ;
    exit ();
}
?>


<div class="contenedor">
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

$sql = "SELECT id, nombre, CodRol FROM usuarios WHERE nombre != 'root'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>  

    .select { 
        color: var(--color2); 
        background: var(--color5);
    }

    .custom-select {
            position: relative;
            width: 200px;
            font-size: 16px;
        }

        .custom-select select {
            display: none; /* Oculta el select original */
        }

        
      

    </style>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>";
                echo "<form method='POST' action='process.php'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<select name='CodRol' class='custom-select'>";
                echo "<option value='1'" . ($row["CodRol"] == 1 ? " selected" : "") . ">Editor</option>";
                echo "<option value='2'" . ($row["CodRol"] == 2 ? " selected" : "") . ">Usuario</option>";
                echo "<option value='3'" . ($row["CodRol"] == 3 ? " selected" : "") . ">Gestor Tienda</option>";
                echo "</select>";
                echo "<button type='submit' name='action' value='update' class='comprar'>Cambiar Rol</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='POST' action='process.php'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<button type='submit' name='action' value='delete' class='comprar'>Eliminar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay usuarios</td></tr>";
        }
        $conn->close(); 
        ?>
        </tbody>
    </table>
</body>
</html>
</div>
<?php require '../footer.php'; ?>
</body>
</html>