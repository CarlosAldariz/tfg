<?php require 'header.php'; ?>

    <div class="container"> 
    <?php foreach($posts as $post): ?>     

   
            <div class="square"> 
            <div class="image-container">  
            <img src="<?php echo RUTA; ?>/weather/images/<?php echo $post['imagen']; ?>" alt="">  
            </div>
                <a href="playa.php?id=<?php echo $post['id']; ?>">
                <div class="content"><?php echo $post['nombre']; ?></div>
                </a>
    </div>
<?php endforeach; ?>
        <?php require 'paginacion_playas.php'; ?> 

    </div> 

    <?php  require 'footer.php' ; ?>