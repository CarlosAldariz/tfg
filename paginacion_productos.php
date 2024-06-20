<?php 
$numero_paginas = numero_paginas($blog_config['post_por_pagina'], $conexion); 
$id = id_articulo($_GET['id']); // Asegurarse de que el id esté disponible
?>

<section class="paginacion"> 
    <ul> 
        <?php if (pagina_actual() === 1): ?>
              <li class="disabled">&laquo;</li>  
        <?php else: ?>
            <li><a href="Categorias_Productos.php?id=<?php echo $id; ?>&p=<?php echo pagina_actual() - 1 ?>">&laquo;</a></li>   
        <?php endif; ?> 

        <?php for($i = 1; $i <= $numero_paginas; $i++): ?> 
            <?php if(pagina_actual() === $i): ?>
                <li class="active"> 
                    <?php echo $i; ?>
                </li>
            <?php else: ?>
                <li><a href="Categorias_Productos.php?id=<?php echo $id; ?>&p=<?php echo $i; ?>"><?php echo $i ?> </a></li> 
            <?php endif; ?> 
        <?php endfor; ?> 

        <?php if(pagina_actual() == $numero_paginas): ?>  
            <li class="disabled">&raquo;</li>
        <?php else: ?> 
            <li><a href="Categorias_Productos.php?id=<?php echo $id; ?>&p=<?php echo pagina_actual() + 1;?>">&raquo;</a></li>
        <?php endif; ?>
    </ul>
</section>