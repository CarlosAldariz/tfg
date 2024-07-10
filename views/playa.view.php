<?php require 'header.php'; ?> 

<div class="contenedor"> 
    <div class="post">  
        <article>  
            
            <h2 class="titulo"> Playa de <?php echo htmlspecialchars($post['nombre']); ?></h2> 
            <div class="thumb">
                <!-- TAMAÑO 529X95 -->
                <img src="<?php echo htmlspecialchars(RUTA); ?>/weather/images/<?php echo htmlspecialchars($post['imagen']); ?>" 
                alt="<?php echo htmlspecialchars($post['imagen']); ?>"> 
            </div>  
            <p class="extracto"><?php echo nl2br(htmlspecialchars($post['descripcion'])); ?></p>   
            
            <div class="geolocalizacion" style="text-align: center;">
                <?php echo $post['geolocalizacion']; ?>
            </div>
            
            <div class="weather-link" style="text-align: center; margin-top: 10px">
                <a href="weather/<?php echo htmlspecialchars($post['nombre']) ?>.php"><h2>Meteorología en tiempo real</h2></a>
            </div>
            
        </article>
    </div> 
</div> 

<?php require 'footer.php'; ?>