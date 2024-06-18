<?php require 'header.php'; ?>

    <div class="container"> 
    <?php foreach($posts as $post): ?>     

   
    <div class="square">  
        <div class="image-container"> 
        <img src="<?php echo RUTA; ?>/imagenes/<?php echo $post['thumb']; ?>" alt="">  
        </div>
                <a href="single.php?id=<?php echo $post['id']; ?>">
                <div class="content"><?php echo $post['titulo']; ?></div>  
    </a>
    </div>
            
<?php endforeach; ?> 
<?php if (count($posts) >= $blog_config['post_por_pagina']): ?>
        <?php require 'paginacion.php'; ?>
    <?php endif; ?>
</div> 

    <?php  require 'footer.php' ; ?>

