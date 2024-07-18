<?php require 'header.php'; ?>

<div class="container"> 
    <?php foreach($posts as $post): ?>
        <?php if ($post['estado'] != 2): ?>
            <div class="square">  
                <div class="image-container"> 
                    <img src="<?php echo htmlspecialchars(RUTA); ?>/imagenes/productos/imagenes_tienda/<?php echo htmlspecialchars($post['imagen']); ?>" alt="Imagen del producto"> 
                </div>
                <div class="content">
                    <a href="producto.php?id=<?php echo $post['CodProd']; ?>"><?php echo htmlspecialchars($post['nombre']); ?> </a>
                </div>    
                <div class="extracto"><?php echo htmlspecialchars($post['descripcion']); ?></div>
                <form action="<?php echo RUTA; ?>carrito/index.php" method="POST">
                    <input type="hidden" name="CodProd" value="<?php echo $post['CodProd']; ?>">
                    <button type="submit" class="comprar" >Comprar</button>
                </form>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>  
    
    <?php require 'paginacion_productos.php'; ?>
</div> 

<?php require 'footer.php'; ?>