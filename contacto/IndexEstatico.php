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
    $mensaje_preparado = '';

    if (isset($_POST['submit'])) { 
        $mensaje = $_POST['mensaje']; 

        if (!empty($mensaje)) {
            $mensaje = htmlspecialchars($mensaje);
            $mensaje = trim($mensaje); 
            $mensaje = stripslashes($mensaje);
    } else { 
        $errores .= 'Ingresa el mensaje <br />';
    } 

    if (!$errores) { 
        $enviar_a = "carlosaldariz@hotmail.com";
        $asunto = 'Envío Estático'; 
        $mensaje_preparado .= "Mensaje: " . $_POST['mensaje']; 

        mail ($enviar_a, $asunto, $mensaje_preparado);
    }
}
    require 'Index.view.static.php';
    ?>
</body>
</html>