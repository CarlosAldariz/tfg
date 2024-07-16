<?php 

require 'admin/config.php'; 
require 'functions.php'; 

$conexion = conexion($bd_config); 
if (!$conexion) { 
    header('Location: error.php'); 
    exit();
} 

$titulo = '';
$resultados = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])) { 
    $busqueda = limpiarDatos($_GET['busqueda']); 
    $queries = [
        'articulos' => 'SELECT * FROM articulos WHERE titulo LIKE :busqueda OR text LIKE :busqueda',
        'playas' => 'SELECT * FROM playas WHERE nombre LIKE :busqueda OR descripcion LIKE :busqueda',
        'productos' => 'SELECT * FROM productos WHERE nombre LIKE :busqueda OR descripcion LIKE :busqueda'
    ];

    foreach ($queries as $table => $query) {
        $statement = $conexion->prepare($query); 
        $statement->execute([':busqueda' => "%$busqueda%"]); 
        $resultados = array_merge($resultados, $statement->fetchAll());
    }

    if (empty($resultados)) {
        $titulo = 'No se encontraron resultados para: ' . $busqueda;
    } else {
        $titulo = 'Resultados de la búsqueda para: ' . $busqueda;
    }
} else { 
    header('Location: ' . RUTA . '/index.php');
    exit();
} 

require 'views/buscar_mejorado.view.php';

?>