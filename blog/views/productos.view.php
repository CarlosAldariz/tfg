<?php require 'header.php'; ?>

<div class="container"> 
    <?php foreach($posts as $post): ?>     
        <div class="square">  
            <div class="image-container"> 
                <img src="<?php echo htmlspecialchars(RUTA); ?>/imagenes/productos/<?php echo htmlspecialchars($post['imagen']); ?>" alt="Imagen del producto"> 
            </div>
            <div class="content"><?php echo htmlspecialchars($post['nombre']); ?></div>    
            <div class="extracto"><?php echo htmlspecialchars($post['descripcion']); ?></div>
            <button class="comprar">¡Resérvala!</button> 
            
            </div>
    <?php endforeach; ?>  

    <?php if (count($posts) >= $blog_config['post_por_pagina']): ?>
        <?php require 'paginacion_productos.php'; ?>
    <?php endif; ?>
</div> 

<?php require 'footer.php'; ?>
