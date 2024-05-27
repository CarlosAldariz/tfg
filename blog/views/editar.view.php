<?php require 'header.php'; ?> 

<div class="contenedor">
<div class="post">  
        <article>      
            <h2 class="titulo">Editar Articulo</h2> 
    <form class="formulario" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" value="" name="id">
            <input type="text" name="titulo" placeholder="Titulo del articulo">
            <input type="text" name="extracto" placeholder="Extracto del articulo"> 
            <textarea name="texto" placeholder="Texto de articulo"></textarea>  
            <input type="file" name="thumb">
           <input type="hidden" name="thumb-guardada" value="">
             <input type="submit" value="Modificar Articulo">
    </form>
        </article>
    </div> 
</div>

<?php require '../footer.php'; ?>