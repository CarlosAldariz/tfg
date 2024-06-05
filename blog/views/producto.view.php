<?php require 'header.php'; ?> 

<div class="contenedor"> 
    <div class="post">  
        <article>  
            
            <h2 class="titulo"><?php echo $post['nombre']; ?></h2> 
            <div class="thumb">
                <!-- TAMAÑO 529X95 -->
                <img src="<?php echo RUTA; ?>/imagenes/productos<?php echo $post['imagen']; ?>" 
                alt="<?php echo $post['imagen']; ?>"> 
            </div>  
            <p class="extracto"><?php echo nl2br($post['descripcion']); ?></p>  
            
        </article>
    </div> 
</div> 

<?php require 'footer.php'; ?>