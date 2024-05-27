<?php  session_start();

require = 'config.php'; 
require '../functions.php';

$conexion = conexion($bd_config); 

comprobarSession();

if (!$conexion) { 
    header ('Location: ../error.php');
} 

if ($_SERVER['REQUEST_METHOD' == 'POST']){ 

} else { 
    $id_articulo = id_articulo($_GET['id']); 

    if ()
}

require '../views/editar.view.php'; 

?>