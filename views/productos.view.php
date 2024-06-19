<?php require 'header.php'; ?>

<div class="container"> 
    <?php foreach($posts as $post): ?>     
        <div class="square">  
            <div class="image-container"> 
                <img src="<?php echo htmlspecialchars(RUTA); ?>/imagenes/productos/<?php echo htmlspecialchars($post['imagen']); ?>" alt="Imagen del producto"> 
            </div>
            <div class="content"><a href="producto.php?id=<?php echo $post['CodProd']; ?>"><?php echo htmlspecialchars($post['nombre']); ?> </a></div>    
            <div class="extracto"><?php echo htmlspecialchars($post['descripcion']); ?></div>
            <button class="comprar">Comprar</button> 
            
            </div>
    <?php endforeach; ?>  
    
    <?php require 'paginacion_productos.php' ?>

</div> 

<?php require 'footer.php'; ?>
