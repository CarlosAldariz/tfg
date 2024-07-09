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
?>

<div class="contenedor">
    <div class="post">
        <article>
            <h2 class="titulo">Selecciona la función</h2>
            <form action="" method="post">
                <button class="comprar" type="submit" name="action" value="editor">Editor</button>
                <button class="comprar" type="submit" name="action" value="gestor_tienda">Gestor Tienda</button>
                <button class="comprar" type="submit" name="action" value="gestor_usuario">Gestor de Usuario</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                switch ($_POST['action']) {
                    case 'editor':
                        header('Location: ' . RUTA . '/admin');
                        exit;
                    case 'gestor_tienda':
                        header('Location: ' . RUTA . '/tienda');
                        exit;
                    case 'gestor_usuario':
                        header('Location: ' . RUTA . '/root/usuarios.php');
                        exit;
                }
            }
            ?>
        </article>
    </div>
</div>
<?php require '../footer.php'; ?>
</body>
</html>