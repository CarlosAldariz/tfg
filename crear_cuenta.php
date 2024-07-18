<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/views.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.formulario').on('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario
                var usuario = $('input[name="usuario"]').val();
                var clave = $('input[name="clave"]').val();
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: {
                        usuario: usuario,
                        clave: clave,
                        ajax: true
                    },
                    success: function(response) {
                        if (response === 'existe') {
                            $('#mensaje_error').text('El usuario ya existe. Por favor, elige otro nombre de usuario.').show();
                        } else if (response === 'creado') {
                            $('#mensaje_error').hide();
                            $('#mensaje_exito').text('Cuenta creada exitosamente. ¡Bienvenido, ' + usuario + '!');
                        } else {
                            $('#mensaje_error').text('El usuario ya existe. Por favor, elige otro nombre de usuario').show();
                        }
                    }
                });
            });
        });
    </script>
</head>

<body>
    <?php 
    session_start();
    require 'admin/config.php';
    require 'functions.php';
    require 'views/header.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $hashedClave = password_hash($clave, PASSWORD_DEFAULT);
        $CodRol = 2; 

        $conexion = new mysqli('localhost', $bd_config['usuario'], $bd_config['pass'], $bd_config['basedatos']);

        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        $stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE nombre = ?");
        if ($stmt) {
            $stmt->bind_param('s', $usuario);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'existe';
            } else {
                $stmt->close();
                $stmt = $conexion->prepare("INSERT INTO Usuarios (nombre, contraseña, CodRol) VALUES (?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param('ssi', $usuario, $hashedClave, $CodRol);
                    if ($stmt->execute()) {
                        $_SESSION['usuario'] = $usuario;
                        echo 'creado';
                    } else {
                        echo 'error';
                    }
                    $stmt->close();
                } else {
                    echo 'error';
                }
            }
        } else {
            echo 'error';
        }

        $conexion->close();
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['ajax'])) {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $hashedClave = password_hash($clave, PASSWORD_DEFAULT);
        $CodRol = 2; 

        $conexion = new mysqli('localhost', $bd_config['usuario'], $bd_config['pass'], $bd_config['basedatos']);

        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        $stmt = $conexion->prepare("INSERT INTO Usuarios (nombre, contraseña, CodRol) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('ssi', $usuario, $hashedClave, $CodRol);
            if ($stmt->execute()) {
                $_SESSION['usuario'] = $usuario;
                $mensaje_exito = "Cuenta creada exitosamente. ¡Bienvenido, $usuario!"; 
                header("Refresh: 6; URL=index.php");
            } else {
                $error = "Error al crear la cuenta el nombre de usuario ya existe. Por favor, prueba con otro nombre de usuario.";
            }
            $stmt->close();
        } else {
            $error = "Error en la preparación de la consulta. Por favor, intenta nuevamente.";
        }

        $conexion->close();
    }
    ?>

    <div class="contenedor">
        <div class="post">
            <article>
                <h2 class="titulo">Crear Cuenta</h2>
                <form class="formulario" method="post" action="">
                    <input type="text" name="usuario" placeholder="usuario" required>
                    <input type="password" name="clave" placeholder="contraseña" required>
                    <input type="submit" value="Crear Cuenta"> 
                    <br>
                </form>
                <p id="mensaje_error" style="color: red; display: none;"></p>
                <p id="mensaje_exito" style="color: #07575b; padding: 10px; background-color: #c4dfe6; display: none;"></p>
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p> 
                <?php elseif (!empty($mensaje_exito)): ?> 
                    <br>
                    <p style="color: #07575b; padding: 10px; background-color: #c4dfe6;"><?php echo $mensaje_exito; ?></p> 
                    <p style="color:#07575b;padding: 10px; background-color: #c4dfe6;">Serás redirigido a la página principal en 5 segundos.</p>
                <?php endif; ?>
            </article>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>