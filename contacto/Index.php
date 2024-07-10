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

        mail ($enviar_a, $asunto, $mensaje_preparado);
    }
}
    require 'index.view.php';
    ?>
</body>
</html>