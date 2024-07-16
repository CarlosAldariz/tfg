<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title> 
    <link rel="stylesheet" href="estilos.css"> 
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body> 
    <?php   
    require '../admin/config.php';
    require '../views/header.php';
    ?> 

    <div class="wrap">   
        <h2> Dejanos un mensaje </h2>
        <form class="mail" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre:" value=""> 

            <!-- <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo:" value="">  -->

            <textarea name="mensaje" class="form-control" id="mensaje" placeholder="Mensaje:"></textarea> 
        
            <?php if (!empty($errores)):  ?>
                <div class="alert error"> 
                    <?php echo $errores; ?> 
                </div> 
            <?php elseif ($enviado): ?>
                <div class="alert success"> 
                 <p> Enviado Correctamente </p> 
             </div> 
            <?php endif ?>


            <input type="submit" name="submit" class="btn btn-primary" value="Enviar Correo">
        </form>  
        Dejanos un correo de contacto y trataremos de responderte con la mayor brevedad posible
    </div>

    <?php  
    require '../footer.php';
    ?>    

</body>
</html>

<?php  

error_reporting(E_ALL);

$errores = ''; 
$enviado = '';

if (isset($_POST['submit'])) { 
    $nombre = $_POST['nombre']; 
    $correo = 'carlosaldariz@hotmail.com';  
    // $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje']; 

    if (!empty($nombre)) { 
        $nombre = trim($nombre); 
        //$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    } else { 
        $errores .= 'Ingresa un nombre <br />';
    }

    // if (!empty($correo)) {
    //     $correo = filter_var($correo, FILTER_SANITIZE_EMAIL); 

    //     if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) { 
    //         $errores .= 'Ingresa un correo valido <br />';  
    //     }
    // } else { 
    //     $errores .= 'Ingresa un correo <br />';
    // }  

    if (!empty($mensaje)) {
        $mensaje = htmlspecialchars($mensaje);
        $mensaje = trim($mensaje); 
        $mensaje = stripslashes($mensaje);
    } else { 
        $errores .= 'Ingresa el mensaje <br />';
    } 

    if (!$errores) { 
        $enviar_a = $correo;
        $asunto = 'Mensaje de prueba'; 
        $mensaje_preparado = "De $nombre \n"; 
        $mensaje_preparado .= "Mensaje: " . $_POST['mensaje'] . "\n\n";

        // Supongamos que tenemos productos en un array
        $productos = [
            ['nombre' => 'Producto A', 'cantidad' => 2, 'precio' => 10],
            ['nombre' => 'Producto B', 'cantidad' => 1, 'precio' => 20],
            ['nombre' => 'Producto A', 'cantidad' => 3, 'precio' => 10]
        ];

        // Array para almacenar productos únicos
        $productos_unicos = [];

        // Procesar productos para sumar cantidades y calcular subtotales
        foreach ($productos as $producto) {
            $nombre_prod = $producto['nombre'];
            $cantidad = $producto['cantidad'];
            $precio = $producto['precio'];
            $subtotal = $cantidad * $precio;

            if (isset($productos_unicos[$nombre_prod])) {
                // Si el producto ya existe, sumar cantidad y actualizar subtotal y precio total
                $productos_unicos[$nombre_prod]['cantidad'] += $cantidad;
                $productos_unicos[$nombre_prod]['subtotal'] += $subtotal;
                $productos_unicos[$nombre_prod]['precio_total'] += $cantidad * $precio;
            } else {
                // Si el producto no existe, agregarlo al array
                $productos_unicos[$nombre_prod] = [
                    'nombre' => $nombre_prod,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $subtotal,
                    'precio_total' => $cantidad * $precio
                ];
            }
        }

        // Generar mensaje de correo con los productos procesados
        foreach ($productos_unicos as $producto) {
            $mensaje_preparado .= "Producto: {$producto['nombre']}, Cantidad: {$producto['cantidad']}, Precio Unitario: {$producto['precio']}, Precio Total: {$producto['precio_total']}, Subtotal: {$producto['subtotal']} \n";
        }

        mail($enviar_a, $asunto, $mensaje_preparado);
        $enviado = 'true';
    }
}

require 'index.view.php';
?>