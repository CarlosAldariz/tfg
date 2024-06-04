<?php require 'header.php'; ?> 

<div class="contenedor"> 
    <div class="post">  
        <article>  
            
            <h2 class="titulo"> Playa de <?php echo $post['nombre']; ?></h2> 
            <div class="thumb">
                <!-- TAMAÑO 529X95 -->
                <img src="<?php echo RUTA; ?>/weather/images/<?php echo $post['imagen']; ?>" 
                alt="<?php echo $post['imagen']; ?>"> 
            </div>  
            <p class="extracto"><?php echo nl2br($post['descripcion']); ?></p>  
            
            <div class="geolocalizacion">
                <iframe src="<?php echo $post['geolocalizacion']; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <div class="weather-link">
                <a href="/weather/<?php echo $post['nombre'].php; ?>">Meteorología en tiempo real</a>
            </div>
            
        </article>
    </div> 
</div> 

<?php require 'footer.php'; ?>