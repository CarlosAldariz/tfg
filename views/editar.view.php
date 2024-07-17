<?php require 'header.php'; ?>

<div class="contenedor">
    <div class="post">  
        <article>      
            <h2 class="titulo">Editar Artículo</h2> 
            <form class="formulario" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
                <input type="text" name="titulo" value="<?php echo htmlspecialchars($post['titulo']); ?>" required>
                <input type="text" name="extracto" value="<?php echo htmlspecialchars($post['extracto']); ?>" required> 
                <textarea name="text" required><?php echo htmlspecialchars($post['text']); ?></textarea>  
                <input type="file" name="thumb">
                <input type="hidden" name="thumb-guardada" value="<?php echo htmlspecialchars($post['thumb']); ?>">
                <input type="submit" value="Modificar Artículo">
            </form>
        </article>
    </div> 
</div>

<?php require '../footer.php'; ?>