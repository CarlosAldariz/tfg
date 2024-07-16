<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form backend</title>
</head>
<body> 
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
    //     } else { 
    //         $errores .= 'ingresa un correo <br />';
    //     }  

        if (!empty($mensaje)) {
            $mensaje = htmlspecialchars($mensaje);
            $mensaje = trim($mensaje); 
            $mensaje = stripslashes($mensaje);
    } else { 
        $errores .= 'Ingresa el mensaje <br />';
    } 

    if (!$errores) { 
        $enviar_a = $correo; //ESTA PARTE ESTÁ CAMBIADA, COMPROBAR
        $asunto = 'Mensaje de prueba'; 
        $mensaje_preparado = "De $nombre \n"; 
        $mensaje_preparado .= "Mensaje: " . $_POST['mensaje']; 

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
                // Si el producto ya existe, sumar cantidad y actualizar subtotal
                $productos_unicos[$nombre_prod]['cantidad'] += $cantidad;
                $productos_unicos[$nombre_prod]['subtotal'] += $subtotal;
            } else {
                // Si el producto no existe, agregarlo al array
                $productos_unicos[$nombre_prod] = [
                    'nombre' => $nombre_prod,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $subtotal
                ];
            }
        }

        // Generar mensaje de correo con los productos procesados
        foreach ($productos_unicos as $producto) {
            $mensaje_preparado .= "Producto: {$producto['nombre']}, Cantidad: {$producto['cantidad']}, Precio: {$producto['precio']}, Subtotal: {$producto['subtotal']} \n";
        }

        mail($enviar_a, $asunto, $mensaje_preparado);
        $enviado = 'true';
    }
}
    require 'index.view.php'; 

    ?>
</body>
</html>