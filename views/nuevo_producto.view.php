<?php require 'header.php'; ?> 

<div class="contenedor">
<div class="post">  
        <article>      
            <h2 class="titulo">Nuevo Producto</h2> 
    <form class="formulario" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="descripcion" placeholder="Descripcion"> 
            <textarea name="texto" placeholder="Texto de articulo"></textarea>  
            <input type="file" name="thumb">

            <input type="submit" value="Crear Articulo">
    </form>
        </article>
    </div> 
</div>

<?php require '../footer.php'; ?>