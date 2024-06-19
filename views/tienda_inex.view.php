<?php require 'header.php'; ?>
    <div class="contenedor">  
    <h2> Panel de control </h2> 
    <a href="create.php" class="btn">Nuevo Producto</a> 
    <a href="cerrar.php" class="btn">Cerrar Sesion</a> 
    <?php foreach($posts as $post): ?>       
    <div class="post">  
        <article> 
            <h2 class="titulo"><?php echo $post['CodProd'] . '.-' . $post['nombre']; ?></h2>
            <a href="edit.php?id=<?php echo $post['CodProd']?>">Editar</a> 
            <a href="../producto.php?id=<?php echo $post['CodProd']; ?>">Ver</a> 
            <a href="borrar.php?id=<?php echo $post['CodProd']; ?>">Borrar</a>
        </article>
    </div>
<?php endforeach; ?>
        <?php require '../paginacion.php'; ?> 

    </div> 

    <?php  require '../footer.php' ; ?> 

    <!-- arreglar este paginador -->

