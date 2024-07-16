<?php require 'header.php'; ?>

<div class="edit_tienda">
    <h2>Editar Producto</h2>
    <form action="edit.php?id=<?php echo $producto['CodProd']; ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
        <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
        <input type="number" name="precio" value="<?php echo $producto['precio']; ?>" required>
        <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" required>
        <select name="codcat" required>
            <?php 
            $categorias = obtener_categorias($conexion);
            foreach($categorias as $categoria) {
                $selected = ($producto['CodCat'] == $categoria['CodCategoria']) ? 'selected' : '';
                echo "<option value=\"{$categoria['CodCategoria']}\" $selected>{$categoria['nombre_categoria']}</option>";
            }
            ?>
        </select>
        <input type="file" name="imagen">
        <input type="hidden" name="imagen-guardada" value="<?php echo $producto['imagen']; ?>">
        <input type="submit" value="Guardar Cambios">
    </form>
</div>

<?php require '../footer.php'; ?>