<?php require 'header.php'; ?>

<div class="contenedor"> 
    <h2><?php echo $titulo; ?></h2>
    <?php if (!empty($resultados)): ?>
        <?php foreach ($resultados as $post): ?>     
            <div class="post">  
                <article>
                    <h2 class="titulo">
                        <?php if (isset($post['titulo'])): ?>
                            <a href="single.php?id=<?php echo $post['id']; ?>">
                                <?php echo $post['titulo']; ?>
                            </a>
                        <?php elseif (isset($post['nombre'])): ?>
                            <a href="producto.php?id=<?php echo $post['CodProd']; ?>">
                                <?php echo $post['nombre']; ?>
                            </a>
                        <?php elseif (isset($post['descripcion'])): ?>
                            <a href="playa.php?id=<?php echo $post['id']; ?>">
                                <?php echo $post['nombre']; ?>
                            </a>
                        <?php endif; ?>
                    </h2> 
                    <?php if (isset($post['fecha'])): ?>
                        <p class="fecha"><?php echo fecha($post['fecha']); ?></p> 
                    <?php endif; ?>
                    <?php if (isset($post['thumb']) || isset($post['imagen'])): ?>
                        <div class="thumb">
                            <a href="<?php echo isset($post['thumb']) ? 'single.php?id=' . $post['id'] : (isset($post['imagen']) ? 'producto.php?id=' . $post['CodProd'] : ''); ?>"> 
                                <img src="<?php echo RUTA; ?>/imagenes/<?php echo isset($post['thumb']) ? $post['thumb'] : (isset($post['imagen']) ? $post['imagen'] : ''); ?>" alt=""> 
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($post['extracto']) || isset($post['descripcion'])): ?>
                        <p class="extracto">
                            <?php echo isset($post['extracto']) ? $post['extracto'] : (isset($post['descripcion']) ? $post['descripcion'] : ''); ?>
                        </p> 
                    <?php endif; ?>
                    <a href="<?php echo isset($post['titulo']) ? 'single.php?id=' . $post['id'] : (isset($post['nombre']) ? 'producto.php?id=' . $post['CodProd'] : (isset($post['descripcion']) ? 'playa.php?id=' . $post['id'] : '')); ?>" class="continuar">Continuar leyendo</a>
                </article>
            </div>
        <?php endforeach; ?>
        <?php require 'paginacion.php'; ?> 
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>
</div> 

<?php require 'footer.php'; ?>