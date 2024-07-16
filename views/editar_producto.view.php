<?php require 'header.php'; ?> 

<div class="contenedor">
<div class="post">  
        <article>      
            <h2 class="titulo">Editar Producto</h2> 
    <form class="formulario" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" value="<?php echo $post['CodCat']; ?>" name="CodCat">
            <input type="text" name="nombre" value="<?php echo $post['nombre']; ?>">
            <input type="text" name="descripcion" value="<?php echo $post['descripcion']; ?>"> 
            <input type="file" name="imagen">
           <input type="hidden" name="imagen-guardada" value=""<?php echo $post['imagen']; ?>">
             <input type="submit" value="Modificar Producto">
    </form>
        </article>
    </div> 
</div>

<?php require '../footer.php'; ?>