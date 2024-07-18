<?php require 'header.php'; ?> 

    <?php if (($_SESSION["CodRol"]) != 4) { 
        if (($_SESSION["CodRol"]) != 1) { 
           echo "<h1 style='text-align: center; margin-top: 20%; margin-bottom: 20%;'>No tienes los permisos suficientes, ponte en contacto con el administrador</h1>"; 
           require '../footer.php' ;
           exit ();
        }
    } ?>

    <div class="contenedor">  
    <h2> Panel de control </h2> 
    <a href="nuevo.php" class="btn">Nuevo Post</a> 
    <a href="cerrar.php" class="btn">Cerrar Sesion</a> 
    <?php foreach($posts as $post): ?>       
    <div class="post">  
        <article> 
            <h2 class="titulo"><?php echo $post['id'] . '.-' . $post['titulo']; ?></h2>
            <a href="editar.php?id=<?php echo $post['id']?>">Editar</a> 
            <a href="../single.php?id=<?php echo $post['id']; ?>">Ver</a> 
            <a href="borrar.php?id=<?php echo $post['id']; ?>">Borrar</a>
        </article>
    </div>
<?php endforeach; ?>
        <?php require '../paginacion.php'; ?> 

    </div> 

    <?php  require '../footer.php' ; ?>

