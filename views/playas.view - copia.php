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
<?php if (count($posts) >= $blog_config['post_por_pagina']): ?>
        <?php require 'paginacion_playas.php'; ?>
    <?php endif; ?>
</div> 

    <?php  require 'footer.php' ; ?>