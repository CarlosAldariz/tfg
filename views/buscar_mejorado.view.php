<?php require 'header.php'; ?>

<div class="contenedor"> 
    <h2 class="titulo">Resultados de la búsqueda para: <?php echo $busqueda; ?></h2>

    <?php if (empty($resultados)): ?>
        <p>No se encontraron resultados para: <?php echo $busqueda; ?></p>
    <?php else: ?>
        <?php foreach($resultados as $resultado): ?>
            <?php if (isset($resultado['titulo'])): ?>
                <div class="post">  
                    <article>      
                        <h2 class="titulo">
                            <a href="single.php?id=<?php echo $resultado['id']; ?>">
                                <?php echo $resultado['titulo']; ?>
                            </a>
                        </h2> 
                        <p class="fecha"><?php echo fecha($resultado['fecha']); ?></p> 
                        <?php if (isset($resultado['thumb'])): ?>
                            <div class="thumb">
                                <a href="single.php?id=<?php echo $resultado['id']; ?>"> 
                                    <!-- TAMAÑO 529X95 -->
                                    <img style="overflow-clip-margin: content-box; overflow: clip;" src="<?php echo RUTA; ?>/imagenes/<?php echo $resultado['thumb']; ?>" alt=""> 
                                </a>
                            </div>  
                        <?php endif; ?>
                        <?php if (isset($resultado['extracto'])): ?>
                            <p class="extracto"><?php echo $resultado['extracto']; ?></p> 
                        <?php endif; ?>
                        <a href="single.php?id=<?php echo $resultado['id']; ?>" class="continuar">Continuar leyendo</a>
                    </article>
                </div>
                <?php elseif (isset($resultado['nombre']) && isset($resultado['descripcion'])): ?>
    <div class="post">
        <h2 class="titulo"><?php echo $resultado['nombre']; ?></h2>  
        <?php if (isset($resultado['imagen'])): ?>
            <div class="thumb">
                <img src="<?php echo RUTA; ?>/imagenes/<?php echo $resultado['imagen']; ?>" alt="<?php echo $resultado['nombre']; ?>" style="max-width: 100%; height: auto; overflow-clip-margin: content-box; overflow: clip;"> 
            </div>
        <?php endif; ?>
                    <p class="descripcion"><?php echo $resultado['descripcion']; ?></p> 
                    <a href="producto.php?id=<?php echo $resultado['CodCat']; ?>"> Más información</a>
                </div>
            <?php elseif (isset($resultado['nombre']) && isset($resultado['descripcion']) && isset($resultado['stock'])): ?>
                <div class="post">
                    <h2 class="titulo"><?php echo $resultado['nombre']; ?></h2>
                    <p class="descripcion"><?php echo $resultado['descripcion']; ?></p>
                    <?php if (!empty($resultado['imagen'])): ?>
                        <div class="thumb">
                            <img style="overflow-clip-margin: content-box; overflow: clip;" src="<?php echo RUTA; ?>/imagenes/<?php echo $resultado['imagen']; ?>" alt="<?php echo $resultado['nombre']; ?>">
                        </div>
                    <?php endif; ?>
                    <p class="stock">Stock: <?php echo $resultado['stock']; ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div> 

<?php require 'footer.php'; ?>