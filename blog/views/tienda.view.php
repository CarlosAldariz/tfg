<?php require 'header.php'; ?>

    <div class="container"> 
    <?php foreach($posts as $post): ?>     

   
    <div class="square">  
        <div class="image-container"> 
        <img src="<?php echo RUTA; ?>/imagenes/productos/<?php echo $post['imagen']; ?>" alt="">  
        </div>
                <a href="Categorias_Productos.php?id=<?php echo $post['CodCat']; ?>">
                <div class="content"><?php echo $post['nombre']; ?></div>  
    </a>
    </div>
            
<?php endforeach; ?> 
        <?php   require 'paginacion.php'; ?>

    </div> 

    <?php  require 'footer.php' ; ?>

