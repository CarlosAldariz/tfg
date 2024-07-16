<?php 



function conexion($bd_config) { 
try { 
   $conexion = new PDO('mysql:host=localhost; dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']); 
   return $conexion;
} catch (PDOException $e) { 
    return false;
} 
}  

function limpiarDatos($datos){ 
    $datos = trim($datos); 
     $datos = stripslashes($datos); 
     $datos = htmlspecialchars($datos); 
     return $datos;
}  

function obtener_post($post_por_pagina, $conexion){  
    $inicio = (pagina_actual() > 1 ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0); 
    $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM articulos LIMIT $inicio, $post_por_pagina"); 
    $sentencia->execute(); 
    return $sentencia->fetchAll();
}  

function obtener_productos($post_por_pagina, $conexion){  
    $inicio = (pagina_actual() > 1 ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0); 
    $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM PRODUCTOS LIMIT $inicio, $post_por_pagina"); 
    $sentencia->execute(); 
    return $sentencia->fetchAll();
}  

function numero_paginas($post_por_pagina, $conexion){ 
        $total_post = $conexion->prepare('SELECT FOUND_ROWS() as total'); 
        $total_post->execute(); 
        $total_post = $total_post->fetch()['total']; 

        $numero_paginas = ceil($total_post / $post_por_pagina); 
        return $numero_paginas;
} 

function numero_paginas_playas($post_por_pagina, $conexion) {
    // Ejecutar la consulta con SQL_CALC_FOUND_ROWS para obtener el número total de filas 
    $inicio = (pagina_actual() > 1 ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0); 
    $stmt = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM playas");
    $stmt->execute();

    $total_post = $conexion->query('SELECT FOUND_ROWS()')->fetchColumn();

    $numero_paginas = ceil($total_post / $post_por_pagina);

    return $numero_paginas;
}

function pagina_actual(){ 
    return isset($_GET['p']) ? (int)$_GET['p'] : 1;
} 

function id_articulo($id){ 
    return (int)limpiarDatos($id);
} 

function obtener_post_por_id($conexion, $id){ 
    $resultado = $conexion->query("SELECT * FROM articulos WHERE id = $id LIMIT 1"); 
    $resultado = $resultado->fetchAll(); 
    return ($resultado) ? $resultado : false;
} 

function fecha($fecha){ 
    $timestamp = strtotime($fecha); 
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']; 

    $dia = date('d', $timestamp); 
    $mes = date('m', $timestamp) - 1; 
    $year = date('Y', $timestamp); 

    $fecha = "$dia de " .$meses[$mes] . "de $year"; 
    return $fecha;
} 

// function comprobarSession(){ 
//     if (!isset($_SESSION['admin'])) { 
//         header('Location: ' . RUTA);
//     }
// } 

function obtener_post_playas($post_por_pagina, $conexion){  
    $inicio = (pagina_actual() > 1 ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0); 
    $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM playas LIMIT $inicio, $post_por_pagina"); 
    $sentencia->execute(); 
    return $sentencia->fetchAll();
}   

function obtener_post_por_id_playa($conexion, $id){ 
    $resultado = $conexion->query("SELECT * FROM playas WHERE id = $id LIMIT 1"); 
    $resultado = $resultado->fetchAll(); 
    return ($resultado) ? $resultado : false;
}  


function obtener_post_por_id_producto($post_por_pagina, $conexion, $id){  
    $inicio = (pagina_actual() > 1 ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0); 
    $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM productos where CodCat = $id LIMIT $inicio, $post_por_pagina"); 
    $sentencia->execute(); 
    return $sentencia->fetchAll();
}  


function obtener_post_categorias($post_por_pagina, $conexion){  
    $inicio = (pagina_actual() > 1 ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0); 
    $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM Categorias_Productos"); 
    $sentencia->execute(); 
    return $sentencia->fetchAll();
}    

// function obtener_post_productos($post_por_pagina, $conexion){  
//     $inicio = (pagina_actual() > 1 ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0); 
//     $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM Productos WHERE CodProd = $id LIMIT $inicio, $post_por_pagina"); 
//     $sentencia->execute(); 
//     return $sentencia->fetchAll();
// }     

function obtener_producto_por_id($conexion, $id) {
    $resultado = $conexion->query("SELECT * FROM Productos WHERE CodProd = $id LIMIT 1");
    $resultado = $resultado->fetchAll();
    return ($resultado) ? $resultado[0] : false;
} 

function obtener_categorias($conexion) {
    $statement = $conexion->prepare("SELECT * FROM Categorias_Articulos");
    $statement->execute();
    return $statement->fetchAll();
}


// Función para obtener el precio total del carrito
function obtenerPrecioTotal($conn, $id_usuario) {
    $query = $conn->prepare("SELECT SUM(cantidad * precio) AS total FROM carrito WHERE id_usuario = ?");
    $query->bind_param('i', $id_usuario);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}


// Función para obtener el ID del usuario
function obtenerIdUsuario($conn, $usuario) {
    $nomusu = $conn->prepare("SELECT id FROM Usuarios WHERE nombre = ?");
    $nomusu->bind_param('s', $usuario);
    $nomusu->execute();
    $result = $nomusu->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        return null;
    }
}
?>