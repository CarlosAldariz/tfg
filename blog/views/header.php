<!DOCTYPE html>
<html lang="en">
<head> 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href='https://font.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> 
    <link href='https://font.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css"> 
    <title>header</title> 
</head>
<body>
    <header> 
        <div class="contenedor"> 
        <div class="logo izquierda">  
                <p><a href="<?php echo RUTA; ?>">Noticias</a></p>
            </div>  
            <div class="logo izquierda"> 
                <p><a href="#">&nbsp; &nbsp; &nbsp; Acceso a Playas</a></p>
            </div>  
            <div class="logo izquierda"> 
                <p><a href="#">&nbsp; &nbsp; &nbsp; Tienda</a></p>
            </div>  
            <div class="derecha"> 
                <form name="busqueda" class="buscar" action="<?php echo RUTA; ?>/buscar.php" method="get"> 
                    <input type="text" name="busqueda" placeholder="Buscar"> 
                    <button type="submit" class="icono fa fa-search"></button>
            </form> 

            <nav class="menu"> 
                <ul> 
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li> 
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li> 
                    <li><a href="#">Contacto <i class="fa fa-envelope"></i></a></li> 
                </ul>
            </nav>
            </div> 

        </div>
    </header> 
