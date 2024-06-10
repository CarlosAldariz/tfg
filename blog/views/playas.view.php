<?php require 'header.php'; ?>

    <div class="contenedor"> 
    <?php foreach($posts as $post): ?>     

   
    <div class="post">  
        <article>      
            <h2 class="titulo">
                <a href="playa.php?id=<?php echo $post['id']; ?>">
                    <?php echo $post['nombre']; ?>
                </a>
            </h2>  
            <div class="thumb">
                <a href="playa.php?id=<?php echo $post['id']; ?>"> 
                    <!-- TAMAÑO 529X95 -->
                    <img src="<?php echo RUTA; ?>/weather/images/<?php echo $post['imagen']; ?>" alt=""> 
                </a>
            </div>   
            <p class="extracto"><?php echo $post['descripcion']; ?></p> 
            <a href="playa.php?id=<?php echo $post['id']; ?>" class="continuar">Mas información</a>
        </article>
    </div>
<?php endforeach; ?>
        <?php require 'paginacion_playas.php'; ?> 

    </div> 

    <?php  require 'footer.php' ; ?>