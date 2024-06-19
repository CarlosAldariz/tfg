<?php require 'header.php'; ?> 

<div class="edit_tienda"> 
    <div class="post">  
        <article>  
            
            <h2 class="titulo"><?php echo $producto['nombre']; ?></h2> 

            <div class="thumb">
                <!-- TAMAÑO 529X95 -->
                <img src="<?php echo RUTA; ?>/imagenes/<?php echo $producto['imagen']; ?>" 
                alt="<?php echo $producto['nombre']; ?>"> 
            </div>  
            <p class="descripcion"><?php echo nl2br($producto['descripcion']); ?></p>  
            <p class="precio">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
            <p class="stock">Stock disponible: <?php echo $producto['stock']; ?></p>
            
        </article>
    </div> 
</div> 

<?php require 'footer.php'; ?>