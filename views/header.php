<?php 
    ini_set('display_errors', '0');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head> 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href='https://font.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> 
    <link href='https://font.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">  
    <link rel="stylesheet" href="<?php echo RUTA; ?>css/views.css"> 
    <title>header</title>   
    <?php 
    ?>
</head> 
    <header>   
    <div class="contenedor"> 
        <div class="logo izquierda">  
                <p><a href="<?php echo RUTA; ?>">Noticias</a></p>  
                
        </div> 
            <div class="logo izquierda"> 
                <p><a href="<?php echo RUTA; ?>playas.php">&nbsp; &nbsp; &nbsp; Acceso a Playas</a></p>
            </div>  
            <div  class="logo izquierda"> 
                <p><a href="<?php echo RUTA; ?>tienda.php">&nbsp; &nbsp; &nbsp; Tienda</a></p>
            </div>    
            <div class="derecha"> 
                <form name="busqueda" class="buscar" action="<?php echo RUTA; ?>/buscador_mejorado.php" method="get"> 
                    <input type="text" name="busqueda" placeholder="Buscar"> 
                    <button type="submit" class="icono fa fa-search"></button>
            </form> 

            <nav class="menu"> 
                <?php 
                if(($_SESSION["CodRol"])==4){  
                    echo '<ul>'; 
                    echo '<li><a href="' . RUTA . 'root/">Administrar</a></li>'; 
                    echo '</ul>';
                } 
                else if (($_SESSION["CodRol"])==1){  
                    echo '<ul>'; 
                    echo '<li><a href="' . RUTA . 'admin/">Editor</a></li>'; 
                    echo '</ul>';
                }  
                else if(($_SESSION["CodRol"])==3){  
                    echo '<ul>'; 
                    echo '<li><a href="' . RUTA . 'tienda/">Tienda</a></li>'; 
                    echo '</ul>';
                } 
                if(!isset($_SESSION["usuario"])){
                    ?>
                    <ul> 
                        <li><a href="<?php echo RUTA; ?>login.php">Login <i class="fa fa-anchor"></i></a></li> 
                    </ul> 
                    <?php
                }
                ?>
            </nav> 
            <nav class="menu1"> 
            <?php
                if(isset($_SESSION["usuario"])){
                    ?>
                    <ul> 
                        <li><a href="<?php echo RUTA; ?>admin/cerrar.php">|Cerrar Sesión<i class="fa fa-umbrella" aria-hidden="true"></i></a></li> 
                    </ul>
                    <?php
                }
                ?>
            </nav> 
            <nav class="carro"> 
                <ul> 
                    <li><a href="<?php echo RUTA; ?>carrito/index.php">|Carro<i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li> 
                </ul>
            </div> 

        </div>
    </header> 