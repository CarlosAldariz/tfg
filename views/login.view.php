 <?php require 'header.php';?> 
<!-- 
<div class="contenedor"> 
        <div class="post">  
            <article>  
                
                <h2 class="titulo">Iniciar Sesión</h2> 
                <form class="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> 
                    <input type="text" name="usuario" placeholder="usuario"> 
                    <input type="password" name="password" placeholder="Contraseña"> 
                    <input type="submit" value="Iniciar Sesión">
                </form>
            </article>
        </div> 
</div> -->

<?php

// Iniciar sesión
session_start();



try {
    $conexion;
} catch (PDOException $e) {
    die('Error al conectar con la base de datos: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener usuario y contraseña del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta SQL para obtener los datos del usuario
    $sql = "SELECT nombre, contraseña, CodRol FROM Usuarios WHERE nombre = :usuario";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Bind de parámetros
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el usuario y contraseña
    if ($resultado) {
        // Verificar la contraseña
        if (password_verify($password, $resultado['contraseña'])) {
            // Iniciar sesión y redirigir según el rol
            $_SESSION['usuario'] = $usuario;

            switch ($resultado['CodRol']) {
                case 1: // editor
                    header('Location:' . RUTA . '/admin' );
                    break;
                case 2: // usuario
                    header('Location: index.php');
                    break;
                case 3: // tienda
                    header <?php require 'header.php';?> 
<!-- 
<div class="contenedor"> 
        <div class="post">  
            <article>  
                
                <h2 class="titulo">Iniciar Sesión</h2> 
                <form class="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> 
                    <input type="text" name="usuario" placeholder="usuario"> 
                    <input type="password" name="password" placeholder="Contraseña"> 
                    <input type="submit" value="Iniciar Sesión">
                </form>
            </article>
        </div> 
</div> -->

<?php

// Iniciar sesión
session_start();



try {
    $conexion;
} catch (PDOException $e) {
    die('Error al conectar con la base de datos: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener usuario y contraseña del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta SQL para obtener los datos del usuario
    $sql = "SELECT nombre, contraseña, CodRol FROM Usuarios WHERE nombre = :usuario";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Bind de parámetros
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el usuario y contraseña
    if ($resultado) {
        // Verificar la contraseña
        if (password_verify($password, $resultado['contraseña'])) {
            // Iniciar sesión y redirigir según el rol
            $_SESSION['usuario'] = $usuario;

            switch ($resultado['CodRol']) {
                case 1: // editor
                    header('Location:' . RUTA . '/admin' );
                    break;
                case 2: // usuario
                    header('Location: index.php');
                    break;
                case 3: // tienda
                    header('Location:' . RUTA . '/tienda' );
                    break;
                case 4: // root
                    header('Location: root/root.php');
                    break;
                default:
                    // Si no se encuentra el rol adecuado, redirigir a algún lugar por defecto
                    header('Location: index.php');
                    break;
            }

            exit();
        } else {
            echo '<p>Contraseña incorrecta</p>';
        }
    } else {
        echo '<p>Usuario no encontrado</p>';
    }
}
?>

<div class="contenedor"> 
    <div class="post">  
        <article>  
            <h2 class="titulo">Iniciar Sesión</h2> 
            <form class="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> 
                <input type="text" name="usuario" placeholder="Usuario"> 
                <input type="password" name="password" placeholder="Contraseña"> 
                <input type="submit" value="Iniciar Sesión">
            </form>
        </article>
    </div> 
</div>


<?php require 'footer.php' ; ?> ;
                    break;
                case 4: // root
                    header('Location: root/root.php');
                    break;
                default:
                    // Si no se encuentra el rol adecuado, redirigir a algún lugar por defecto
                    header('Location: index.php');
                    break;
            }

            exit();
        } else {
            echo '<p>Contraseña incorrecta</p>';
        }
    } else {
        echo '<p>Usuario no encontrado</p>';
    }
}
?>

<div class="contenedor"> 
    <div class="post">  
        <article>  
            <h2 class="titulo">Iniciar Sesión</h2> 
            <form class="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> 
                <input type="text" name="usuario" placeholder="Usuario"> 
                <input type="password" name="password" placeholder="Contraseña"> 
                <input type="submit" value="Iniciar Sesión">
            </form>
        </article>
    </div> 
</div>


<?php require 'footer.php' ; ?> 